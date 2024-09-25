<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddDepartment" aria-labelledby="offcanvasAddDepartmentLabel">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasAddDepartmentLabel" class="offcanvas-title">Add Department</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
        <form class="pt-0" id="addNewDepartmentForm" method="POST" action="{{ route('departments.store') }}">
            @csrf

            <!-- Title Field -->
            <div class="mb-6">
                <label class="form-label" for="add-department-title">Department Title</label>
                <input type="text" class="form-control" id="add-department-title" placeholder="Enter department title" name="departmentTitle" aria-label="Department Title" required />
            </div>

            <!-- Supervisor Dropdown -->
            <div class="mb-6">
                <label class="form-label" for="add-department-supervisor">Supervisor</label>
                <select id="add-department-supervisor" class="form-select" name="supervisor_id" required>
                    <option value="">Select Supervisor</option>
                    @foreach($users as $user) <!-- Assuming $users is passed from the controller -->
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit & Cancel Buttons -->
            <button type="submit" class="btn btn-primary me-3 data-submit">Submit</button>
            <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </div>
</div>
