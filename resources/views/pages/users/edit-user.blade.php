@extends('master.master')


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
                    <input type="text" class="form-control" id="userFullname" name="userFullname" value="{{ $user->name }}" required />
                </div>
        
                <!-- Email -->
                <div class="mb-4">
                    <label class="form-label fw-medium text-secondary" for="userEmail">Email</label>
                    <input type="email" id="userEmail" class="form-control" name="userEmail" value="{{ $user->email }}" required />
                </div>
        
                <!-- Phone -->
                <div class="mb-4">
                    <label class="form-label fw-medium text-secondary" for="userPhone">Phone</label>
                    <input type="tel" id="userPhone" class="form-control" name="userPhone" value="{{ $user->phone }}" />
                </div>
        
                <!-- Status -->
                <div class="mb-4">
                    <label class="form-label fw-medium text-secondary" for="userStatus">Status</label>
                    <select id="userStatus" class="form-select" name="userStatus" required>
                        <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
     
          
                {{-- <!-- Department --> --}}
                <div class="mb-4">
                    <label for="selectDepartment" class="form-label fw-medium text-secondary">Department</label>
                    <select class="form-select select2" id="selectDepartment" name="department_id" required>
                       
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ $user->department == $department->id ? 'selected' : '' }}>
                                {{ $department->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                

                <script>
                    // Initialize Select2 on the initial page load for existing selects
                    document.addEventListener('DOMContentLoaded', function() {

                        $('#selectDepartment').select2({
                            placeholder: 'Select Country',
                            allowClear: true
                        });
                    });
                </script>
        
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
                        <input type="file" class="form-control" id="file-input" name="userPicture" accept="image/*">
                    </div>
                </div>
        
                <!-- Address -->
                <div class="mb-4">
                    <label class="form-label fw-medium text-secondary" for="userAddress">Address</label>
                    <textarea id="userAddress" class="form-control" name="userAddress" rows="3">{{ $user->address }}</textarea>
                </div>
        
                <!-- Submit & Cancel Buttons -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 me-3">Update</button>
                    <a href="{{ route('users.index') }}" class="btn btn-danger px-4">Cancel</a>
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
                            <input class="form-check-input" type="checkbox" id="addKYC" name="permissions[add_kyc]" value="1"
                                {{ isset($permissionsArray['add_kyc']) && $permissionsArray['add_kyc'] == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="addKYC">Add KYC</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="viewKYC" name="permissions[view_kyc]" value="1"
                                {{ isset($permissionsArray['view_kyc']) && $permissionsArray['view_kyc'] == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="viewKYC">View KYC</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="changeKYC" name="permissions[change_kyc]" value="1"
                                {{ isset($permissionsArray['change_kyc']) && $permissionsArray['change_kyc'] == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="changeKYC">Edit KYC</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="approveKYC" name="permissions[approve_kyc]" value="1"
                                {{ isset($permissionsArray['approve_kyc']) && $permissionsArray['approve_kyc'] == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="approveKYC">Approve KYC</label>
                        </div>
                    </div>
                </div>
        
                <!-- Documents Section Rights -->
                <h5 class="fw-bold mb-3">Documents Section Rights</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="addDocuments" name="permissions[add_documents]" value="1"
                                {{ isset($permissionsArray['add_documents']) && $permissionsArray['add_documents'] == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="addDocuments">Add Documents</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="viewDocuments" name="permissions[view_documents]" value="1"
                                {{ isset($permissionsArray['view_documents']) && $permissionsArray['view_documents'] == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="viewDocuments">View Documents</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="changeDocuments" name="permissions[change_documents]" value="1"
                                {{ isset($permissionsArray['change_documents']) && $permissionsArray['change_documents'] == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="changeDocuments">Edit Documents</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="approveDocuments" name="permissions[approve_documents]" value="1"
                                {{ isset($permissionsArray['approve_documents']) && $permissionsArray['approve_documents'] == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="approveDocuments">Approve Documents</label>
                        </div>
                    </div>
                </div>
        
                <!-- Sales Section Rights -->
                <h5 class="fw-bold mb-3">Sales Section Rights</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="addSales" name="permissions[add_sales]" value="1"
                                {{ isset($permissionsArray['add_sales']) && $permissionsArray['add_sales'] == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="addSales">Add Sales</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="viewSales" name="permissions[view_sales]" value="1"
                                {{ isset($permissionsArray['view_sales']) && $permissionsArray['view_sales'] == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="viewSales">View Sales</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="changeSales" name="permissions[change_sales]" value="1"
                                {{ isset($permissionsArray['change_sales']) && $permissionsArray['change_sales'] == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="changeSales">Edit Sales</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="approveSales" name="permissions[approve_sales]" value="1"
                                {{ isset($permissionsArray['approve_sales']) && $permissionsArray['approve_sales'] == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="approveSales">Approve Sales</label>
                        </div>
                    </div>
                </div>
        
                <!-- Services Section Rights -->
                <h5 class="fw-bold mb-3">Services Section Rights</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="addServices" name="permissions[add_services]" value="1"
                                {{ isset($permissionsArray['add_services']) && $permissionsArray['add_services'] == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="addServices">Add Services</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="viewServices" name="permissions[view_services]" value="1"
                                {{ isset($permissionsArray['view_services']) && $permissionsArray['view_services'] == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="viewServices">View Services</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="changeServices" name="permissions[change_services]" value="1"
                                {{ isset($permissionsArray['change_services']) && $permissionsArray['change_services'] == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="changeServices">Edit Services</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="approveServices" name="permissions[approve_services]" value="1"
                                {{ isset($permissionsArray['approve_services']) && $permissionsArray['approve_services'] == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="approveServices">Approve Services</label>
                        </div>
                    </div>
                </div>
        
                <!-- Users Section Rights -->
                <h5 class="fw-bold mb-3">Users Section Rights</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="addUser" name="permissions[add_user]" value="1"
                                {{ isset($permissionsArray['add_user']) && $permissionsArray['add_user'] == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="addUser">Add User</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="viewUsers" name="permissions[view_users]" value="1"
                                {{ isset($permissionsArray['view_users']) && $permissionsArray['view_users'] == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="viewUsers">View Users</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="changeUser" name="permissions[change_user]" value="1"
                                {{ isset($permissionsArray['change_user']) && $permissionsArray['change_user'] == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="changeUser">Edit User</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

   
    </div>

</form>
</div>


<script>
    function handlePermissionChange(approveId, changeId, addId, viewId) {
        const approveElement = document.getElementById(approveId);
        const changeElement = document.getElementById(changeId);
        const addElement = document.getElementById(addId);
        const viewElement = document.getElementById(viewId);

        // Handle "Approve" permission logic
        approveElement.addEventListener('change', function () {
            if (this.checked) {
                addElement.checked = true;
                viewElement.checked = true;
                changeElement.checked = true;
            }
        });

        // Handle "Change" permission logic
        changeElement.addEventListener('change', function () {
            if (this.checked) {
                addElement.checked = true;
                viewElement.checked = true;
            }
        });
    }

    // Apply the function to each permission section
    handlePermissionChange('approveKYC', 'changeKYC', 'addKYC', 'viewKYC');
    handlePermissionChange('approveDocuments', 'changeDocuments', 'addDocuments', 'viewDocuments');
    handlePermissionChange('approveSales', 'changeSales', 'addSales', 'viewSales');
    handlePermissionChange('approveServices', 'changeServices', 'addServices', 'viewServices');

</script>

@endsection
