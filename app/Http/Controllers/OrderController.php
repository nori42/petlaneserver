<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Receipt;
use App\Models\ShoppingCart;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\error;

class OrderController extends Controller
{
    //
    public function placeOrder(Request $request){
        $params = $request->collect();

        $orderDetails = new OrderDetail();
        $receipt = new Receipt();
        $totalAmount = 0;

        // Execute database query in placing order
        $shoppingItemIds = ShoppingCart::join('products', 'Product_ID', '=', 'products.id')
        ->select('Product_ID','Quantity','Price')
        ->where('Customer_ID',$request->customerId)
        ->get();

        // Create Order Detail
        $orderDetails->Description = $params['orderDescription'];
        $orderDetails->Order_Date = date('Y-m-d');
        $orderDetails->Customer_ID = $request->customerId;
        // $orderDetails->save();

        // Loop Through The shopping cart
        foreach ($shoppingItemIds as $item) {
          $order = new Order();

          $productStock = Stock::where('Product_ID',$item->Product_ID)->first();

          DB::table('stocks')
              ->where('Product_ID', $item->Product_ID)
              ->update(['Quantity' => $productStock->Quantity - 1]);

          $order->OrderDetails_ID = $orderDetails->id;
          $order->Quantity = $item->Quantity;
          $order->Product_ID = $item->Product_ID;
        //   $order->save();

          $totalAmount += $item->Price;

        }

        // Create Receipt
        $receipt->Customer_ID = $request->customerId;
        $receipt->Order_ID = $orderDetails->id;
        $receipt->Payment_Amount = $totalAmount;
        $receipt->Payment_Amount = $totalAmount;
        $receipt->Date = date('Y-m-d');
        // $receipt->save();

        ShoppingCart::where('Customer_ID',$request->customerId)->delete();

        // Send a success message after ordering or other data
        return response()->json([
            'status' => 'success'
        ]);
    }
}
