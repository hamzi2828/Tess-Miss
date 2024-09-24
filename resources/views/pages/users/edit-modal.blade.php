
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditUser" aria-labelledby="offcanvasEditUserLabel">
  <div class="offcanvas-header border-bottom">
      <h5 id="offcanvasEditUserLabel" class="offcanvas-title">Edit Info</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
      <form class="pt-0" id="editUserForm" method="POST" action="" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <!-- Full Name -->
          <div class="mb-6">
              <label class="form-label" for="edit-user-fullname">Full Name</label>
              <input type="text" class="form-control" id="edit-user-fullname" name="userFullname" required />
          </div>

          <!-- Email -->
          <div class="mb-6">
              <label class="form-label" for="edit-user-email">Email</label>
              <input type="email" id="edit-user-email" class="form-control" name="userEmail" required />
          </div>

          <!-- Phone -->
          <div class="mb-6">
              <label class="form-label" for="edit-user-phone">Phone</label>
              <input type="tel" id="edit-user-phone" class="form-control" name="userPhone" />
          </div>

          <!-- Department -->
          <div class="mb-6">
              <label class="form-label" for="edit-user-department">Department</label>
              <select id="edit-user-department" class="form-select" name="userDepartment" required>
                  <option value="">Select Department</option>
                  <option value="HR">HR</option>
                  <option value="IT">IT</option>
                  <option value="Finance">Finance</option>
                  <option value="Marketing">Marketing</option>
              </select>
          </div>

          <!-- User Role -->
          <div class="mb-6">
              <label class="form-label" for="edit-user-role">User Role</label>
              <select id="edit-user-role" class="form-select" name="userRole" required>
                  <option value="subscriber">Subscriber</option>
                  <option value="editor">Editor</option>
                  <option value="maintainer">Maintainer</option>
                  <option value="author">Author</option>
                  <option value="admin">Admin</option>
              </select>
          </div>

          <!-- Status -->
          <div class="mb-6">
              <label class="form-label" for="edit-user-status">Status</label>
              <select id="edit-user-status" class="form-select" name="userStatus" required>
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
              </select>
          </div>

          <!-- Current Profile Picture Preview -->
          <div class="mb-6">
              <label class="form-label" for="current-user-picture">Current Profile Picture</label>
              <img id="current-user-picture" src="#" alt="Current Profile Picture" style="max-width: 100%; height: auto; display: none;" />
          </div>

          <!-- File input -->
          <div class="mb-6">
              <label class="form-label" for="file-input">Change Profile Picture</label>
              <div class="input-group">
                  <input type="file" class="form-control" id="file-input" name="userPicture" accept="image/*">
              </div>
          </div>

          <!-- Image Preview -->
          <div class="mb-6">
              <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 100%; height: auto; display: none;">
          </div>

          <!-- Submit & Cancel Buttons -->
          <button type="submit" class="btn btn-primary me-3">Update</button>
          <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
      </form>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Handle Edit Button Click
    document.querySelectorAll('.edit-user-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            const userID = this.getAttribute('data-id');
            const userName = this.getAttribute('data-name');
            const userEmail = this.getAttribute('data-email');
            const userPhone = this.getAttribute('data-phone');
            const userDepartment = this.getAttribute('data-department');
            const userRole = this.getAttribute('data-role');
            const userStatus = this.getAttribute('data-status');
            const userPicture = this.getAttribute('data-picture');

            // Set form action for updating the user
            document.getElementById('editUserForm').action = '{{ route("users.update", ":id") }}'.replace(':id', userID);

            // Populate fields in the modal with user data
            document.getElementById('edit-user-fullname').value = userName;
            document.getElementById('edit-user-email').value = userEmail;
            document.getElementById('edit-user-phone').value = userPhone;
            document.getElementById('edit-user-department').value = userDepartment;
            document.getElementById('edit-user-role').value = userRole;
            document.getElementById('edit-user-status').value = userStatus;

            // Show the current profile picture if it exists
            const currentPicture = document.getElementById('current-user-picture');
            if (userPicture) {
                currentPicture.src = '/storage/' + userPicture; // Set the src for the image
                currentPicture.style.display = 'block'; // Show the image
            } else {
                currentPicture.style.display = 'none'; // Hide if there's no image
            }

            // Reset the image preview
            document.getElementById('imagePreview').style.display = 'none'; // Hide image preview
        });
    });

    // Function to preview the selected image
    document.getElementById('file-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const imagePreview = document.getElementById('imagePreview');
        const currentPicture = document.getElementById('current-user-picture');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result; // Set the new image source for preview
                imagePreview.style.display = 'block'; // Show the image preview
                currentPicture.src = e.target.result; // Replace current picture with new image
                currentPicture.style.display = 'block'; // Show the updated current picture
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '#'; // Reset if no file is selected
            imagePreview.style.display = 'none';
        }
    });
  });
</script>