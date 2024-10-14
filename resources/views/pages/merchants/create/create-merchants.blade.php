@extends('master.master')

@section('content')


    
<div class="container-xxl flex-grow-1 container-p-y">
 
    
   <!-- Update the form to POST and set the action to the correct route -->
    <form class="kyc-form" action="{{ route('store.merchants.kyc') }}" method="POST">
        @csrf <!-- This is important for Laravel's CSRF protection -->

        <!-- Basic Details Section -->
        <div class="form-section box-container">

            <!-- Step-based Progress Bar -->
            @include('pages.merchants.components.progressBar')

            <h4 class="mb-3">Basic Details</h4>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="merchantName" class="form-label">Merchant Name <span class="required-asterisk">*</span></label>
                    <input type="text" class="form-control" id="merchantName" name="merchant_name" required>
                </div>

                <div class="col-md-6">
                    <label for="dateOfIncorporation" class="form-label">Date of Incorporation <span class="required-asterisk">*</span></label>
                    <input type="date" class="form-control" id="dateOfIncorporation" name="date_of_incorporation" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="merchantArabicName" class="form-label">Merchant Arabic Name <span class="required-asterisk">*</span></label>
                    <input type="text" class="form-control" id="merchantArabicName" name="merchant_arabic_name" required>
                </div>

                <div class="col-md-6">
                    <label for="companyRegistration" class="form-label">Company Registration <span class="required-asterisk">*</span></label>
                    <input type="text" class="form-control" id="companyRegistration" name="company_registration" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="companyAddress" class="form-label">Registered Company Address/Details <span class="required-asterisk">*</span></label>
                <textarea class="form-control" id="companyAddress" name="company_address" rows="3" required></textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="mobileNumber" class="form-label">Mobile Number <span class="required-asterisk">*</span></label>
                    <input type="tel" class="form-control" id="mobileNumber" name="mobile_number" required>
                </div>

                <div class="col-md-6">
                    <label for="companyActivities" class="form-label">Company Principal Activities <span class="required-asterisk">*</span></label>
                    <select class="form-select select2" id="companyActivities" name="company_activities" required>
                        <option selected>Select Activities</option>
                        @foreach($MerchantCategory as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="landlineNumber" class="form-label">Landline Number <span class="required-asterisk">*</span></label>
                    <input type="tel" class="form-control" id="landlineNumber" name="landline_number" required>
                </div>

                <div class="col-md-6">
                    <label for="website" class="form-label">Website</label>
                    <input type="url" class="form-control" id="website" name="website">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email <span class="required-asterisk">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="col-md-6">
                    <label for="monthlyWebsiteVisitors" class="form-label">Monthly Website Visitors</label>
                    <input type="number" class="form-control" id="monthlyWebsiteVisitors" name="monthly_website_visitors">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="keyPointOfContact" class="form-label">Key Point of Contact <span class="required-asterisk">*</span></label>
                    <input type="text" class="form-control" id="keyPointOfContact" name="key_point_of_contact" required>
                </div>

                <div class="col-md-6">
                    <label for="monthlyActiveUsers" class="form-label">Monthly Active Users</label>
                    <input type="number" class="form-control" id="monthlyActiveUsers" name="monthly_active_users">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="keyPointMobile" class="form-label">Key Point Mobile <span class="required-asterisk">*</span></label>
                    <input type="tel" class="form-control" id="keyPointMobile" name="key_point_mobile" required>
                </div>

                <div class="col-md-6">
                    <label for="monthlyAvgVolume" class="form-label">Monthly Average Volume (QAR)</label>
                    <input type="number" class="form-control" id="monthlyAvgVolume" name="monthly_avg_volume">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="existingBankingPartner" class="form-label">Existing Banking Partner</label>
                    <input type="text" class="form-control" id="existingBankingPartner" name="existing_banking_partner">
                </div>

                <div class="col-md-6">
                    <label for="monthlyAvgTransactions" class="form-label">Monthly Average No. Of Transactions <span class="required-asterisk">*</span></label>
                    <input type="number" class="form-control" id="monthlyAvgTransactions" name="monthly_avg_transactions" required>
                </div>
            </div>
        </div>

        <!-- Shareholders Section with Add Button -->
        <div class="form-section box-container">
            <h4 class="mb-3">Shareholders</h4>

            <!-- Container for all shareholders -->
            <div id="shareholders-container">
                <div class="shareholder-entry row mb-3">
                    <div class="col-md-4">
                        <label for="shareholderName" class="form-label">Shareholder Name <span class="required-asterisk">*</span></label>
                        <input type="text" class="form-control" name="shareholderName[]" required>
                    </div>
                    <div class="col-md-4">
                        <label for="shareholderNationality" class="form-label">Shareholder Nationality <span class="required-asterisk">*</span></label>
                        <select class="form-select select2" id="shareholderNationality" name="shareholderNationality[]" required>
                       
                            <option selected>Select Country</option>
                            @foreach($Country as $country) <!-- Loop through each country -->
                                <option value="{{ $country['id'] }}">{{ $country['country_name'] }}</option> <!-- Use array syntax to access country fields -->
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="shareholderID" class="form-label">Shareholder GID</label>
                        <input type="text" class="form-control" name="shareholderID[]">
                    </div>
                </div>
            </div>

            <!-- Add Shareholder Button -->
            <div class="text-end">
                <button type="button" id="add-shareholder-btn" class="btn btn-success">+ Add Shareholder</button>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Save & Proceed</button>
        </div>
    </form>
</div>

@endsection

<script>

    // JavaScript to handle the Add Shareholder functionality
  // JavaScript to handle the Add Shareholder functionality
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('add-shareholder-btn').addEventListener('click', function() {
        const shareholdersContainer = document.getElementById('shareholders-container');
        
        // Create new shareholder input group
        const newShareholder = document.createElement('div');
        newShareholder.classList.add('shareholder-entry', 'row', 'mb-3');
        
        newShareholder.innerHTML = `
            <div class="col-md-4">
                <label for="shareholderName" class="form-label">Shareholder Name *</label>
                <input type="text" class="form-control" name="shareholderName[]" required>
            </div>
            <div class="col-md-4">
                <label for="shareholderNationality" class="form-label">Shareholder Nationality <span class="required-asterisk">*</span></label>
                <select class="form-select select2" name="shareholderNationality[]" required>
                    <option selected>Select Country</option>
                    @foreach($Country as $country)
                        <option value="{{ $country['id'] }}">{{ $country['country_name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="shareholderID" class="form-label">Shareholder GID</label>
                <input type="text" class="form-control" name="shareholderID[]">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger remove-btn" style="margin-top: 25px">
                    <i class="fas fa-trash"></i> <!-- Trash bin icon -->
                </button>
            </div>
        `;
        
        // Append the new shareholder entry to the container
        shareholdersContainer.appendChild(newShareholder);
        
        // Reinitialize Select2 on the newly added select element
        $(newShareholder).find('.select2').select2({
            placeholder: 'Select Country',
            allowClear: true
        });
        
        // Add functionality to remove the newly added shareholder
        newShareholder.querySelector('.remove-btn').addEventListener('click', function() {
            shareholdersContainer.removeChild(newShareholder);
        });
    });

    // Initialize Select2 on the initial page load for existing selects
    $('#companyActivities, #shareholderNationality').select2({
        placeholder: 'Select Country',
        allowClear: true
    });
});

</script>