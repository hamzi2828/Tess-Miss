@extends('master.master')

@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce-merchant"> 
            <div class="d-flex justify-content-between mb-3">
                <h4 class="fw-bold">All Merchants</h4>

                <!-- Export and Search Section -->
                <div class="d-flex justify-content-between">
                    <!-- Export Button -->
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
                        </ul>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-datatable table-responsive">
                    <table id="customMerchantTablecomplete" class="table border-top display">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Merchant Details</th>
                                <th>KYC Details</th>
                                <th>Documents Details</th>
                                <th>Sales Details</th>
                                <th>Services Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($merchants as $merchant)
                            <tr>
                                <!-- S.No -->
                                <td>{{ $i++ }}</td>

                                <!-- Merchant Details -->
                                <td>
                                    <strong>{{ $merchant['merchant_name'] }}</strong><br>
                                    <small>{{ $merchant['merchant_email'] }}</small><br>
                                    <small>Registration Date: {{ \Carbon\Carbon::parse($merchant['created_at'])->format('Y-m-d') }}</small>
                                </td>

                                <!-- KYC Details -->
                                <td>
                                    @if (!empty($merchant['added_by']) || !empty($merchant['approved_by']))
                                        <strong>Added:</strong> {{ $merchant['added_by']['name'] ?? 'Pending' }}<br>
                                        <strong>Approved:</strong> {{ $merchant['approved_by']['name'] ?? 'Pending' }}
                                        
                                    @else
                                        <span class="text-danger">Pending</span>
                                    @endif
                                </td>
                                <!-- Documents Details -->
                                <td>
                                    @if (!empty($merchant['documents']))
                                        <strong>Added:</strong> {{ $merchant['documents'][0]['added_by']['name'] ?? 'Pending' }}<br>
                                        <strong>Approved:</strong> {{ $merchant['documents'][0]['approved_by']['name'] ?? 'Pending' }}
                                    @else
                                        <span class="text-danger">Pending</span>
                                    @endif
                                </td>
                                <!-- Sales Details -->
                                <td>
                                    @if (!empty($merchant['sales']))
                                        <strong>Added:</strong> {{ $merchant['sales'][0]['added_by']['name'] ?? 'Pending' }}<br>
                                        <strong>Approved:</strong> {{ $merchant['sales'][0]['approved_by']['name'] ?? 'Pending' }}
                                    @else
                                        <span class="text-danger">Pending</span>
                                    @endif
                                </td>

                            

                                <!-- Services Details -->
                                <td>
                                    @if (!empty($merchant['services']))
                                        <strong>Added:</strong> {{ $merchant['services'][0]['added_by']['name'] ?? 'Pending' }}<br>
                                        <strong>Approved:</strong> {{ $merchant['services'][0]['approved_by']['name'] ?? 'Pending' }}
                                    @else
                                        <span class="text-danger">Pending</span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">

                                        <!-- Preview Button -->
                                        <form action="{{ route('merchants.preview') }}" method="GET" style="display: inline-block;">
                                        @csrf
                                        <input type="hidden" name="merchant_id" value="{{ $merchant['id'] }}">
                                        <button type="submit" class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1">
                                            <i class="ti ti-eye"></i>
                                        </button>
                                    </form>

                                        <!-- Edit Button -->
                                        <form action="{{ route('edit.merchants.services') }}" method="GET" style="display: inline-block;">
                                            @csrf
                                            <input type="hidden" name="merchant_id" value="{{ $merchant['id'] }}">
                                            <button type="submit" class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1">
                                                <i class="ti ti-edit"></i>
                                            </button>
                                        </form>

                                        <!-- Delete Button -->
                                        <form action="{{ route('merchants.destroy', $merchant['id']) }}" method="POST" style="display: inline-block;" onsubmit="return confirmDelete()">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>

                                        <!-- Delete Confirmation -->
                                        <script>
                                            function confirmDelete() {
                                                return confirm('Are you sure you want to delete this merchant?');
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
        </div>
    </div>

    <div class="content-backdrop fade"></div>
</div>

@endsection

@push('script')


<script>
    $(document).ready(function() {
        var table = $('#customMerchantTablecomplete').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "searching": true,
            "order": [[ 1, 'asc' ]], // Default sorting by Merchant Details
            // dom: '<"d-flex justify-content-between"<"search-box"f><"export-btn"B>>t<"d-flex justify-content-between"ip>',
            buttons: [
                {
                    extend: 'csvHtml5',
                    title: 'Merchants Data',
                    text: 'Export CSV',
                    className: 'btn btn-secondary mt'
                }
            ]
        });

        // Attach CSV export event to the dropdown item
        $('#exportCsv').on('click', function() {
            table.button('.buttons-csv').trigger();
        });
    });


</script>

@endpush
