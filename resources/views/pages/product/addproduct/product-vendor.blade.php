<div class="card mb-6">
    
    <div class="card-header">



      <h5 class="card-title mb-0">Product Vendor</h5>
    </div>
    <div class="card-body">
  
      <!-- Vendor -->
      <div class="d-flex flex-column w-100" id="vendor-container">
          <div class="d-flex gap-4 align-items-center mb-6 col ecommerce-select2-dropdown" id="vendor-field-1">
              <div class="d-flex flex-column w-100">
                  <label class="form-label mb-1" for="vendor-1">Vendor</label>
                  <select id="vendor-1" class="select2 form-select w-100" data-placeholder="Select Vendor">
                      <option value="">Select Vendor</option>
                      <option value="men-clothing">Men's Clothing</option>
                      <option value="women-clothing">Women's Clothing</option>
                      <option value="kid-clothing">Kid's Clothing</option>
                  </select>
              </div>
              <div class="d-flex flex-column w-100">
                  <label class="form-label mb-1" for="vendor-input-1">Vendor Input</label>
                  <input type="text" id="vendor-input-1" class="form-control w-100" placeholder="Enter vendor input">
              </div>
              <a href="javascript:void(0);" class="mt-5 fw-medium btn btn-icon btn-label-primary ms-4" id="add-vendor">
                  <i class="ti ti-plus ti-md"></i>
              </a>
          </div>
      </div>
      
      <!-- Include Select2 CSS and JS -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
      
  <script>
   $(document).ready(function() {
      // Initialize Select2 on the initial vendor dropdown
      $('.select2').select2();
  
      // Counter for dynamically added vendor fields
      let counter = 1;
  
      // Event listener for adding new vendor fields
      $('#add-vendor').on('click', function() {
          // Get the current number of vendor fields
          const numberOfVendors = $('#vendor-container .ecommerce-select2-dropdown').length;
  
          // Check if the number of vendors is less than the maximum allowed
          if (numberOfVendors < 3) {
              counter++; // Increment counter
  
              // Create new vendor field HTML with delete button
              const newVendorField = `
                  <div class="d-flex gap-4 align-items-center mb-6 col ecommerce-select2-dropdown" id="vendor-field-${counter}">
                      <div class="d-flex flex-column w-100">
                          <label class="form-label mb-1" for="vendor-${counter}">Vendor</label>
                          <select id="vendor-${counter}" class="select2 form-select w-100" data-placeholder="Select Vendor">
                              <option value="">Select Vendor</option>
                              <option value="men-clothing">Men's Clothing</option>
                              <option value="women-clothing">Women's Clothing</option>
                              <option value="kid-clothing">Kid's Clothing</option>
                          </select>
                      </div>
                      <div class="d-flex flex-column w-100">
                          <label class="form-label mb-1" for="vendor-input-${counter}">Vendor Input</label>
                          <input type="text" id="vendor-input-${counter}" class="form-control w-100" placeholder="Enter vendor input">
                      </div>
                      <a href="javascript:void(0);" class="mt-5 fw-medium btn btn-icon btn-label-danger ms-4 delete-vendor">
                          <i class="ti ti-trash ti-md"></i>
                      </a>
                  </div>
              `;
  
              // Append new vendor field below the last one
              $('#vendor-container').append(newVendorField);
  
              // Reinitialize Select2 for newly added vendor field
              $('#vendor-' + counter).select2();
          } else {
              alert('You can only add up to 5 vendors.');
          }
      });
  
      // Event delegation to handle dynamic delete buttons
      $('#vendor-container').on('click', '.delete-vendor', function() {
          $(this).closest('.ecommerce-select2-dropdown').remove();
      });
  });
  
  
  </script>

    </div>
  </div>