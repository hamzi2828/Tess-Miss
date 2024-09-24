<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">User Info</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
        <form class="pt-0" id="addNewUserForm" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Full Name -->
            <div class="mb-6">
                <label class="form-label" for="add-user-fullname">Full Name</label>
                <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe" name="userFullname" aria-label="John Doe" />
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label class="form-label" for="add-user-password">Password</label>
                <input type="password" class="form-control" id="add-user-password" placeholder="Enter password" name="userPassword" aria-label="Password" />
            </div>

            <!-- Email -->
            <div class="mb-6">
                <label class="form-label" for="add-user-email">Email</label>
                <input type="email" id="add-user-email" class="form-control" placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="userEmail" />
            </div>

            <!-- Phone -->
            <div class="mb-6">
                <label class="form-label" for="add-user-phone">Phone</label>
                <input type="tel" id="add-user-phone" class="form-control phone-mask" placeholder="+1 (609) 988-44-11" name="userPhone" />
            </div>

            <!-- Department -->
            <div class="mb-6">
                <label class="form-label" for="add-user-department">Department</label>
                <select id="add-user-department" class="form-select" name="userDepartment">
                    <option value="">Select Department</option>
                    <option value="HR">HR</option>
                    <option value="IT">IT</option>
                    <option value="Finance">Finance</option>
                    <option value="Marketing">Marketing</option>
                </select>
            </div>

            <!-- User Role -->
            <div class="mb-6">
                <label class="form-label" for="user-role">User Role</label>
                <select id="user-role" class="form-select" name="userRole">
                    <option value="subscriber">Subscriber</option>
                    <option value="editor">Editor</option>
                    <option value="maintainer">Maintainer</option>
                    <option value="author">Author</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <!-- Status -->
            <div class="mb-6">
                <label class="form-label" for="user-status">Status</label>
                <select id="user-status" class="form-select" name="userStatus">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <!-- File input -->
            <div class="mb-6">
                <label class="form-label" for="file-input">File input</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="file-input" name="userPicture" accept="image/*" onchange="previewImage(event)">
                </div>
            </div>

            <!-- Image Preview -->
            <div class="mb-6">
                <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 100%; height: auto; display: none;">
            </div>

            <!-- Address -->
            <div class="mb-6">
                <label class="form-label" for="add-user-address">Address</label>
                <textarea id="add-user-address" class="form-control" placeholder="Enter address" rows="3" name="userAddress"></textarea>
            </div>

            <!-- Submit & Cancel Buttons -->
            <button type="submit" class="btn btn-primary me-3 data-submit">Submit</button>
            <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </div>
</div>
