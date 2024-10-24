@extends('master.master')

@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce-merchant-category">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="fw-bold">Merchant Categories</h4>

                <div class="d-flex">
                    <div class="export-btn">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-download"></i> Export
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                            <li>
                                <a class="dropdown-item" id="exportCsv" href="#">
                                    <i class="ti ti-file"></i> CSV
                                </a>
                            </li>
                            {{-- <li>
                                <a class="dropdown-item" id="exportExcel" href="#">
                                    <i class="ti ti-file-spreadsheet"></i> Excel
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" id="exportPdf" href="#">
                                    <i class="ti ti-file-pdf"></i> PDF
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" id="exportPrint" href="#">
                                    <i class="ti ti-printer"></i> Print
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                    <button class="btn btn-primary btn-lg ms-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddCategory" style="width: 194px;">
                        <i class="ti ti-plus me-1"></i> Add Category
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-datatable table-responsive">
                    <table id="customCategoryTable" class="table border-top display">
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
                                <td><strong>{{ $category->parentCategory->title ?? 'None' }}</strong></td>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->addedBy->name ?? 'N/A' }}</td>
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

@endsection

@push('script')
<!-- Initialize DataTables with export options -->
<script>
    $(document).ready(function() {
        var table = $('#customCategoryTable').DataTable({
            "paging": true,      // Enable pagination
            "ordering": true,    // Enable sorting
            "info": true,        // Display table information
            "searching": true,   // Enable search functionality
            "order": [[ 3, 'asc' ]], // Default sorting by Title (column index 3), ascending

            // Add export buttons before the search box
            buttons: [
                {
                    extend: 'csvHtml5',
                    title: 'Merchant Categories',
                    className: 'btn btn-secondary'
                },
                {
                    extend: 'excelHtml5',
                    title: 'Merchant Categories',
                    className: 'btn btn-secondary'
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Merchant Categories',
                    className: 'btn btn-secondary'
                },
                {
                    extend: 'print',
                    title: 'Merchant Categories',
                    className: 'btn btn-secondary'
                }
            ]
        });

        // Trigger the export actions from the dropdown
        $('#exportCsv').on('click', function() {
            table.button('.buttons-csv').trigger();
        });

        $('#exportExcel').on('click', function() {
            table.button('.buttons-excel').trigger();
        });

        $('#exportPdf').on('click', function() {
            table.button('.buttons-pdf').trigger();
        });

        $('#exportPrint').on('click', function() {
            table.button('.buttons-print').trigger();
        });
    });
</script>
@endpush
