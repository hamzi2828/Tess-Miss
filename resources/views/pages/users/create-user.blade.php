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

    .rounded-pill {
        border-radius: 50px !important;
    }

    .card-custom {
        border-radius: 10px;
        background-color: #f8f9fa;
    }
</style>

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Left Side: User Details -->
        <div class="col-md-6">
            <div class="card shadow-lg p-4 card-custom">
                <h4 class="fw-bold text-primary mb-4">Create User</h4>

                <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Full Name -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userFullname">Full Name</label>
                        <input type="text" class="form-control rounded-pill" id="userFullname" name="userFullname" value="{{ old('userFullname') }}" required />
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userEmail">Email</label>
                        <input type="email" id="userEmail" class="form-control rounded-pill" name="userEmail" value="{{ old('userEmail') }}" required />
                    </div>

                    <!-- Phone -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userPhone">Phone</label>
                        <input type="tel" id="userPhone" class="form-control rounded-pill" name="userPhone" value="{{ old('userPhone') }}" />
                    </div>

                    {{-- <!-- Department -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userDepartment">Department</label>
                        <select id="userDepartment" class="form-select rounded-pill" name="userDepartment" required>
                            <option value="">Select Department</option>
                            <option value="HR" {{ old('userDepartment') == 'HR' ? 'selected' : '' }}>HR</option>
                            <option value="IT" {{ old('userDepartment') == 'IT' ? 'selected' : '' }}>IT</option>
                            <option value="Finance" {{ old('userDepartment') == 'Finance' ? 'selected' : '' }}>Finance</option>
                            <option value="Marketing" {{ old('userDepartment') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                        </select>
                    </div>

                    <!-- User Role -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userRole">User Role</label>
                        <select id="userRole" class="form-select rounded-pill" name="userRole" required>
                            <option value="subscriber" {{ old('userRole') == 'subscriber' ? 'selected' : '' }}>Subscriber</option>
                            <option value="editor" {{ old('userRole') == 'editor' ? 'selected' : '' }}>Editor</option>
                            <option value="maintainer" {{ old('userRole') == 'maintainer' ? 'selected' : '' }}>Maintainer</option>
                            <option value="author" {{ old('userRole') == 'author' ? 'selected' : '' }}>Author</option>
                            <option value="admin" {{ old('userRole') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div> --}}

                    <!-- Status -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userStatus">Status</label>
                        <select id="userStatus" class="form-select rounded-pill" name="userStatus" required>
                            <option value="active" {{ old('userStatus') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('userStatus') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userPassword">Password</label>
                        <input type="password" id="userPassword" class="form-control rounded-pill" name="userPassword" required />
                    </div>

                    <!-- File input -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="file-input">Upload Profile Picture</label>
                        <div class="input-group">
                            <input type="file" class="form-control rounded-pill" id="file-input" name="userPicture" accept="image/*">
                        </div>
                    </div>

                <!-- Address -->
                <div class="mb-4">
                    <label class="form-label fw-medium text-secondary" for="userAddress">Address</label>
                    <textarea id="userAddress" class="form-control rounded-pill" name="userAddress" rows="3">
                       </textarea>
                </div>
                
                    <!-- Submit & Cancel Buttons -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary rounded-pill px-4 me-3">Create</button>
                        <a href="{{ route('users.index') }}" class="btn btn-danger rounded-pill px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
