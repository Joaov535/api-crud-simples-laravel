<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Exception;

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
                '*.name'          => 'required|string|max:30',
                '*.description'   => 'required|string|max:300',
                '*.category'      => 'required|string|max:30',
                '*.price'         => 'required|numeric',
                '*.trademark'     => 'required|string|max:30'
            ]);

            foreach ($validateData as $productData) {

                $product                = new Product();
                $product->name          = $productData['name'];
                $product->description   = $productData['description'];
                $product->category      = $productData['category'];
                $product->price         = $productData['price'];
                $product->trademark     = $productData['trademark'];

                $product->save();
            }

            return response()->json([
                'message' => "O cadastro foi realizado com sucesso"
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function edit(Request $request)
    {
        try {
            $validateData = $request->validate([
                'id'          => 'required|numeric',
                'name'        => 'sometimes|string|max:30',
                'description' => 'sometimes|string|max:300',
                'category'    => 'sometimes|string|max:30',
                'price'       => 'sometimes|numeric',
                'trademark'   => 'sometimes|string|max:30'
            ]);

            $product = Product::findOrFail($validateData['id']);

            if (isset($validateData['name'])) {
                $product->name = $validateData['name'];
            }

            if (isset($validateData['description'])) {
                $product->description = $validateData['description'];
            }

            if (isset($validateData['category'])) {
                $product->category = $validateData['category'];
            }

            if (isset($validateData['price'])) {
                $product->price = $validateData['price'];
            }

            if (isset($validateData['trademark'])) {
                $product->trademark = $validateData['trademark'];
            }

            $product->save();

            return response()->json([
                'message' => 'Produto alterado com sucesso',
                'product' => $product
            ]);
        } catch (Exception $e) {
            return response()->json(["message" => "Erro: {$e->getMessage()}"], 400);
        }
    }

    public function delete($id)
    {
        try {
            Product::destroy($id);

            return response()->json([
                "message" => "Produto deletado com sucesso"
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => "Falha ao deletar produto: {$e->getMessage()}"
            ], 400);
        }
    }
}
