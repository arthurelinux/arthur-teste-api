<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\SalesProducts;
use Illuminate\Http\Request;

class SalesProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $sales = SalesProducts::with('sale')
            ->whereHas('sale', function ($query) {
                $query->whereNull('canceled_at');
            })
            ->get();

        return response()->json($sales);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $saleId = $id;
        $sale = SalesProducts::with('sale')
            ->where('sale_id',$saleId)->get();

        return response()->json($sale);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalesProducts $salesProducts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalesProducts $salesProducts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesProducts $salesProducts)
    {
        //
    }
}
