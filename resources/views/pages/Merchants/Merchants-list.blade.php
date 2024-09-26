@extends('master.master')

@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce-merchant"> <!-- Changed to app-ecommerce-merchant -->
            <div class="d-flex justify-content-between mb-3">
                <h4 class="fw-bold">Merchants</h4>
                <div class="d-flex col-lg-5">
                    <input type="text" id="customMerchantSearch" class="form-control me-2" placeholder="Search merchants" onkeyup="filterTable()"> <!-- Changed to customMerchantSearch -->
                    <button class="btn btn-primary btn-lg" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddMerchant" style="width: 337px;"> <!-- Changed to #offcanvasAddMerchant -->
                        <i class="ti ti-plus me-1"></i> Add Merchants
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-datatable table-responsive">
                    <table id="customMerchantTable" class="table border-top"> <!-- Changed to customMerchantTable -->
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Picture</th> <!-- Added Picture column -->
                                <th>Merchant</th>
                                <th>Registration Date</th>
                                <th>Current Status</th>
                                <th>Added By</th>
                                <th>Approved By</th>
                                <th class="text-lg-center">Actions</th>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            @php $i = 1; @endphp
                            @foreach($merchants as $merchant)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($merchant->picture)
                                            <img src="{{ asset('storage/' . $merchant->picture) }}" alt="Avatar" class="rounded-circle me-2" style="width: 50px; height: 50px;">
                                        @else
                                            @php
                                                $initials = strtoupper(substr($merchant->name, 0, 2));
                                                $stateNum = rand(0, 5);
                                                $states = ['success', 'danger', 'warning', 'info', 'primary', 'secondary'];
                                                $state = $states[$stateNum];
                                            @endphp
                                            <span class="avatar-initial rounded-circle bg-label-{{ $state }} me-2" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                                {{ $initials }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $merchant->name }}</td>
                                <td>{{ $merchant->registration_date }}</td>
                                <td>
                                    @if($merchant->status == 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $merchant->added_by }}</td>
                                <td>{{ $merchant->approved_by }}</td>
                                <td class="text-lg-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                      <button class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1 edit-merchant-btn"
                                        data-bs-toggle="offcanvas" 
                                        data-bs-target="#offcanvasEditMerchant" 
                                        data-id="{{ $merchant->id }}"
                                        data-name="{{ $merchant->name }}"
                                        data-registration_date="{{ $merchant->registration_date }}"
                                        data-status="{{ $merchant->status }}"
                                        data-added_by="{{ $merchant->added_by }}"
                                        data-approved_by="{{ $merchant->approved_by }}">
                                        <i class="ti ti-edit"></i>
                                    </button>

                                        <form action="{{ route('merchants.destroy', $merchant->id) }}" method="POST" style="display: inline-block;">
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
                        </tbody> --}}
                    </table>
                </div>
            </div>

            {{-- Create Merchant Modal --}}
            {{-- @include('pages.merchants.create-modal') --}}

            {{-- Edit Merchant Modal --}}
            {{-- @include('pages.merchants.edit-modal') --}}
        </div>
    </div>

    <div class="content-backdrop fade"></div>
</div>

<script>
    // Function to filter table rows based on the search input
    function filterTable() {
        let input = document.getElementById('customMerchantSearch'); // Changed to customMerchantSearch
        let filter = input.value.toLowerCase();
        let table = document.getElementById('customMerchantTable'); // Changed to customMerchantTable
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
