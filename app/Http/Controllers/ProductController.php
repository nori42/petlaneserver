<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function addProduct(Request $request){

        $params = $request->collect();
        // Execute adding new product here

        $product = new Product();
        $stock = new Stock();

        $product->Name = $params['name'];
        $product->Category = $params['category'];
        $product->Variations = $params['variations'];
        $product->Price = $params['price'];
        $product->Description = $params['description'];
        $product->save();

        $stock->Product_ID = $product->id;
        $stock->Quantity = $params['quantity'];
        $stock->save();

        // Send a success response after adding new product
        return response()->json([
            'status' => 'success',
            'product' => $product
        ]);
    }

    public function updateStock(Request $request){

        $params = $request->collect();
        $stock = Stock::where('Product_ID',$params['productId'])->first();

        // If product does not exist
        if($stock == null){

            // Send a success response after adding new product
            return response()->json([
                'status' => 'failure'
            ]);
        }

        $stock->Quantity = $params['quantity'];
        $stock->save();

        // Send a success response after adding new product
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function getAllProducts(Request $request){
        $products = Product::all();

        return response()->json([
            'status' => 'success',
            'products' => $products
        ]);
    }

    public function getProdcut(Request $request){
        $product = Product::find($request->id);

        return response()->json([
            'status' => 'success',
            'products' => $product
        ]);
    }
}
