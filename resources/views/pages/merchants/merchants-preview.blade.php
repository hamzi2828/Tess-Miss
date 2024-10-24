{{-- merchant-preview --}}
@extends('master.master')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

        <!-- Basic Details Section -->
        <div class="form-section box-container">

            <!-- Step-based Progress Bar -->
            @include('pages.merchants.components.preview-progressBar')

            <h4 class="mb-3">Basic Details</h4>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="merchantName" class="form-label">Merchant Name <span class="required-asterisk">*</span></label>
                    <input type="text" class="form-control" id="merchantName" name="merchant_name" value="{{ $merchant_details['merchant_name'] ?? '' }}" readonly>
                </div>

                <div class="col-md-6">
                    <label for="dateOfIncorporation" class="form-label">Date of Incorporation <span class="required-asterisk">*</span></label>
                    <input type="date" class="form-control" id="dateOfIncorporation" name="date_of_incorporation" value="{{ $merchant_details['merchant_date_incorp'] ? \Carbon\Carbon::parse($merchant_details['merchant_date_incorp'])->format('Y-m-d') : '' }}" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="merchantArabicName" class="form-label">Merchant Arabic Name <span class="required-asterisk">*</span></label>
                    <input type="text" class="form-control" id="merchantArabicName" name="merchant_arabic_name" value="{{ $merchant_details['merchant_name_ar'] ?? '' }}" readonly>
                </div>

                <div class="col-md-6">
                    <label for="companyRegistration" class="form-label">Company Registration <span class="required-asterisk">*</span></label>
                    <input type="text" class="form-control" id="companyRegistration" name="company_registration" value="{{ $merchant_details['comm_reg_no'] ?? '' }}" readonly>
                </div>
            </div>

            <div class="mb-3">
                <label for="companyAddress" class="form-label">Registered Company Address/Details</label>
                <textarea class="form-control" id="companyAddress" name="company_address" rows="3" readonly>{{ $merchant_details['address'] ?? '' }}</textarea>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="mobileNumber" class="form-label">Mobile Number <span class="required-asterisk">*</span></label>
                    <input type="tel" class="form-control" id="mobileNumber" name="mobile_number" value="{{ $merchant_details['merchant_mobile'] ?? '' }}" readonly>
                </div>

                <div class="col-md-6">
                    <label for="companyActivities" class="form-label">Company Principal Activities</label>
                    <select class="form-select select2" id="companyActivities" name="company_activities" disabled>
                        <option selected>Select Activities</option>
                        @foreach($MerchantCategory as $category)
                            <option value="{{ $category->id }}" {{ $merchant_details['merchant_category'] == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
                
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="landlineNumber" class="form-label">Landline Number <span class="required-asterisk">*</span></label>
                    <input type="tel" class="form-control" id="landlineNumber" name="landline_number" value="{{ $merchant_details['merchant_landline'] ?? '' }}" readonly>
                </div>

                <div class="col-md-6">
                    <label for="website" class="form-label">Website</label>
                    <input type="url" class="form-control" id="website" name="website" value="{{ $merchant_details['merchant_url'] ?? '' }}" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email <span class="required-asterisk">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $merchant_details['merchant_email'] ?? '' }}" readonly>
                </div>

                <div class="col-md-6">
                    <label for="monthlyWebsiteVisitors" class="form-label">Monthly Website Visitors</label>
                    <input type="number" class="form-control" id="monthlyWebsiteVisitors" name="monthly_website_visitors" value="{{ $merchant_details['website_month_visit'] ?? '' }}" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="keyPointOfContact" class="form-label">Key Point of Contact <span class="required-asterisk">*</span></label>
                    <input type="text" class="form-control" id="keyPointOfContact" name="key_point_of_contact" value="{{ $merchant_details['contact_person_name'] ?? '' }}" readonly>
                </div>

                <div class="col-md-6">
                    <label for="monthlyActiveUsers" class="form-label">Monthly Active Users</label>
                    <input type="number" class="form-control" id="monthlyActiveUsers" name="monthly_active_users" value="{{ $merchant_details['website_month_active'] ?? '' }}" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="keyPointMobile" class="form-label">Key Point Mobile <span class="required-asterisk">*</span></label>
                    <input type="tel" class="form-control" id="keyPointMobile" name="key_point_mobile" value="{{ $merchant_details['contact_person_mobile'] ?? '' }}" readonly>
                </div>

                <div class="col-md-6">
                    <label for="monthlyAvgVolume" class="form-label">Monthly Average Volume (QAR)</label>
                    <input type="number" class="form-control" id="monthlyAvgVolume" name="monthly_avg_volume" value="{{ $merchant_details['website_month_volume'] ?? '' }}" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="existingBankingPartner" class="form-label">Existing Banking Partner</label>
                    <input type="text" class="form-control" id="existingBankingPartner" name="existing_banking_partner" value="{{ $merchant_details['merchant_previous_bank'] ?? '' }}" readonly>
                </div>

                <div class="col-md-6">
                    <label for="monthlyAvgTransactions" class="form-label">Monthly Average No. Of Transactions <span class="required-asterisk">*</span></label>
                    <input type="number" class="form-control" id="monthlyAvgTransactions" name="monthly_avg_transactions" value="{{ $merchant_details['website_month_transaction'] ?? '' }}" readonly>
                </div>
            </div>
        </div>

        <!-- Shareholders Section with Add Button -->
        <div class="form-section box-container">
            <h4 class="mb-3">Shareholders</h4>

            <!-- Container for all shareholders -->
            <div id="shareholders-container">
                @foreach($merchant_details['shareholders'] as $shareholder)
                <div class="shareholder-entry row mb-3">
                    <div class="col-md-4">
                        <label for="shareholderName" class="form-label">Shareholder Name <span class="required-asterisk">*</span></label>
                        <input type="text" class="form-control" name="shareholderName[]" value="{{ $shareholder['title'] }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="shareholderNationality" class="form-label">Shareholder Nationality <span class="required-asterisk">*</span></label>
                        <select class="form-select select2" name="shareholderNationality[]" disabled>
                            <option selected>Select Country</option>
                            @foreach($Country as $country)
                                <option value="{{ $country->id }}" {{ $shareholder['country_id'] == $country->id ? 'selected' : '' }}>{{ $country->country_name }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="shareholderNationality[]" value="{{ $shareholder['country_id'] }}">
                    </div>
                    
                    <div class="col-md-3">
                        <label for="shareholderID" class="form-label">Shareholder QID</label>
                        <input type="text" class="form-control" name="shareholderID[]" value="{{ $shareholder['qid'] }}" readonly>
                    </div>
                    <div class="col-md-1">
                       
                       
                    </div>
                </div>
                @endforeach
            </div>

          
        </div>

        {{-- docuements details section --}}
        <div class="form-section box-container">
            <!-- Document Fields -->
            <h4 class="mb-3">Documents</h4>
           
            @foreach($merchant_details['documents'] as $document)
            <div class="row mb-3">


                <div class="col-md-6">
                    <label for="document_{{ $document['id'] }}" class="form-label">
                
                        @php
                            $titleParts = explode('_', $document['title']); 
                            $documentId = $titleParts[0]; 
                            $secondWord = $titleParts[1] ?? null; 
                            $matchingDocument = $all_documents->firstWhere('id', (int)$documentId);
                            // $inputName = $documentId . ($matchingDocument && $matchingDocument->title === 'QID' && $secondWord ? "_{$secondWord}" : "") . "_document_{$document['id']}";
                            $inputName = "document_" . $documentId;

                            if ($matchingDocument && $matchingDocument->title === 'QID' && $secondWord) {
                                // Append secondWord and document ID for QID
                                $inputName .= "_{$secondWord}_{$document['id']}";
                            } 
                            else {
                                $inputName .= "_{$document['id']}";
                            }

                        @endphp
                
                        @if($matchingDocument)
                            <strong>{{ $matchingDocument->title }}</strong>
                
                            @if($matchingDocument->title === 'QID' && $secondWord)
                                <strong> for <span>{{ $secondWord }}</span> </strong>
                            @endif
                
                            @if($document['status'])
                                <label for="expiry_{{ $document['id'] }}" class="form-label">
                                    (Required)<span class="required-asterisk">*</span> 
                                </label>
                            @endif
                        @endif
                    </label>
                
                    {{-- Display icon next to file input --}}
                    <div class="input-group">
                        <input 
                            type="file" 
                            class="form-control" 
                            id="{{ $inputName }}" 
                            name="{{ $inputName }}" 
                            @if(Str::contains($document['document_type'], 'image'))
                                accept="image/jpeg,image/png,image/jpg,image/gif,image/svg"
                            @else
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.txt"
                            @endif
                            disabled
                        >
                        
                        {{-- Include a hidden field with the existing document path or ID --}}
                        @if(!empty($document['document']))
                            <input type="hidden" name="existing_document_{{ $document['id'] }}" value="{{ $document['document'] }}">
                        @endif
                    
                        {{-- Icon for viewing the document (image) --}}
                        @if(Str::contains($document['document_type'], 'image'))
                            <a href="{{ asset('storage/' . $document['document']) }}" target="_blank" class="input-group-text">
                                <i class="tf-icons ti ti-photo"></i> 
                            </a>
                        @endif
                    </div>
                
                </div>
                

                
                    {{-- Check for individual document expiry requirement --}}
                    @if($matchingDocument && $matchingDocument->require_expiry)
                    <div class="col-md-6">
                        <label for="expiry_{{ $document['id'] }}" class="form-label">
                            Expiry Date (Required)<span class="required-asterisk">*</span> 
                        </label>
                        <div class="input-group">
                            <input 
                                type="date" 
                                class="form-control" 
                                id="expiry_{{ $document['id'] }}" 
                                name="expiry_{{ $document['id'] }}" 
                                value="{{ $document['date_expiry'] }}" 
                                required
                            >
                        </div>
                    </div>
                    @endif


            
        
            </div>
            @endforeach

        </div>

        <!-- Sales Data Section -->
        <div class="form-section box-container">
        <h4 class="mb-3">Sales Data</h4>
    
        @foreach($merchant_details['sales'] as $index => $sale)
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="minTransactionAmount_{{ $index }}" class="form-label">Min Transaction Amount <span class="required-asterisk">*</span></label>
                <input type="number" class="form-control" id="minTransactionAmount_{{ $index }}" name="sales[{{ $index }}][minTransactionAmount]" value="{{ $sale['min_transaction_amount'] }}" readonly>
            </div>
            <div class="col-md-6">
                <label for="monthlyLimitAmount_{{ $index }}" class="form-label">Monthly Limit Amount <span class="required-asterisk">*</span></label>
                <input type="number" class="form-control" id="monthlyLimitAmount_{{ $index }}" name="sales[{{ $index }}][monthlyLimitAmount]" value="{{ $sale['monthly_limit_amount'] }}" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="maxTransactionAmount_{{ $index }}" class="form-label">Max Transaction Amount <span class="required-asterisk">*</span></label>
                <input type="number" class="form-control" id="maxTransactionAmount_{{ $index }}" name="sales[{{ $index }}][maxTransactionAmount]" value="{{ $sale['max_transaction_amount'] }}" readonly>
            </div>
            <div class="col-md-6">
                <label for="maxTransactionCount_{{ $index }}" class="form-label">Max Transaction Count/Day <span class="required-asterisk">*</span></label>
                <input type="number" class="form-control" id="maxTransactionCount_{{ $index }}" name="sales[{{ $index }}][maxTransactionCount]" value="{{ $sale['max_transaction_count'] }}" readonly>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="dailyLimitAmount_{{ $index }}" class="form-label">Daily Limit Amount <span class="required-asterisk">*</span></label>
                <input type="number" class="form-control" id="dailyLimitAmount_{{ $index }}" name="sales[{{ $index }}][dailyLimitAmount]" value="{{ $sale['daily_limit_amount'] }}" readonly>
            </div>
        </div>
        @endforeach
        </div>
            
        {{-- services --}}
        <div class="form-section box-container">
            <!-- Services Section -->
            @foreach($services as $service)
            <div class="form-section box-container">
                <h4 class="mb-3">{{ ucfirst($service['name']) }}</h4>
        
                <!-- Display the fields for each service -->
                @php
                    $fields = json_decode($service['fields'], true);
                @endphp
        
                @if($fields)
                    @foreach($fields as $index => $field)
                    <div class="mb-3">
                        <label for="service_{{ $service['id'] }}_field_{{ $index }}" class="form-label">{{ ucfirst($field) }}</label>
                        <input type="text" 
                               class="form-control" 
                               id="service_{{ $service['id'] }}_field_{{ $index }}" 
                               name="services[{{ $service['id'] }}][fields][{{ $index }}]"
                               value="{{ isset($merchant_details['services'][$index]['field_value']) ? $merchant_details['services'][$index]['field_value'] : '' }}"
                               placeholder="{{ ucfirst($field) }}"
                               readonly> <!-- Added readonly here -->
                    </div>
                    @endforeach
                @endif
        
            </div>
            @endforeach
        </div>
        
        <div class="d-flex justify-content-end mt-4">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>
        
</div>

@endsection




</script>