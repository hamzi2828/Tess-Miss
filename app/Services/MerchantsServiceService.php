<?php

namespace App\Services;

use App\Models\Merchant;
use App\Models\MerchantShareholder;
use Illuminate\Support\Facades\Auth;

class MerchantsServiceService
{
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
}
