<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list()
    {
        $products = Product::all();

        if (count($products) <= 0) {
            $products = ["result" => "empty"];
        }

        return response()->json($products);
    }

    public function listById($id)
    {
        $product = Product::where('id', $id)->get();

        if (count($product) <= 0) {
            $product = ["result" => "empty"];
        }

        return response()->json($product);
    }

    public function create(Request $request)
    {
        try {
            $validateData = $request->validate([
                'name'          => 'required|string|max:30',
                'description'   => 'required|string|max:300',
                'category'      => 'required|string|max:30',
                'price'         => 'required|numeric',
                'trademark'     => 'required|string|max:30'
            ]);

            $product                = new Product();
            $product->name          = $validateData['name'];
            $product->description   = $validateData['description'];
            $product->category      = $validateData['category'];
            $product->price         = $validateData['price'];
            $product->trademark     = $validateData['trademark'];

            $product->save();

            return response()->json([
                'message' => "produto criado com sucesso",
                'product' => $product
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
