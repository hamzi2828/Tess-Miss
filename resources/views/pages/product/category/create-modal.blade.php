<style>
    .ecommerce-select2-dropdown {
        position: relative;
    }

    .clear-input,
    .add-subcategory {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        font-size: 20px;
        line-height: 1;
        cursor: pointer;
        color: #999;
    }

    .clear-input:hover,
    .add-subcategory:hover {
        color: #333;
    }

    .clear-input {
        right: 10px;
    }

    .add-subcategory {
        right: 10px;
        color: #28a745;
    }

    .subcategory-input {
        position: relative;
        margin-bottom: 10px;
    }

    .subcategory-input input {
        width: calc(100% - 60px); /* Adjust to accommodate the clear and add buttons */
    }

    .app-ecommerce-category .comment-editor .ql-editor, 
    .app-ecommerce .comment-editor .ql-editor {
        max-height: 50px;
    }
</style>

<!-- Form HTML -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEcommerceCategoryList" aria-labelledby="offcanvasEcommerceCategoryListLabel">
    <div class="offcanvas-header py-6">
        <h5 id="offcanvasEcommerceCategoryListLabel" class="offcanvas-title">Add Category</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body border-top">
        <form class="pt-0" id="eCommerceCategoryListForm" method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label class="form-label" for="ecommerce-category-title">Title</label>
                <input type="text" class="form-control" id="ecommerce-category-title" placeholder="Enter category title" name="categoryTitle" aria-label="category title" required />
            </div>
            <div class="mb-6">
                <label class="form-label" for="ecommerce-category-slug">Slug</label>
                <input type="text" id="ecommerce-category-slug" class="form-control" placeholder="Enter slug" aria-label="slug" name="slug" required />
            </div>
            <div class="mb-6">
                <label class="form-label" for="ecommerce-category-image">Attachment</label>
                <input class="form-control" type="file" id="ecommerce-category-image" name="image" />
            </div>

            <div class="mb-6 ecommerce-select2-dropdown">
                <label class="form-label" for="ecommerce-category-sub-category">Subcategories</label>
                <div id="subcategory-container">
                    <div class="subcategory-input">
                        <input type="text" id="ecommerce-category-sub-category-0" class="form-control" placeholder="Enter subcategory" name="parentCategory[]">
                        <button type="button" class="add-subcategory">+</button>
                    </div>
                </div>
            </div>



            <div class="mb-6">
                <label class="form-label">Description</label>
                <textarea class="form-control" id="ecommerce-category-description" name="description"></textarea>
            </div>


            
            <div class="mb-6 ecommerce-select2-dropdown">
                <label class="form-label">Select category status</label>
                <select id="ecommerce-category-status" class="select2 form-select" data-placeholder="Select category status" name="status">
                    <option value="">Select category status</option>
                    <option value="Publish">Publish</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
            <div class="mb-6">
                <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Add</button>
                <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Discard</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let quill = new Quill('#description-editor', {
            theme: 'snow'
        });

        let form = document.getElementById('eCommerceCategoryListForm');
        
        form.onsubmit = function() {
            // Copy the content from the editor to the hidden textarea before submitting
            document.getElementById('ecommerce-category-description').value = quill.root.innerHTML;
        };

        let inputIndex = 1; // Starting index for new inputs

        // Function to create a new subcategory input
        function createSubcategoryInput(index) {
            const newInput = document.createElement('div');
            newInput.className = 'subcategory-input';
            newInput.innerHTML = `
                <input type="text" id="ecommerce-category-sub-category-${index}" class="form-control" placeholder="Enter subcategory" name="parentCategory[]">
                <button type="button" class="clear-input">&times;</button>
            `;
            return newInput;
        }

        // Add event listener to handle adding and clearing inputs in the Create Category modal
        document.getElementById('subcategory-container').addEventListener('click', function(event) {
            if (event.target.classList.contains('add-subcategory')) {
                const container = document.getElementById('subcategory-container');
                const newInput = createSubcategoryInput(inputIndex);
                container.appendChild(newInput);
                inputIndex++;
            } else if (event.target.classList.contains('clear-input')) {
                event.target.parentElement.remove();
            }
        });
    });
</script>
