<style>
  .subcategory-input {
      display: flex;
      align-items: center;
      margin-top: 10px;
  }

  .subcategory-input input {
      flex: 1;
      margin-right: 10px;
  }

  .subcategory-input .clear-input {
      background: transparent;
      border: none;
      font-size: 20px;
      line-height: 1;
      cursor: pointer;
      color: #999;
  }

  .subcategory-input .clear-input:hover {
      color: #333;
  }

  .add-subcategory {
      background: transparent;
      border: none;
      font-size: 20px;
      cursor: pointer;
      color: #28a745;
  }

  .add-subcategory:hover {
      color: #1c7430;
  }

      /* Optional: Custom styling for the Select2 component */
      .select2-container--default .select2-selection--multiple {
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
    }
</style>


<div class="card mb-6">
    <div class="card-header">
      <h5 class="card-tile mb-0">Product information</h5>
    </div>
    <div class="card-body">
      <div class="mb-6">
        <label class="form-label" for="ecommerce-product-name">Name</label>
        <input
          type="text"
          class="form-control"
          id="ecommerce-product-name"
          placeholder="Product title"
          name="productTitle"
          aria-label="Product title" />
      </div>
      <div class="row mb-6">
        <div class="col">
          <label class="form-label" for="ecommerce-product-sku">SKU</label>
          <input
            type="number"
            class="form-control"
            id="ecommerce-product-sku"
            placeholder="SKU"
            name="productSku"
            aria-label="Product SKU" />
        </div>
        <div class="col">
          <label class="form-label" for="ecommerce-product-barcode">Barcode</label>
          <input
            type="text"
            class="form-control"
            id="ecommerce-product-barcode"
            placeholder="0123-4567"
            name="productBarcode"
            aria-label="Product barcode" />
        </div>
      </div>

      <div class="row mb-6">
        
          <div class="col">
              <label class="form-label" for="ecommerce-category">Category </label>
              <select
                  id="ecommerce-category"
                  class="select2 form-select"
                  data-placeholder="Select a category">
                  <option value="">Select a category</option>
                  <option value="Household">Household</option>
                  <option value="Management">Management</option>
                  <option value="Electronics">Electronics</option>
                  <option value="Office">Office</option>
                  <option value="Automotive">Automotive</option>
              </select>
          </div>
            <div class="col">
                <label class="form-label" for="ecommerce-subcategories">Subcategories</label>
                <select
                    id="ecommerce-subcategories"
                    class="select2 form-select"
                    multiple="multiple"
                    data-placeholder="Select subcategories">
                    <option value="Household">Household</option>
                    <option value="Management">Management</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Office">Office</option>
                    <option value="Automotive">Automotive</option>
                </select>
            </div>
       </div>
    

       <div class="row mb-6">
        <div class="col">
            <label class="form-label" for="ecommerce-tags">Tags</label>
            <select
                id="ecommerce-tags"
                class="select2 form-select"
                multiple="multiple"
                data-placeholder="Select tags">
                <option value="Tag1">Tag1</option>
                <option value="Tag2">Tag2</option>
                <option value="Tag3">Tag3</option>
                <option value="Tag4">Tag4</option>
                <option value="Tag5">Tag5</option>
            </select>
        </div>
    </div>
    
      <!-- Description -->
<!-- Description -->
<div class="mb-6">
    <label class="form-label" for="ecommerce-product-description">Description</label>
    <div id="ecommerce-product-description" class="form-control" style="height: 200px;"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Quill editor
        var quill = new Quill('#ecommerce-product-description', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'font': [] }, { 'size': [] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'script': 'super' }, { 'script': 'sub' }],
                    [{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'indent': '-1' }, { 'indent': '+1' }, { 'align': [] }],
                    ['link', 'image', 'video'],
                    ['clean']
                ]
            }
        });
    });
</script>

<!-- Include Quill CSS and JS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>


    
    </div>
  </div>


  <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Select2 for the tags input
        $('#ecommerce-tags').select2();
    });


    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Select2 for multiple subcategory selection
        $('#ecommerce-subcategories').select2();

        // Event listener for the "+" button to add more subcategories
        document.getElementById('add-subcategory').addEventListener('click', function() {
            // Create and append a new subcategory input field
            const container = document.createElement('div');
            container.className = 'subcategory-input';
            container.innerHTML = `
                <input type="text" class="form-control" placeholder="Enter subcategory" name="subcategories[]">
                <button type="button" class="clear-input">&times;</button>
            `;
            document.querySelector('.row.mb-6').appendChild(container);
        });

        // Event delegation to handle removing subcategory inputs
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('clear-input')) {
                event.target.parentElement.remove();
            }
        });
    });
</script>
