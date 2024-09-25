<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditDepartment" aria-labelledby="offcanvasEditDepartmentLabel">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasEditDepartmentLabel" class="offcanvas-title">Edit Department</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
        <form class="pt-0" id="editDepartmentForm" method="POST" action="" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Department Title -->
            <div class="mb-6">
                <label class="form-label" for="edit-department-title">Department Title</label>
                <input type="text" class="form-control" id="edit-department-title" name="departmentTitle" required />
            </div>

            <!-- Supervisor Dropdown -->
            <div class="mb-6">
                <label class="form-label" for="edit-department-supervisor">Supervisor</label>
                <select id="edit-department-supervisor" class="form-select" name="supervisor_id" required>
                    <option value="">Select Supervisor</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
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
      document.querySelectorAll('.edit-department-btn').forEach(function(button) {
          button.addEventListener('click', function() {
              const departmentID = this.getAttribute('data-id');
              const departmentTitle = this.getAttribute('data-title');
              const supervisorID = this.getAttribute('data-supervisor');

              // Set form action for updating the department
              document.getElementById('editDepartmentForm').action = '/departments/' + departmentID;

              // Populate fields in the modal with department data
              document.getElementById('edit-department-title').value = departmentTitle;
              document.getElementById('edit-department-supervisor').value = supervisorID;
          });
      });
    });
</script>
