<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MerchantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.merchants.merchants-list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_merchants_kfc()
    {
        return view('pages.merchants.create-merchants');

    }
    
    public function create_merchants_documents()
    {
        return view('pages.merchants.create-merchants-documents');
    }

    public  function create_merchants_sales(){

        return view('pages.merchants.create-merchants-sales');
    }

    public  function create_merchants_services(){
        return view('pages.merchants.create-merchants-services');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
