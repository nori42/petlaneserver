<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    //
    public function addItem(Request $request){
        $params = $request->collect();

        $shoppingCart = new ShoppingCart();
        $shoppingCart->Customer_ID = $params['customerId'];
        $shoppingCart->Product_ID = $params['productId'];
        $shoppingCart->Quantity = 1;
        $shoppingCart->save();

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function updateQuantity(Request $request){
        $params = $request->collect();
        
        ShoppingCart::where('Product_ID',$params['productId'])->where('Customer_ID',$params['customerId'])->get()->Quantity += 1;

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function getShoppingCart(Request $request){
        $shoppingCart = ShoppingCart::where('Customer_ID',$request->id);

        return response()->json([
            'status' => 'success',
            'shoppingCart' => $shoppingCart
        ]);
    }
}
