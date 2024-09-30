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


    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT') 
    <div class="row">

   
        <!-- Left Side: User Details -->
        <div class="col-md-6">
            <div class="card shadow-lg p-4 card-custom">
                <h4 class="fw-bold text-primary mb-4">Edit User</h4>

              

                    <!-- Full Name -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userFullname">Full Name</label>
                        <input type="text" class="form-control rounded-pill" id="userFullname" name="userFullname" value="{{ $user->name }}" required />
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userEmail">Email</label>
                        <input type="email" id="userEmail" class="form-control rounded-pill" name="userEmail" value="{{ $user->email }}" required />
                    </div>

                    <!-- Phone -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userPhone">Phone</label>
                        <input type="tel" id="userPhone" class="form-control rounded-pill" name="userPhone" value="{{ $user->phone }}" />
                    </div>

                    <!-- Department -->
                    {{-- <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userDepartment">Department</label>
                        <select id="userDepartment" class="form-select rounded-pill" name="userDepartment" required>
                            <option value="">Select Department</option>
                            <option value="HR" {{ $user->department == 'HR' ? 'selected' : '' }}>HR</option>
                            <option value="IT" {{ $user->department == 'IT' ? 'selected' : '' }}>IT</option>
                            <option value="Finance" {{ $user->department == 'Finance' ? 'selected' : '' }}>Finance</option>
                            <option value="Marketing" {{ $user->department == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                        </select>
                    </div> --}}

                    {{-- <!-- User Role -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userRole">User Role</label>
                        <select id="userRole" class="form-select rounded-pill" name="userRole" required>
                            <option value="subscriber" {{ $user->role == 'subscriber' ? 'selected' : '' }}>Subscriber</option>
                            <option value="editor" {{ $user->role == 'editor' ? 'selected' : '' }}>Editor</option>
                            <option value="maintainer" {{ $user->role == 'maintainer' ? 'selected' : '' }}>Maintainer</option>
                            <option value="author" {{ $user->role == 'author' ? 'selected' : '' }}>Author</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div> --}}

                    <!-- Status -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userStatus">Status</label>
                        <select id="userStatus" class="form-select rounded-pill" name="userStatus" required>
                            <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Current Profile Picture -->
                    @if($user->picture)
                    <div class="mb-4 text-center">
                        <label class="form-label fw-medium text-secondary" for="currentUserPicture">Current Profile Picture</label><br>
                        <img src="{{ asset('storage/' . $user->picture) }}" alt="Current Profile Picture" class="rounded-circle shadow-sm" style="max-width: 150px; height: auto;">
                    </div>
                    @endif

                    <!-- File input -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="file-input">Edit Profile Picture</label>
                        <div class="input-group">
                            <input type="file" class="form-control rounded-pill" id="file-input" name="userPicture" accept="image/*">
                        </div>
                    </div>

                    {{-- address --}}
                    <div class="mb-4">
                        <label class="form-label fw-medium text-secondary" for="userAddress">Address</label>
                        <textarea id="userAddress" class="form-control rounded-pill" name="userAddress" rows="3">
                            {{ $user->address }}
                        </textarea>
                    </div>

                    <!-- Submit & Cancel Buttons -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary rounded-pill px-4 me-3">Update</button>
                        <a href="{{ route('users.index') }}" class="btn btn-danger rounded-pill px-4">Cancel</a>
                    </div>
              
            </div>
        </div>

        <!-- Right Side: Permissions Section -->

        <div class="col-md-6">
            <div class="card shadow-lg p-4 card-custom">
                <h4 class="fw-bold text-primary mb-4">User Rights</h4>

                <!-- KYC Section Rights -->
                <h5 class="fw-bold mb-3">KYC Section Rights</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="addKYC" name="permissions[]" value="addKYC"
                                {{ $permissions->add_kyc ? 'checked' : '' }}>
                            <label class="form-check-label" for="addKYC">Add KYC</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="viewKYC" name="permissions[]" value="viewKYC"
                                {{ $permissions->view_kyc ? 'checked' : '' }}>
                            <label class="form-check-label" for="viewKYC">View KYC</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="changeKYC" name="permissions[]" value="changeKYC"
                                {{ $permissions->change_kyc ? 'checked' : '' }}>
                            <label class="form-check-label" for="changeKYC">Edit KYC</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="approveKYC" name="permissions[]" value="approveKYC"
                                {{ $permissions->approve_kyc ? 'checked' : '' }}>
                            <label class="form-check-label" for="approveKYC">Approve KYC</label>
                        </div>
                    </div>
                </div>

                <!-- Documents Section Rights -->
                <h5 class="fw-bold mb-3">Documents Section Rights</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="addDocuments" name="permissions[]" value="addDocuments"
                                {{ $permissions->add_documents ? 'checked' : '' }}>
                            <label class="form-check-label" for="addDocuments">Add Documents</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="viewDocuments" name="permissions[]" value="viewDocuments"
                                {{ $permissions->view_documents ? 'checked' : '' }}>
                            <label class="form-check-label" for="viewDocuments">View Documents</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="changeDocuments" name="permissions[]" value="changeDocuments"
                                {{ $permissions->change_documents ? 'checked' : '' }}>
                            <label class="form-check-label" for="changeDocuments">Edit Documents</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="approveDocuments" name="permissions[]" value="approveDocuments"
                                {{ $permissions->approve_documents ? 'checked' : '' }}>
                            <label class="form-check-label" for="approveDocuments">Approve Documents</label>
                        </div>
                    </div>
                </div>

                <!-- Sales Section Rights -->
                <h5 class="fw-bold mb-3">Sales Section Rights</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="addSales" name="permissions[]" value="addSales"
                                {{ $permissions->add_sales ? 'checked' : '' }}>
                            <label class="form-check-label" for="addSales">Add Sales</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="viewSales" name="permissions[]" value="viewSales"
                                {{ $permissions->view_sales ? 'checked' : '' }}>
                            <label class="form-check-label" for="viewSales">View Sales</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="changeSales" name="permissions[]" value="changeSales"
                                {{ $permissions->change_sales ? 'checked' : '' }}>
                            <label class="form-check-label" for="changeSales">Edit Sales</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="approveSales" name="permissions[]" value="approveSales"
                                {{ $permissions->approve_sales ? 'checked' : '' }}>
                            <label class="form-check-label" for="approveSales">Approve Sales</label>
                        </div>
                    </div>
                </div>

                <!-- Services Section Rights -->
                <h5 class="fw-bold mb-3">Services Section Rights</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="addServices" name="permissions[]" value="addServices"
                                {{ $permissions->add_services ? 'checked' : '' }}>
                            <label class="form-check-label" for="addServices">Add Services</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="viewServices" name="permissions[]" value="viewServices"
                                {{ $permissions->view_services ? 'checked' : '' }}>
                            <label class="form-check-label" for="viewServices">View Services</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="changeServices" name="permissions[]" value="changeServices"
                                {{ $permissions->change_services ? 'checked' : '' }}>
                            <label class="form-check-label" for="changeServices">Edit Services</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="approveServices" name="permissions[]" value="approveServices"
                                {{ $permissions->approve_services ? 'checked' : '' }}>
                            <label class="form-check-label" for="approveServices">Approve Services</label>
                        </div>
                    </div>
                </div>

                <!-- Users Section Rights -->
                <h5 class="fw-bold mb-3">Users Section Rights</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="addUser" name="permissions[]" value="addUser"
                                {{ $permissions->add_user ? 'checked' : '' }}>
                            <label class="form-check-label" for="addUser">Add User</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="viewUsers" name="permissions[]" value="viewUsers"
                                {{ $permissions->view_users ? 'checked' : '' }}>
                            <label class="form-check-label" for="viewUsers">View Users</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="changeUser" name="permissions[]" value="changeUser"
                                {{ $permissions->change_user ? 'checked' : '' }}>
                            <label class="form-check-label" for="changeUser">Edit User</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

   
    </div>

</form>
</div>

@endsection
