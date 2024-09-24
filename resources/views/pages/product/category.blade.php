@extends('master.master')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce-category">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="fw-bold">Categories</h4>
                <div class="d-flex col-lg-5">
                    <input type="text" id="categorySearch" class="form-control me-2" placeholder="Search categories">
                    <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEcommerceCategoryList">
                        <i class="ti ti-plus me-1"></i> Add Category
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-datatable table-responsive">
                    <table id="categoryTable" class="table border-top category-datatable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Categories</th>
                                <th>Description</th>
                                <th>Total <br> Subcategories &nbsp;</th>
                                <th>Status</th>
                                <th class="text-lg-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($categories as $category)
                            <tr>
                                <td></td>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <div class="avatar-wrapper me-3">
                                        @if($category->image)
                                            <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" class="rounded-2" style="width: 50px; height: 50px;">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="text-heading text-wrap fw-medium">{{ $category->title }}</span>
                                </td>
                                <td>{{ $category->description }}</td>
                                <td>{{ $category->subcategories->count() }}</td>
                                <td>{{ $category->status }}</td>

                                <td class="text-lg-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1 edit-category-btn"
                                            data-bs-toggle="offcanvas" 
                                            data-bs-target="#offcanvasEditCategory" 
                                            data-id="{{ $category->id }}"
                                            data-title="{{ $category->title }}"
                                            data-slug="{{ $category->slug }}"
                                            data-description="{{ $category->description }}"
                                            data-image="{{ $category->image }}"
                                            data-status="{{ $category->status }}"
                                            data-subcategories="{{ json_encode($category->subcategories->toArray()) }}">
                                            <i class="ti ti-edit"></i>
                                        </button>
                                        
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1 ">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Create Category Modal --}}
            @include('pages.product.category.create-modal')

            {{-- Edit Category Modal --}}
            @include('pages.product.category.edit-modal')
        </div>
    </div>

    <div class="content-backdrop fade"></div>
</div>
@endsection

@section('scripts')
<!-- Ensure jQuery is loaded -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Ensure DataTables JS is loaded -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#categoryTable').DataTable({
            paging: true,
            lengthChange: true,
            searching: true, // Ensure searching is enabled
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
        });

        // Apply custom search
        $('#categorySearch').on('keyup', function() {
            table.search(this.value).draw();
        });

        // Debugging: Log to check if search input is detected
        $('#categorySearch').on('keyup', function() {
            console.log("Search input: ", this.value); // Log the input value
        });
    });
</script>
@endsection
