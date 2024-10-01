@extends('master.master')

<style>
    .form-label {
        font-weight: 500;
        color: #6c757d;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    /* Remove the border-radius for square inputs */
    .form-control,
    .form-select {
        border-radius: 0px !important;
    }

    /* You can adjust the card radius or leave it as it is */
    .card-custom {
        border-radius: 5px;
        background-color: #f8f9fa;
    }
</style>

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Left Side: User Details -->
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="card shadow-lg p-4 card-custom">
                <h4 class="fw-bold text-primary mb-4">Create User</h4>

                <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Full Name -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userFullname">Full Name</label>
                        <input type="text" class="form-control" id="userFullname" name="userFullname" value="{{ old('userFullname') }}" required />
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userEmail">Email</label>
                        <input type="email" id="userEmail" class="form-control" name="userEmail" value="{{ old('userEmail') }}" required />
                    </div>

                    <!-- Phone -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userPhone">Phone</label>
                        <input type="tel" id="userPhone" class="form-control" name="userPhone" value="{{ old('userPhone') }}" />
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userStatus">Status</label>
                        <select id="userStatus" class="form-select" name="userStatus" required>
                            <option value="active" {{ old('userStatus') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('userStatus') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userPassword">Password</label>
                        <input type="password" id="userPassword" class="form-control" name="userPassword" required />
                    </div>

                    <!-- File input -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="file-input">Upload Profile Picture</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="file-input" name="userPicture" accept="image/*">
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userAddress">Address</label>
                        <textarea id="userAddress" class="form-control" name="userAddress" rows="3">{{ old('userAddress') }}</textarea>
                    </div>
                    
                    <!-- Submit & Cancel Buttons -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4 me-3">Create</button>
                        <a href="{{ route('users.index') }}" class="btn btn-danger px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
