@extends('master.master')

@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce-merchant"> 
            <div class="d-flex justify-content-between mb-3">
                <h4 class="fw-bold">Merchants</h4>
                <div class="d-flex col-lg-5">
                    <input type="text" id="customMerchantSearch" class="form-control me-2" placeholder="Search merchants" onkeyup="filterTable()"> <!-- Changed to customMerchantSearch -->
                </div>
            </div>

            <div class="card">
                <div class="card-datatable table-responsive">
                    <table id="customMerchantTable" class="table border-top"> 
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Merchant Name</th>
                                <th>Merchant Email</th>
                                <th>Registration Date</th>
                                <th>Current Status</th>
                                <th>Added By</th>
                                <th>Approved By</th>
                                <th class="text-lg-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($merchants as $merchant)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $merchant['merchant_name'] }}</td>
                                <td>{{ $merchant['merchant_email'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($merchant['merchant_date_incorp'])->format('Y-m-d') }}</td>
                                <td>
                                    @if($merchant['status'] == 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $merchant['added_by'] }}</td>
                                <td>{{ $merchant['approved_by_kyc'] ?? 'Not Approved' }}</td>
                                <td class="text-lg-center">
                                    <div class="d-flex justify-content-center align-items-center">


                                        <form action="{{ route('edit.merchants.services') }}" method="GET" style="display: inline-block;">
                                            @csrf
                                            <input type="hidden" name="merchant_id" value="{{ $merchant['id'] }}">
                                            <button type="submit" class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1">
                                                <i class="ti ti-edit"></i>
                                            </button>
                                        </form>
                                        
                                        
                        
                                        <form action="{{ route('merchants.destroy', $merchant['id']) }}" method="POST" style="display: inline-block;">
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
