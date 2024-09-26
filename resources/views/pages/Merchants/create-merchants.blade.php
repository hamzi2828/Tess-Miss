@extends('master.master')

@section('content')

<!-- Include Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    
<div class="container-xxl flex-grow-1 container-p-y">
 
    
    <form class="kyc-form">
        <!-- Basic Details Section -->
        <div class="form-section box-container">
            
            
              <!-- Step-based Progress Bar -->
              @include('pages.merchants.components.progressBar')
            
            
            
            <h4 class="mb-3">Basic Details</h4>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="merchantName" class="form-label">Merchant Name <span class="required-asterisk">*</span></label>
                    <input type="text" class="form-control" id="merchantName" required>
                </div>
                
                <div class="col-md-6">
                    <label for="dateOfIncorporation" class="form-label">Date of Incorporation <span class="required-asterisk">*</span></label>
                    <input type="date" class="form-control" id="dateOfIncorporation" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="merchantArabicName" class="form-label">Merchant Arabic Name <span class="required-asterisk">*</span></label>
                    <input type="text" class="form-control" id="merchantArabicName" required>
                </div>
                <div class="col-md-6">
                    <label for="companyRegistration" class="form-label">Company Registration <span class="required-asterisk">*</span></label>
                    <input type="text" class="form-control" id="companyRegistration" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="companyAddress" class="form-label">Registered Company Address/Details <span class="required-asterisk">*</span></label>
                <textarea class="form-control" id="companyAddress" rows="3" required></textarea>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="mobileNumber" class="form-label">Mobile Number <span class="required-asterisk">*</span></label>
                    <input type="tel" class="form-control" id="mobileNumber" required>
                </div>
                <div class="col-md-6">
                    <label for="companyActivities" class="form-label">Company Principal Activities <span class="required-asterisk">*</span></label>
                    <select class="form-select" id="companyActivities" required>
                        <option selected>Select Activities</option>
                        <!-- Add options here -->
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="landlineNumber" class="form-label">Landline Number <span class="required-asterisk">*</span></label>
                    <input type="tel" class="form-control" id="landlineNumber" required>
                </div>
                <div class="col-md-6">
                    <label for="website" class="form-label">Website</label>
                    <input type="url" class="form-control" id="website">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email <span class="required-asterisk">*</span></label>
                    <input type="email" class="form-control" id="email" required>
                </div>
                <div class="col-md-6">
                    <label for="monthlyWebsiteVisitors" class="form-label">Monthly Website Visitors</label>
                    <input type="number" class="form-control" id="monthlyWebsiteVisitors">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="keyPointOfContact" class="form-label">Key Point of Contact <span class="required-asterisk">*</span></label>
                    <input type="text" class="form-control" id="keyPointOfContact" required>
                </div>
                <div class="col-md-6">
                    <label for="monthlyActiveUsers" class="form-label">Monthly Active Users</label>
                    <input type="number" class="form-control" id="monthlyActiveUsers">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="keyPointMobile" class="form-label">Key Point Mobile <span class="required-asterisk">*</span></label>
                    <input type="tel" class="form-control" id="keyPointMobile" required>
                </div>
                <div class="col-md-6">
                    <label for="monthlyAvgVolume" class="form-label">Monthly Average Volume (QAR)</label>
                    <input type="number" class="form-control" id="monthlyAvgVolume">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="existingBankingPartner" class="form-label">Existing Banking Partner</label>
                    <input type="text" class="form-control" id="existingBankingPartner">
                </div>
                <div class="col-md-6">
                    <label for="monthlyAvgTransactions" class="form-label">Monthly Average No. Of Transactions <span class="required-asterisk">*</span></label>
                    <input type="number" class="form-control" id="monthlyAvgTransactions" required>
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
                        <select class="form-select" name="shareholderNationality[]" required>
                            <option selected>Select Country</option>
                            <!-- Add options here -->
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
                <button type="button" id="add-shareholder-btn" class="btn btn-success">
                    + Add Shareholder
                </button>
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
                    <label for="shareholderNationality" class="form-label">Shareholder Nationality *</label>
                    <select class="form-select" name="shareholderNationality[]" required>
                        <option selected>Select Country</option>
                        <!-- Add options here -->
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="shareholderID" class="form-label">Shareholder GID</label>
                    <input type="text" class="form-control" name="shareholderID[]">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger remove-btn">
                        <i class="fas fa-trash"></i> <!-- Trash bin icon -->
                    </button>
                </div>
            `;
            
            // Append the new shareholder entry to the container
            shareholdersContainer.appendChild(newShareholder);
            
            // Add functionality to remove the newly added shareholder
            newShareholder.querySelector('.remove-btn').addEventListener('click', function() {
                shareholdersContainer.removeChild(newShareholder);
            });
        });
    });
</script>