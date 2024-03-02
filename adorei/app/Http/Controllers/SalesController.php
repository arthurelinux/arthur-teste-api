<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Sales;
use App\Models\SalesProducts;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.amount' => 'required|integer|min:1',
        ]);

        // Criação da venda
        $sale = Sales::create();

        // Adiciona os produtos à venda
        foreach ($request->products as $productData) {
            $product = Products::findOrFail($productData['product_id']);

            // Criação da relação entre venda e produto
            SalesProducts::create([
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'amount' => $productData['amount']
            ]);
        }

        return response()->json($sale, 201);
    }
    public function adicionar(Request $request, $id)
    {

        $request->validate([
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.amount' => 'required|integer|min:1',
        ]);

        // Criação da venda
        $sale = Sales::find($id);

        // Adiciona os produtos à venda
        foreach ($request->products as $productData) {
            $product = Products::findOrFail($productData['product_id']);

            // Criação da relação entre venda e produto
            SalesProducts::create([
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'amount' => $productData['amount']
            ]);
        }

        return response()->json($sale, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $sale = Sales::findOrFail($id);
        return response()->json($sale);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|integer|min:1',
        ]);


        $sale = Sales::findOrFail($id);
        $sale->product_id = $request->product_id;
        $sale->amount = $request->amount;
        $sale->save();

        return response()->json($sale);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function cancelar(Request $request, $id)
    {

        $sale = Sales::findOrFail($id);
        $currentDateTime = Carbon::now()->toDateTimeString();

        $sale->canceled_at = $currentDateTime;
        $sale->save();

        return response()->json($sale);
    }
    public function destroy(Sales $sales)
    {
        //
        $sale = Sales::findOrFail($id);


        if ($sale->canceled_at) {
            return response()->json(['message' => 'A venda já foi cancelada'], 400);
        }

        $sale->canceled_at = Carbon::now();
        $sale->save();

        return response()->json(['message' => 'Venda cancelada com sucesso'], 200);
    }
}
