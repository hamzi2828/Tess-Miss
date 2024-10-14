@extends('master.master')

@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce-merchant-category">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="fw-bold">Merchant Categories</h4>
                <div class="d-flex col-lg-5">
                    <input type="text" id="customCategorySearch" class="form-control me-2" placeholder="Search categories" onkeyup="filterTable()">
                    <button class="btn btn-primary btn-lg" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddCategory" style="width: 394px;">
                        <i class="ti ti-plus me-1"></i> Add Category
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-datatable table-responsive">
                    <table id="customCategoryTable" class="table border-top">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Parent Category</th>
                                <th>Title</th> 
                                <th>Added By</th>
                                <th>Date Added</th>
                                <th class="text-lg-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($categories as $category)
                            <tr>
                                <td></td>
                                <td>{{ $i++ }}</td>
                                <td>{{ $category->parentCategory->title ?? 'None' }}</td> <!-- Display parent category -->
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->addedBy->name ?? 'N/A' }}</td> <!-- Assuming relationship to added_by is defined -->
                                <td>{{ $category->created_at->format('Y-m-d') }}</td>
                                <td class="text-lg-center">
                                    <div class="d-flex justify-content-center align-items-center">

                                        <button class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1 edit-category-btn"
                                        data-bs-toggle="offcanvas" 
                                        data-bs-target="#offcanvasEditCategory" 
                                        data-id="{{ $category->id }}"
                                        data-title="{{ $category->title }}"
                                        data-parent="{{ $category->parent_id }}"
                                        data-added_by="{{ $category->added_by }}">
                                        <i class="ti ti-edit"></i>
                                      </button>
                                      
                                      <form action="{{ route('merchant-categories.destroy', $category->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                    
                                    <script>
                                        function confirmDelete() {
                                            return confirm('Are you sure you want to delete this category?');
                                        }
                                    </script>
                                    
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Create Category Modal --}}
            @include('pages.merchantCategories.merchantCategory-create-modal')

            {{-- Edit Category Modal --}}
            @include('pages.merchantCategories.merchantCategory-edit-modal')
        </div>
    </div>

    <div class="content-backdrop fade"></div>
</div>

<script>
    // Function to filter table rows based on the search input
    function filterTable() {
        let input = document.getElementById('customCategorySearch');
        let filter = input.value.toLowerCase();
        let table = document.getElementById('customCategoryTable');
        let rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
            let cells = rows[i].getElementsByTagName('td');
            let match = false;

            for (let j = 0; j < cells.length; j++) {
                let cellValue = cells[j].textContent || cells[j].innerText;
                if (cellValue.toLowerCase().indexOf(filter) > -1) {
                    match = true;
                    break;
                }
            }

            if (match) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
</script>

@endsection
