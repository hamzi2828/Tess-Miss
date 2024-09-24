<div class="card mb-6">
                    
    <div class="card-body">


      <!-- Bundle Section -->
      <div class="d-flex flex-column w-100 mt-4" id="bundle-container">
        <h5 class="card-title mb-3">Product Bundle</h5>
        <div class="d-flex gap-4 align-items-center mb-6 col ecommerce-select2-dropdown" id="bundle-field-1">
            <div class="d-flex flex-column w-100">
                <label class="form-label mb-1" for="bundle-1">Bundle</label>
                <select id="bundle-1" class="select2 form-select w-100" data-placeholder="Select Bundle">
                    <option value="">Select Bundle</option>
                    <option value="bundle-1">Buy 1</option>
                    <option value="bundle-2">Buy 2</option>
                    <option value="bundle-3">Buy 3</option>
                </select>
            </div>

            <div class="d-flex flex-column w-100">
                <label class="form-label mb-1" for="bundle-discount-1">Discount (%)</label>
                <input type="number" id="bundle-discount-1" class="form-control w-100" placeholder="Enter discount percentage">
            </div>
            <a href="javascript:void(0);" class="mt-5 fw-medium btn btn-icon btn-label-primary ms-4" id="add-bundle">
                <i class="ti ti-plus ti-md"></i>
            </a>
        </div>
    </div>
    </div>
</div>

<!-- Include Select2 CSS and JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize Select2 on the initial vendor and bundle dropdowns
    $('.select2').select2();

    // Counter for dynamically added vendor and bundle fields
    let bundleCounter = 1;

    // Event listener for adding new bundle fields
    $('#add-bundle').on('click', function() {
        const numberOfBundles = $('#bundle-container .ecommerce-select2-dropdown').length;
        if (numberOfBundles < 3) {
            bundleCounter++;
            const newBundleField = `
                <div class="d-flex gap-4 align-items-center mb-6 col ecommerce-select2-dropdown" id="bundle-field-${bundleCounter}">
                    <div class="d-flex flex-column w-100">
                        <label class="form-label mb-1" for="bundle-${bundleCounter}">Bundle</label>
                        <select id="bundle-${bundleCounter}" class="select2 form-select w-100" data-placeholder="Select Bundle">
                            <option value="">Select Bundle</option>
                            <option value="bundle-1">Buy 1</option>
                            <option value="bundle-2">Buy 2</option>
                            <option value="bundle-3">Buy 3</option>
                        </select>
                    </div>

                    <div class="d-flex flex-column w-100">
                        <label class="form-label mb-1" for="bundle-discount-${bundleCounter}">Discount (%)</label>
                        <input type="number" id="bundle-discount-${bundleCounter}" class="form-control w-100" placeholder="Enter discount percentage">
                    </div>
                    <a href="javascript:void(0);" class="mt-5 fw-medium btn btn-icon btn-label-danger ms-4 delete-bundle">
                        <i class="ti ti-trash ti-md"></i>
                    </a>
                </div>
            `;
            $('#bundle-container').append(newBundleField);
            $('#bundle-' + bundleCounter).select2();
        } else {
            alert('You can only add up to 5 bundles.');
        }
    });

    // Event delegation to handle dynamic delete buttons for bundles
    $('#bundle-container').on('click', '.delete-bundle', function() {
        $(this).closest('.ecommerce-select2-dropdown').remove();
    });
});
</script>


</div>