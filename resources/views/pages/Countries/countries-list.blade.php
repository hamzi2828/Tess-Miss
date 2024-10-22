@extends('master.master')

@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce-country">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="fw-bold">Countries</h4>
                <button class="btn btn-primary btn-lg" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddCountry" style="width: 194px;">
                    <i class="ti ti-plus me-1"></i> Add Country
                </button>
            </div>

            <div class="card">
                <div class="card-datatable table-responsive">
                    <table id="customCountryTable" class="table border-top display">
                        <thead>
                            <tr>
                               
                                <th>ID</th>
                                <th>Country Code</th> 
                                <th>Country Name</th>
                                <th>Country Status</th>
                                <th class="text-lg-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($countries as $country)
                            @php
                                // Define initials from the country name (e.g., 'AF' for Afghanistan)
                                $initials = strtoupper(substr($country->country_name, 0, 2));
                                
                                // Define the background color class based on country status
                                $state = '';
                                if ($country->country_status == 'No Risk') {
                                    $state = 'success'; // Green for 'No Risk'
                                } elseif ($country->country_status == 'Medium Risk') {
                                    $state = 'warning'; // Yellow for 'Medium Risk'
                                } elseif ($country->country_status == 'High Risk') {
                                    $state = 'danger'; // Red for 'High Risk'
                                } elseif ($country->country_status == 'Low Risk') {
                                    $state = 'primary'; // Blue for 'Low Risk'
                                }
                            @endphp
                            <tr>
                               
                                <td>{{ $country->id }}</td>
                                <td>{{ $country->country_code }}</td>
                                <td>{{ $country->country_name }}</td>
                                <td>
                                    <span class="badge bg-{{ $state }}"> {{ $country->country_status }}</span>
                                </td>
                                <td class="text-lg-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1 edit-country-btn"
                                        data-bs-toggle="offcanvas" 
                                        data-bs-target="#offcanvasEditCountry" 
                                        data-id="{{ $country->id }}"
                                        data-code="{{ $country->country_code }}"
                                        data-name="{{ $country->country_name }}"
                                        data-status="{{ $country->country_status }}">
                                        <i class="ti ti-edit"></i>
                                      </button>

                                        <form action="{{ route('countries.destroy', $country->id) }}" method="POST" style="display: inline-block;">
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
            
            {{-- Create Country Modal --}}
            @include('pages.countries.countries-create-modal')

            {{-- Edit Country Modal --}}
            @include('pages.countries.countries-edit-modal')
        </div>
    </div>

    <div class="content-backdrop fade"></div>
</div>

@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('#customCountryTable').DataTable({
            "paging": true,      // Enable pagination
            "ordering": true,    // Enable sorting
            "info": true,        // Display table information
            "searching": true,   // Enable search functionality
            "order": [[ 3, 'asc' ]] // Default sorting by Country Name (column index 3), ascending
        });
    });
</script>

@endpush
