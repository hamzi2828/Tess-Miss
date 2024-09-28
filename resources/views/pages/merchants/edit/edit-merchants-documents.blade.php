@extends('master.master')

@section('content')

<!-- Include Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="container-xxl flex-grow-1 container-p-y">
    <form class="kyc-form" action="{{ route('store.merchants.documents') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Basic Details Section -->
        <div class="form-section box-container">

            <!-- Step-based Progress Bar -->
            @include('pages.merchants.components.edit-progressBar')

            <!-- Document Fields -->
            <h4 class="mb-3">Documents</h4>
            
            @foreach($merchant_details['documents'] as $document)
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="document_{{ $document['id'] }}" class="form-label">
                        {{ $document['title'] }} 
                        @if($document['status'])
                            (<span class="required-asterisk">*</span> Required)
                        @endif
                    </label>
                    <div class="input-group">
                        <input 
                        type="file" 
                        class="form-control" 
                        id="document_{{ $document['id'] }}" 
                        name="document_{{ $document['id'] }}" 
                        {{-- Dynamically set the accepted file types based on document type --}}
                        @if(Str::contains($document['document_type'], 'image'))
                            accept="image/jpeg,image/png,image/jpg,image/gif,image/svg" 
                        @else
                            accept=".pdf,.doc,.docx,.xls,.xlsx,.txt" 
                        @endif
                        @if($document['status']) {{-- Assuming status indicates required --}}
                            required
                        @endif
                    >
                    
                        <button class="btn btn-secondary" type="button">Browse</button>
                        <button class="btn btn-primary" type="button">Upload</button>
                    </div>
                </div>

                @if($document['date_expiry'])
                <div class="col-md-6">
                    <label for="expiry_{{ $document['id'] }}" class="form-label">Expiry <span class="required-asterisk">*</span></label>
                    <div class="input-group">
                        <input 
                            type="date" 
                            class="form-control" 
                            id="expiry_{{ $document['id'] }}" 
                            name="expiry_{{ $document['id'] }}" 
                            value="{{ $document['date_expiry'] }}" 
                            required
                        >
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                    </div>
                </div>
                @endif
            </div>
            @endforeach

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Save Documents Data</button>
            </div>
        </div>
    </form>
</div>

@endsection
