<!-- CSS for Edit Category Modal -->
<style>
    .ecommerce-select2-dropdown {
        position: relative;
    }

    .clear-input,
    .add-subcategory {
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

    .subcategory-input {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .subcategory-input input {
        flex: 1;
    }

    .clear-input {
        margin-left: 10px;
        color: #ff4d4f;
    }

    .clear-input.btn.btn-sm.btn-danger {
        transition: none;
        transform: none;
    }
</style>




<!-- Edit Category Modal -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditCategory" aria-labelledby="offcanvasEditCategoryLabel">
    <div class="offcanvas-header py-6">
        <h5 id="offcanvasEditCategoryLabel" class="offcanvas-title">Edit Category</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body border-top">
        <form class="pt-0" id="eCommerceEditCategoryForm" method="POST" action="" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label class="form-label" for="edit-category-title">Title</label>
                <input type="text" class="form-control" id="edit-category-title" name="categoryTitle" aria-label="category title" required />
            </div>
            <div class="mb-6">
                <label class="form-label" for="edit-category-slug">Slug</label>
                <input type="text" id="edit-category-slug" class="form-control" name="slug" required />
            </div>
            <div class="mb-6">
                <label class="form-label" for="edit-category-image">Attachment</label>
                <input class="form-control" type="file" id="edit-category-image" name="image" />
                <img id="current-category-image" src="" alt="Category Image" class="img-thumbnail mt-2" style="width: 150px; display:none;">
            </div>
            <div class="mb-6 ecommerce-select2-dropdown">
                <label class="form-label" for="edit-subcategory-container">Subcategories</label>
                <div id="edit-subcategory-container">
                    <!-- Subcategories will be appended here -->
                </div>
                <button type="button" class="add-edit-subcategory btn btn-sm btn-success mt-2">Add Subcategory</button>
            </div>

            <div class="mb-6">
                <label class="form-label">Description</label>
                <textarea class="form-control" id="edit-category-description" name="description"></textarea>
            </div>
            
            <div class="mb-6">
                <label class="form-label">Select category status</label>
                <select id="edit-category-status" class="select2 form-select" name="status">
                    <option value="Publish">Publish</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
            <div class="mb-6">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Update</button>
                <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript for Edit Category Modal -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let editInputIndex = 1; // Starting index for new inputs in the Edit modal

        // Function to create a new subcategory input for the Edit modal
        function createEditSubcategoryInput(index, value = '') {
            const newInput = document.createElement('div');
            newInput.className = 'subcategory-input mb-2 d-flex align-items-center';
            newInput.innerHTML = `
                <input type="text" id="edit-category-sub-category-${index}" class="form-control me-2" placeholder="Enter subcategory" name="subcategories[]" value="${value}">
                <button type="button" style="top: 5%;   box-shadow: none" class="clear-input btn btn-sm btn-danger">&times;</button>
            `;
            return newInput;
        }

        // Add event listener to handle adding and clearing inputs in the Edit Category modal
        document.getElementById('offcanvasEditCategory').addEventListener('click', function(event) {
            if (event.target.classList.contains('add-edit-subcategory')) {
                const container = document.getElementById('edit-subcategory-container');
                const newInput = createEditSubcategoryInput(editInputIndex);
                container.appendChild(newInput);
                editInputIndex++;
            } else if (event.target.classList.contains('clear-input')) {
                event.target.parentElement.remove();
            }
        });

        // Handle Edit Button Click
        document.querySelectorAll('.edit-category-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var categoryID = this.getAttribute('data-id');
                var categoryTitle = this.getAttribute('data-title');
                var categorySlug = this.getAttribute('data-slug');
                var categoryDescription = this.getAttribute('data-description');
                var categoryImage = this.getAttribute('data-image');
                var categoryStatus = this.getAttribute('data-status');
                var subcategories = JSON.parse(this.getAttribute('data-subcategories'));

                // Set form action URL
                document.getElementById('eCommerceEditCategoryForm').action = '/categories/' + categoryID;

                // Populate modal fields with data
                document.getElementById('edit-category-title').value = categoryTitle;
                document.getElementById('edit-category-slug').value = categorySlug;
                document.getElementById('edit-category-description').value = categoryDescription;
                document.getElementById('edit-category-status').value = categoryStatus;

                // Clear existing subcategory inputs
                const container = document.getElementById('edit-subcategory-container');
                container.innerHTML = '';

                // Populate subcategory inputs with existing data
                subcategories.forEach(function(subcategory) {
                    const newInput = createEditSubcategoryInput(editInputIndex, subcategory.title);
                    container.appendChild(newInput);
                    editInputIndex++;
                });

                if (categoryImage) {
                    document.getElementById('current-category-image').style.display = 'block';
                    document.getElementById('current-category-image').src = '/storage/' + categoryImage;
                } else {
                    document.getElementById('current-category-image').style.display = 'none';
                }
            });
        });
    });
</script>

