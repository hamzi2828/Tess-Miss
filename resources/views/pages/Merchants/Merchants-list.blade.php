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
                                <!-- Main headings with rowspan for S.No, Merchant Details, Registration Date, and Actions -->
                                <th style="width: 5%;" class="text-lg-center border-left border-right" rowspan="2">S.No</th>
                                <th style="width: 20%;" class="text-lg-center border-left   border-right" rowspan="2">
                                    <strong>Merchant Details</strong></th>
                                <th style="width: 10%;" class="text-lg-center border-left border-right" rowspan="2">
                                    <strong>Registration Date </strong></th>
            
                                <!-- Column span for KYC, Sales, Documents, Services -->
                                <th style="width: 15%;" class="text-lg-center border-left border-right" colspan="2">
                                    <strong>KYC Details </strong></th>
                                <th style="width: 15%;" class="text-lg-center border-left border-right" colspan="2" >
                                    <strong> Sales Details </strong></th>
                                <th style="width: 15%;" class="text-lg-center border-left border-right" colspan="2">
                                    <strong>Documents Details </strong></th>
                                <th style="width: 15%;" class="text-lg-center border-left border-right" colspan="2">
                                     <strong> Services Details </strong></th>
            
                                <!-- Actions with rowspan -->
                                <th style="width: 5%;" class="text-lg-center" rowspan="2"> <strong> Actions </strong></th>
                            </tr>
                            <tr>
                                <!-- Sub-headings for Added By and Approved By -->
                                <th class="text-lg-center border-left"><strong> Added By </strong></th>
                                <th class="text-lg-center border-right"><strong> Approved By </strong></th>
            
                                <th class="text-lg-center border-left"> <strong> Added By </strong></th>
                                <th class="text-lg-center border-right"> <strong> Approved By </strong></th>
            
                                <th class="text-lg-center border-left"> <strong> Added By </strong></th>
                                <th class="text-lg-center border-right"> <strong> Approved By </strong></th>
            
                                <th class="text-lg-center border-left"> <strong> Added By </strong></th>
                                <th class="text-lg-center border-right"> <strong> Approved By </strong></th>
                            </tr>
                        </thead>
            
                        <tbody>
                            @php $i = 1; @endphp
            
                            @foreach($merchants as $merchant)
                            <tr>
                                <!-- S.No -->
                                <td class="text-lg-center border-left border-right">{{ $i++ }}</td>
            
                                <!-- Merchant Details (Name & Email) -->
                                <td class="text-lg-center border-left border-right">
                                    <strong>{{ $merchant['merchant_name'] }}</strong><br>
                                    <small>{{ $merchant['merchant_email'] }}</small>
                                </td>
            
                                <!-- Registration Date -->
                                <td class="text-lg-center border-left border-right">{{ \Carbon\Carbon::parse($merchant['created_at'])->format('Y-m-d') }}</td>
            
                                <!-- KYC Details -->
                                <td class="text-lg-center border-left">
                                    @if (!empty($merchant['added_by']))
                                        {{ $merchant['added_by']['name'] ?? '<span class="text-danger">Pending</span>' }} 
                                    @else 
                                        <span class="text-danger">Pending</span>
                                    @endif
                                </td>
                                <td class="text-lg-center border-right">
                                    @if (!empty($merchant['approved_by']))
                                        {{ $merchant['approved_by']['name'] ?? '<span class="text-danger">Pending</span>' }}
                                    @else 
                                        <span class="text-danger">Pending</span>
                                    @endif
                                </td>

            
                                <!-- Sales Details -->
                                <td class="text-lg-center border-left">
                                    @if (!empty($merchant['sales']))
                                        {!! $merchant['sales'][0]['added_by']['name'] ?? '<span class="text-danger">Pending</span>' !!} 
                                    @else 
                                        <span class="text-danger">Pending</span>
                                    @endif
                                </td>
                                <td class="text-lg-center border-right">
                                    @if (!empty($merchant['sales']))
                                        {!! $merchant['sales'][0]['approved_by']['name'] ?? '<span class="text-danger">Pending</span>' !!}
                                    @else 
                                        <span class="text-danger">Pending</span>
                                    @endif
                                </td>

            
                                 <!-- Documents Details -->
                                <td class="text-lg-center border-left">
                                    @if (!empty($merchant['documents']))
                                        {!! $merchant['documents'][0]['added_by']['name'] ?? '<span class="text-danger">Pending</span>' !!} 
                                    @else 
                                        <span class="text-danger">Pending</span> 
                                    @endif
                                </td>
                                <td class="text-lg-center border-right">
                                    @if (!empty($merchant['documents']))
                                        {!! $merchant['documents'][0]['approved_by']['name'] ?? '<span class="text-danger">Pending</span>' !!}
                                    @else 
                                        <span class="text-danger">Pending</span> 
                                    @endif
                                </td>

            
                                <!-- Services Details -->
                                <td class="text-lg-center border-left">
                                    @if (!empty($merchant['services']))
                                        {!! $merchant['services'][0]['added_by']['name'] ?? '<span class="text-danger">Pending</span>' !!} 
                                    @else 
                                        <span class="text-danger">Pending</span> 
                                    @endif
                                </td>
                                
                                <td class="text-lg-center border-right">
                                    @if (!empty($merchant['services']))
                                        {!! $merchant['services'][0]['approved_by']['name'] ?? '<span class="text-danger">Pending</span>' !!}
                                    @else 
                                        <span class="text-danger">Pending</span> 
                                    @endif
                                </td>
                                
            
                                <!-- Actions -->
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
            
            <style>
                .border-left {
                    border-left: 1px solid #dee2e6; /* Left border */
                }
                .border-right {
                    border-right: 1px solid #dee2e6; /* Right border */
                }
            </style>
            
            
            

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
