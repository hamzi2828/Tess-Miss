<?php

namespace App\Http\Controllers;
use App\Models\Merchant;
use App\Models\MerchantCategory;
use App\Models\MerchantDocument;
use App\Models\MerchantSale;
use App\Models\MerchantShareholder;
use App\Models\MerchantService;
use App\Models\Document;
use App\Models\Service;
use App\Models\Country;
use App\Services\MerchantsServiceService;

use Illuminate\Http\Request;

class MerchantsController extends Controller
{

    protected $merchantsService;

    public function __construct(MerchantsServiceService $merchantsService)
    {
        $this->merchantsService = $merchantsService;
    }
    /**
     * Display a listing of the resource.
     */ 
    public function index()
    {
        // Retrieve all merchants using service layer
        $merchants = $this->merchantsService->getAllMerchants();
        return view('pages.merchants.merchants-list', compact('merchants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_merchants_kfc()
    {
        $title = 'Create Merchants KYC'; 
        $MerchantCategory = MerchantCategory::all();
        $Country = Country::all();
        

        return view('pages.merchants.create.create-merchants', compact('title', 'MerchantCategory', 'Country'));
    }
    
    
    public function create_merchants_documents()
    {
        $merchant_documents = Document::all();
        $title = 'Create Merchants Documents'; // You can set your title here
        return view('pages.merchants.create.create-merchants-documents', compact('merchant_documents', 'title'));
    }
    

    public  function create_merchants_sales(){

        $title = 'Create Merchants Sales';
        return view('pages.merchants.create.create-merchants-sales', compact('title'));
    }

    public  function create_merchants_services(){
        $services = Service::all();
        $title = 'Create Merchants Services';
    
        return view('pages.merchants.create.create-merchants-services', compact('services', 'title'));
    }
    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
         
     }

     public function store_merchants_kyc(Request $request)
     {
        
         // Validate the request
         $validatedData  = $request->validate([
             'merchant_name' => 'required|string|max:255',
             'date_of_incorporation' => 'required|date',
             'merchant_arabic_name' => 'required|string|max:255',
             'company_registration' => 'required|string|max:255',
             'company_address' => 'required|string',
             'mobile_number' => 'required|string|max:15',
             'company_activities' => 'required|integer',
             'landline_number' => 'required|string|max:15',
             'website' => 'nullable|url', 
             'email' => 'required|email',
             'monthly_website_visitors' => 'nullable|integer',
             'key_point_of_contact' => 'required|string',
             'monthly_active_users' => 'nullable|integer',
             'key_point_mobile' => 'required|string|max:15',
             'monthly_avg_volume' => 'nullable|integer',
             'existing_banking_partner' => 'nullable|string',
             'monthly_avg_transactions' => 'required|integer',
             'shareholderName.*' => 'required|string|max:255',
             'shareholderNationality.*' => 'required|integer',
             'shareholderID.*' => 'nullable|string|max:255',
         ]);
        
         // Use the service to handle merchant creation
         $this->merchantsService->createMerchants($validatedData);
 
         // Redirect with a success message
         return redirect()->route('merchants.index')->with('success', 'Merchant and Shareholders successfully added.');
     }
     

     public function store_merchants_documents(Request $request)
     {
         $validatedData = $request->validate([
             'document_*' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:2048',
             'expiry_*' => 'nullable|date',
         ]);

         $merchant_id = $request->input('merchant_id');
     
         foreach ($request->all() as $key => $value) {
             if (strpos($key, 'document_') === 0) {
                 $document_id = str_replace('document_', '', $key);
     
                 if ($request->hasFile($key)) {
                     $file = $request->file($key);
                     $fileName = time() . '_' . $file->getClientOriginalName();
                     $filePath = $file->storeAs('public/documents', $fileName);
     
                     $expiryDateKey = 'expiry_' . $document_id;
                     $expiryDate = $request->input($expiryDateKey, null);
     
                     MerchantDocument::create([
                         'title' => $file->getClientOriginalName(),
                         'document' => $filePath,
                         'date_expiry' => $expiryDate,
                         'merchant_id' => $merchant_id,
                         'added_by' => auth()->user()->id,
                         'document_type' => $file->getClientMimeType(),
                         'emailed' => false,
                         'status' => true,
                     ]);
                 }
             }
         }
     
        //  return redirect()->route('merchants.index')->with('success', 'Documents uploaded and saved successfully.');
        return redirect()->route('edit.merchants.documents', ['merchant_id' => $merchant_id])
        ->with('success', 'Documents uploaded and saved successfully.')->withInput($request->all());
     }
     

     public function store_merchants_sales(Request $request)
     {
         // Step 1: Validate the form input
         $validatedData = $request->validate([
             'minTransactionAmount' => 'required|numeric',
             'monthlyLimitAmount' => 'required|numeric',
             'maxTransactionAmount' => 'required|numeric',
             'maxTransactionCount' => 'required|integer',
             'dailyLimitAmount' => 'required|numeric',
         ]);
         $merchant_id = $request->input('merchant_id');
         $this->merchantsService->storeMerchantsSales($validatedData, $merchant_id);

 
     
         // Redirect or return success response
        //  return redirect()->route('merchants.index')->with('success', 'Merchant sales data saved successfully.');
        return redirect()->route('edit.merchants.sales', ['merchant_id' => $merchant_id])
        ->with('success', 'Merchant sales data saved successfully.')->withInput($request->all());
     }
     
     

     public function store_merchants_services(Request $request)
     {
    
         // Step 1: Validate the incoming data
         $validatedData = $request->validate([
             'services' => 'required|array',
             'services.*.fields' => 'required|array',
             'services.*.fields.*' => 'required|string',
         ]);
     
         $merchant_id = $request->input('merchant_id');
  
         // Step 2: Use the service to save the merchant services data
         $this->merchantsService->storeMerchantsServices($validatedData, $merchant_id);
     
        //  // Step 3: Redirect with a success message
        //  return redirect()->route('merchants.index')->with('success', 'Services data saved successfully.');
     
        return redirect()->route('edit.merchants.services', ['merchant_id' => $merchant_id])
        ->with('success', 'Services data saved successfully.')->withInput($request->all());
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
    public function edit_merchants_kyc(Request $request)
    {
        $id = $request->input('merchant_id'); 
       
        $title = 'Edit Merchants Details';
        $merchant_details = Merchant::with(['sales', 'services', 'shareholders', 'documents'])->where('id', $id)->first();
        $MerchantCategory = MerchantCategory::all();
        $Country = Country::all();
        return view('pages.merchants.edit.edit-merchants', compact('merchant_details', 'title', 'MerchantCategory', 'Country'));
    }
    
    public function edit_merchants_documents(Request $request)
    {

        $title = 'Edit Merchants Details';

        $id = $request->input('merchant_id'); 
        $merchant_details = Merchant::with(['documents', 'sales', 'services', 'shareholders'])->where('id', $id)->first();

        if ($merchant_details && $merchant_details->documents->isEmpty() ) {
            return redirect()->route('create.merchants.documents', ['merchant_id' => $id])
            ->with('error', 'No Sales found for this merchant.')->withInput($request->all());
        }
        else {
            return view('pages.merchants.edit.edit-merchants-documents', compact('merchant_details', 'title'));

        }

    }
    


    public function edit_merchants_sales (Request $request)
    {
        $id = $request->input('merchant_id'); 
       
        $title = 'Edit Merchants Sales';
        $merchant_details = Merchant::with(['sales', 'services', 'shareholders', 'documents'])->where('id', $id)->first();
       
        if ($merchant_details && $merchant_details->documents->isEmpty() ) {
            return redirect()->route('create.merchants.documents', ['merchant_id' => $id])
            ->with('error', 'No Sales found for this merchant.')->withInput($request->all());
            
        }
        if ($merchant_details && $merchant_details->sales->isEmpty() ) {
            return redirect()->route('create.merchants.sales', ['merchant_id' => $id])
            ->with('error', 'No Sales found for this merchant.')->withInput($request->all());
        }
        else {
        return view('pages.merchants.edit.edit-merchants-sales', compact('merchant_details', 'title'));   
        }
    }

    public function edit_merchants_services(Request $request)
    {
        $id = $request->input('merchant_id'); 
       
        $title = 'Edit Merchants Services';
        $merchant_details = Merchant::with(['services', 'shareholders', 'documents', 'sales'])->where('id', $id)->first();
        $services = Service::all();

        if ($merchant_details && $merchant_details->sales->isEmpty() ) {
            return redirect()->route('create.merchants.documents', ['merchant_id' => $id])
            ->with('error', 'No Sales found for this merchant.')->withInput($request->all());
            
        }
        if ( $merchant_details->services->isEmpty()) {
            return redirect()->route('create.merchants.services', ['merchant_id' => $id])
                            ->with('error', 'No Services found for this merchant.')->withInput($request->all());
        }else {
            return view('pages.merchants.edit.edit-merchants-services', compact('merchant_details', 'title', 'services'));

        }

      
      
    }
    /**
     * Update the specified resource in storage.
     */
    public function update_merchants_kyc(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'merchant_name' => 'required|string|max:255',
            'date_of_incorporation' => 'required|date',
            'merchant_arabic_name' => 'required|string|max:255',
            'company_registration' => 'required|string|max:255',
            'company_address' => 'required|string',
            'mobile_number' => 'required|string|max:15',
            'company_activities' => 'required|integer',
            'landline_number' => 'required|string|max:15',
            'website' => 'nullable|url',
            'email' => 'required|email',
            'monthly_website_visitors' => 'nullable|integer',
            'key_point_of_contact' => 'required|string',
            'monthly_active_users' => 'nullable|integer',
            'key_point_mobile' => 'required|string|max:15',
            'monthly_avg_volume' => 'nullable|integer',
            'existing_banking_partner' => 'nullable|string',
            'monthly_avg_transactions' => 'required|integer',
            'shareholderName.*' => 'required|string|max:255',
            'shareholderNationality.*' => 'required|integer',
            'shareholderID.*' => 'nullable|string|max:255',
        ]);
    
        $merchant_id = $request->input('merchant_id');
        
        // Use the service to update merchant
        $this->merchantsService->updateMerchants($validatedData, $merchant_id);
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Merchant and Shareholders successfully updated.');

    }


    
    public function update_merchants_documents(Request $request)
    {
        $validatedData = $request->validate([
            'document_*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:2048',
            'expiry_*' => 'nullable|date',
        ]);
    
        $merchant_id = $request->input('merchant_id');
    
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'document_') === 0) {
                $document_id = str_replace('document_', '', $key);
    
                if ($request->hasFile($key)) {
                    $file = $request->file($key);
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('public/documents', $fileName);
    
                    $expiryDateKey = 'expiry_' . $document_id;
                    $expiryDate = $request->input($expiryDateKey, null);
    
                    MerchantDocument::updateOrCreate(
                        [
                            'merchant_id' => $merchant_id,
                            'id' => $document_id
                        ],
                        [
                            'title' => $file->getClientOriginalName(),
                            'document' => $filePath,
                            'date_expiry' => $expiryDate,
                            'merchant_id' => $merchant_id,
                            'added_by' => auth()->user()->id ?? 1,
                            'document_type' => $file->getClientMimeType(),
                            'emailed' => false,
                            'status' => true,
                        ]
                    );
                }
            }
        }
    
        return redirect()->back()->with('success', 'Merchant and Shareholders successfully updated.');
    }

    public function update_merchants_sales(Request $request)
    {
        $validatedData = $request->validate([
            'sales.*.minTransactionAmount' => 'required|numeric',
            'sales.*.monthlyLimitAmount' => 'required|numeric',
            'sales.*.maxTransactionAmount' => 'required|numeric',
            'sales.*.maxTransactionCount' => 'required|integer',
            'sales.*.dailyLimitAmount' => 'required|numeric',
        ]);
    
        $merchant_id = $request->input('merchant_id');
    
        $this->merchantsService->updateMerchantsSales($validatedData['sales'], $merchant_id);
    
        return redirect()->back()->with('success', 'Merchant sales data successfully updated.');
    }
    

    public function update_merchants_services(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'services.*.fields.*' => 'required|string',
        ]);
    
        $merchant_id = $request->input('merchant_id');

        $this->merchantsService->updateMerchantsServices($validatedData['services'], $merchant_id);

        return redirect()->back()->with('success', 'Merchant services data successfully updated.');
    }
    
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
