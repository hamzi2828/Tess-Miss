<!-- Include jQuery and jQuery Repeater CSS/JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/repeater.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
<!-- Include FontAwesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />


  <style>
    .group-header {
      background-color: #f9f9f9;
      cursor: pointer;
    }

  .group-header button {
    background: none;
    border: none;
    font-size: 1.1em;
    text-align: left;
    width: 100%;
  }

  .group-header i {
    margin-right: 5px;
  }

  .group-body td {
    padding: 5px 10px;
  }

  .btn-remove-field {
    margin-left: 10px;
  }

  .btn-remove-field i {
    color: #dc3545;
  }

  .table {
    width: 100%;
    border-collapse: collapse;
  }

  .table th, .table td {
    border: 1px solid #dee2e6;
    padding: 8px;
    text-align: left;
  }

  .input-group {
      display: flex;
    }
    .input-group .btn {
      margin-left: -1px;
    }
/* Hide the default file input */
.upload-images {
    display: none;
}

/* Style the label to act as a custom button */
.upload-button {
    display: inline-block;
    cursor: pointer;
    padding: 5px 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    background-color: #f8f9fa;
    text-align: center;
}

/* Style the icon inside the label */
.upload-button i {
    font-size: 1.2em;
    color: #007bff; /* Or any color you prefer */
}

/* Image preview container */
.image-preview {
    margin-top: 5px;
}

</style>


<div class="card mb-6">
  <div class="card-header">
    <h5 class="card-title mb-0">Variants</h5>
  </div>
  <div class="card-body">
    <div class="form-repeater">
      <div data-repeater-list="group-a">
        <div data-repeater-item>
          <div class="row">
            <div class="mb-6 col-4">
              <label class="form-label">Variants</label>
              <input type="text" class="form-control" placeholder="Enter variant" />
            </div>
            <div class="mb-6 col-6">
              <label class="form-label invisible">Options</label>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Enter options " />
                <button type="button" class="btn btn-outline-secondary" data-add-field>
                  <i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
            <div class="col-2 mt-2 d-flex align-items-center">
              <button data-repeater-delete type="button" class="btn btn-danger">
                <i class="fas fa-trash-alt"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div>
        <button class="btn btn-primary" data-repeater-create>
          <i class="ti ti-plus ti-xs me-2"></i>
          Add another Variant 
        </button>
      </div>
    </div>

  </div>
</div>



<!-- Initialize the jQuery Repeater -->
<script>

$(document).ready(function() {
    var maxVariants = 3; // Maximum number of variants allowed

    // Function to compute Cartesian product of multiple arrays
    function cartesianProduct(arr) {
        return arr.reduce((a, b) => a.flatMap(d => b.map(e => [d, e].flat())));
    }

    // Function to update the table rows based on the variants and options
    function updateTableRows() {
        var $tableBody = $('#options-table-body');
        $tableBody.empty();

        var allOptions = [];

        // Collect options for each variant
        $('.form-repeater [data-repeater-item]').each(function() {
            var options = [];
            $(this).find('.input-group').each(function() {
                var variantOptions = $(this).find('input').val().split(',').map(option => option.trim()).filter(option => option);
                if (variantOptions.length) {
                    options.push(variantOptions);
                }
            });
            if (options.length) {
                allOptions.push(options);
            }
        });
        if (allOptions.length === 1) {
            // Handle case when there is only one variant
            var singleVariantOptions = allOptions[0];
            singleVariantOptions.forEach(function(option) {
                $tableBody.append(`
                    <tr>
                        <td>${option}</td> 
                        <td><input type="text" class="form-control" placeholder="Base Price" /></td>
                        <td><input type="text" class="form-control" placeholder="Sale Price" /></td>
                        <td><input type="text" class="form-control" placeholder="Enter stock" /></td>    
                        <td><input type="text" class="form-control" placeholder="Enter sku" /></td>  
                        <td>
                              <label class="upload-button">
                                <i class="fas fa-upload"></i>
                                <input type="file" class="upload-images" accept="image/*" multiple />
                                <div class="image-preview"></div>
                            </label>
                        </td>
                    </tr>
                `);
            });
        }
        // Check if there are at least two sets of options
        if (allOptions.length >= 2) {
            var firstVariantOptions = allOptions[0];
            var restVariantOptions = allOptions.slice(1);

            // Generate Cartesian product of the rest of the options
            var combinations = cartesianProduct(restVariantOptions);

            // Append each group and its combinations to the table
            firstVariantOptions.forEach(function(firstOption) {
                var $groupRow = $(`
                    <tr class="group-header">
                      <td colspan="5">
                        <button class="toggle-group">
                          <i class="fas fa-chevron-right"></i> ${firstOption}
                        </button>
                      </td>
                    </tr>
                `);
                $tableBody.append($groupRow);

                var $groupBody = $('<tbody class="group-body" style="display: none;"></tbody>');
                combinations.forEach(function(combination) {
                    $groupBody.append(`
                      <tr>
                        <td>${firstOption}-${combination.join('- ')}</td>
                        <td><input type="text" class="form-control" placeholder="Base Price" /></td>
                        <td><input type="text" class="form-control" placeholder="Sale Price" /></td>
                        <td><input type="text" class="form-control" placeholder="Enter stock" /></td> 
                        <td><input type="text" class="form-control" placeholder="Enter sku" /></td> 
                        <td>
                           <label class="upload-button">
                                <i class="fas fa-upload"></i>
                                <input type="file" class="upload-images" accept="image/*" multiple />
                                <div class="image-preview"></div>
                            </label>
                        </td>
                      </tr>
                    `);
                });
                $tableBody.append($groupBody);
            });

            // Add event listener for toggle buttons
            $('.toggle-group').off('click').on('click', function() {
                var $icon = $(this).find('i');
                $icon.toggleClass('fa-chevron-right fa-chevron-down');
                $(this).closest('tr').next('.group-body').toggle();
            });
        }
    }

    // Initialize the repeater with show and hide functionality
    $('.form-repeater').repeater({
        show: function() {
            $(this).slideDown();
            updateTableRows();
            updatePlusButtonVisibility('add'); // Pass 'add' when showing
        },
        hide: function(deleteElement) {
            $(this).slideUp(deleteElement);
            updateTableRows();
            updatePlusButtonVisibility('delete'); // Pass 'delete' when hiding
        }
    });

    // Function to add a new variant
    function addVariant() {
        $('[data-repeater-create]').trigger('click');
    }

    // Function to add a new option field under the clicked variant
    function addOptionField(button) {
        var $inputGroup = $(button).closest('.input-group').clone();
        $inputGroup.find('input').val('');
        $inputGroup.find('[data-add-field]').remove();
        $inputGroup.append(`
            <button type="button" class="btn btn-outline-danger btn-remove-field">
              <i class="fas fa-minus"></i>
            </button>
        `);
        $(button).closest('[data-repeater-item]').find('.input-group').last().after($inputGroup);

        updateTableRows();
        updatePlusButtonVisibility('add'); // Ensure 'add' is passed
    }

    // Function to remove a variant field
    function removeVariant(button) {
        $(button).closest('[data-repeater-item]').remove();
        updateTableRows();
        updatePlusButtonVisibility('delete'); // Ensure 'delete' is passed
    }

    // Function to remove a variant option field
    function removeOptionField(button) {
        $(button).closest('.input-group').remove();
        updateTableRows();
        updatePlusButtonVisibility('delete'); // Ensure 'delete' is passed
    }

    // Event handler to add new option field
    $(document).on('click', '[data-add-field]', function() {
        addOptionField(this);
    });

    // Event handler to remove variant field
    $(document).on('click', '[data-repeater-delete]', function() {
        removeVariant(this);
    });

    // Event handler to remove option field
    $(document).on('click', '.btn-remove-field', function() {
        removeOptionField(this);
    });

    // Function to update the visibility of the "add" button
    function updatePlusButtonVisibility(action) {
        var rowCount = $('.form-repeater [data-repeater-item]').length;

        // Log the rowCount and action to verify
        console.log('RowCount:', rowCount, 'Action:', action);

        if (action === 'add') {
            // Disable button if maxVariants is reached
            if (rowCount >= maxVariants) {
                $('[data-repeater-create]').prop('disabled', true);
            }
        } else if (action === 'delete') {
            // Enable button if rowCount is less than maxVariants
            if (rowCount < maxVariants) {
                $('[data-repeater-create]').prop('disabled', false);
            }
        } else {
            console.warn('Unknown action:', action);
        }
    }

    // Initial function calls to set up the page
    updateTableRows();
    updatePlusButtonVisibility(); // Initial call to set button visibility correctly

    // Trigger table update on input change
    $(document).on('input', '.form-repeater input', function() {
        updateTableRows();
    });

    // Function to handle image preview
    $(document).on('change', '.upload-images', function() {
        var $imagePreview = $(this).next('.image-preview');
        $imagePreview.empty();

        var files = this.files;
        if (files.length > 4) {
            alert('You can upload up to 4 images.');
            $(this).val(''); // Clear the input if more than 4 images are selected
            return;
        }

        Array.from(files).forEach(file => {
            var reader = new FileReader();
            reader.onload = function(e) {
                $imagePreview.append(`
                    <img src="${e.target.result}" alt="Image Preview"
                     style=" height: 50px; margin: 5px; border: 1px solid #ddd; padding: 2px;" />
                `);
            };
            reader.readAsDataURL(file);
        });
    });
});



</script>

