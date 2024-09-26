@extends('master.master')

@section('content')




    
<div class="container-xxl flex-grow-1 container-p-y">
    <form class="kyc-form">
        <!-- Sales Data Section -->
        <div class="form-section box-container">
            
            <!-- Step-based Progress Bar -->
            @include('pages.merchants.components.progressBar')
      
            <!-- Services Section -->
            @foreach($services as $service)
            <div class="form-section box-container">
                <h4 class="mb-3">{{ ucfirst($service->name) }}</h4>
                
                <!-- Display the fields for each service -->
                @php
                    $fields = json_decode($service->fields, true);
                @endphp
    
                @if($fields)
                    @foreach($fields as $field)
                    <div class="mb-3">
                        <label for="field_{{ $loop->index }}" class="form-label">{{ ucfirst($field) }}</label>
                        <input type="text" class="form-control" id="field_{{ $loop->index }}" name="field_{{ $loop->index }}">
                    </div>
                    @endforeach
                @endif
    
            </div>
            @endforeach
            
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Save Services Data</button>
            </div>
        </div>
    </form>
</div>

@endsection
