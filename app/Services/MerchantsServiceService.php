<?php

namespace App\Services;

use App\Models\Merchant;
use App\Models\MerchantCategory;
use App\Models\MerchantDocument;
use App\Models\MerchantSale;
use App\Models\MerchantShareholder;
use App\Models\MerchantService;
use Illuminate\Support\Facades\Auth;

class MerchantsServiceService
{

    public function getAllMerchants(): array
    {
        return Merchant::with(['sales', 'services', 'shareholders', 'documents'])->get()->toArray();
    }
    
    /**
     * Create a new merchant along with its shareholders.
     * 
     * @param array $data The validated data from the form
     * @return Merchant The newly created Merchant instance
     */
    public function createMerchants(array $data): Merchant
    {
        // Create the merchant record
        $merchant = new Merchant();
        $merchant->merchant_name = $data['merchant_name']; 
        $merchant->merchant_name_ar = $data['merchant_arabic_name']; 
        $merchant->comm_reg_no = $data['company_registration']; 
        $merchant->address = $data['company_address']; 
        $merchant->merchant_mobile = $data['mobile_number']; 
        $merchant->merchant_category = $data['company_activities'];
        $merchant->merchant_landline = $data['landline_number']; 
        $merchant->merchant_url = $data['website']; 
        $merchant->merchant_email = $data['email']; 
        $merchant->website_month_visit = $data['monthly_website_visitors']; 
        $merchant->contact_person_name = $data['key_point_of_contact']; 
        $merchant->website_month_active = $data['monthly_active_users']; 
        $merchant->contact_person_mobile = $data['key_point_mobile']; 
        $merchant->website_month_volume = $data['monthly_avg_volume']; 
        $merchant->merchant_previous_bank = $data['existing_banking_partner']; 
        $merchant->website_month_transaction = $data['monthly_avg_transactions']; 
        $merchant->merchant_date_incorp = $data['date_of_incorporation']; 
        $merchant->added_by_kyc = Auth::user()->id ?? 1; 
        $merchant->save();
        
        // Handle Shareholders
        $this->createShareholders($merchant, $data);
        
        return $merchant;
    }

    /**
     * Create shareholders associated with the merchant.
     * 
     * @param Merchant $merchant The Merchant instance
     * @param array $data The validated form data
     */
    protected function createShareholders(Merchant $merchant, array $data): void
    {
        $shareholderNames = $data['shareholderName'];
        $shareholderNationalities = $data['shareholderNationality'];
        $shareholderIDs = $data['shareholderID'];

        foreach ($shareholderNames as $index => $shareholderName) {
            $shareholder = new MerchantShareholder();
            $shareholder->merchant_id = $merchant->id;
            $shareholder->title = $shareholderName;
            $shareholder->country_id = $shareholderNationalities[$index]; 
            $shareholder->qid = $shareholderIDs[$index] ?? null; 
            $shareholder->added_by = Auth::user()->id ?? 1; 
            $shareholder->status = 'active'; 
            $shareholder->save();
        }
    }

    public function storeMerchantsSales(array $data): MerchantSale
    {
        $merchant_id = 7;  // Example merchant ID, replace with dynamic value if needed
     
         // Step 2: Create a new MerchantSale record using validated data
         $merchantSale = new MerchantSale();
         $merchantSale->merchant_id = $merchant_id;
         $merchantSale->min_transaction_amount = $data['minTransactionAmount'];
         $merchantSale->max_transaction_amount = $data['maxTransactionAmount'];
         $merchantSale->daily_limit_amount = $data['dailyLimitAmount'];
         $merchantSale->monthly_limit_amount = $data['monthlyLimitAmount'];
         $merchantSale->max_transaction_count = $data['maxTransactionCount'];
         $merchantSale->added_by = auth()->user()->id ?? 1;  // Use the authenticated user, default to 1 if not available
     
         // Save the merchant sale record
         $merchantSale->save();
         return $merchantSale;

    }


    public function storeMerchantsServices(array $data, int $merchant_id)
    {
        // Step 1: Iterate over the services and save each field in the merchant_services table
        foreach ($data['services'] as $service_id => $serviceData) {
            // Get the fields for this service
            $fields = $serviceData['fields'];
            
            // Save each field
            foreach ($fields as $index => $fieldValue) {
                MerchantService::create([
                    'merchant_id' => $merchant_id,
                    'service_id' => $service_id,
                    'field_name' => 'Field ' . $index, 
                    'field_value' => $fieldValue,
                    'added_by' => Auth::user()->id ?? 1, 
                    'status' => true, 
                ]);
            }
        }
    }
}
