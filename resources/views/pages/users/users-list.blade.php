@extends('master.master')

@push('css')
@endpush

@section('content')
      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
          <!-- Users List Table -->
          <div class="card">
            <div class="card-datatable table-responsive">
              <table class="datatables-users table">
                <thead class="border-top">
                  <tr>
                    <th></th>              <!-- Responsive control column -->
                    <th></th>              <!-- Checkbox column -->
                    <th>User</th>          <!-- User name and email -->
                    <th>Role</th>          <!-- User role -->
                    <th>Department</th>    <!-- Department column -->
                    <th>Phone</th>         <!-- Phone column -->
                    <th>Status</th>        <!-- Status column -->
                    <th>Actions</th>       <!-- Actions column -->
                  </tr>
                </thead>
              </table>
            </div>
            @include('pages.users.add-users')
          </div>
        </div>
        <!-- / Content -->

        <div class="content-backdrop fade"></div>
      </div>
@endsection

<script>
 window.reload(/)
</script>