<?php

namespace App\Http\Controllers;
use App\Models\Merchant;
use App\Models\MerchantCategory;
use App\Models\Document;
use App\Models\MerchantsService;
use App\Models\Service;

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
        $title = 'Create Merchants KYC'; // You can set your title here
        return view('pages.merchants.create-merchants', compact('title'));
    }
    
    
    public function create_merchants_documents()
    {
        $merchant_documents = Document::all();
        $title = 'Create Merchants Documents'; // You can set your title here
        return view('pages.merchants.create-merchants-documents', compact('merchant_documents', 'title'));
    }
    

    public  function create_merchants_sales(){

        $title = 'Create Merchants Sales';
        return view('pages.merchants.create-merchants-sales', compact('title'));
    }

    public  function create_merchants_services(){
        $services = Service::all();
        $title = 'Create Merchants Services';
        return view('pages.merchants.create-merchants-services', compact('services', 'title'));
    }
    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
         
     }

     public function store_merchants_kyc(Request $request)
     {


     }

     public function store_merchants_documents(Request $request)
     {


     }

     public function store_merchants_sales(Request $request)
     {


     }

     public function store_merchants_services(Request $request)
     {
         
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
