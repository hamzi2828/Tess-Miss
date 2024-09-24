@extends('master.master')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce-user">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="fw-bold">Users</h4>
                <div class="d-flex col-lg-5">
                    <input type="text" id="userSearch" class="form-control me-2" placeholder="Search users">
                    <button class="btn btn-primary btn-lg" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser" style="width: 224px;">
                        <i class="ti ti-plus me-1"></i> Add User
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-datatable table-responsive">
                    <table id="userTable" class="table border-top users">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>User</th>
                                <th>Role</th>
                                <th>Department</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th class="text-lg-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($users as $user)
                            <tr>
                                <td></td>
                                <td>{{ $i++ }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($user->picture) <!-- Check if the picture exists -->
                                            <img src="{{ asset('storage/' . $user->picture) }}" alt="Avatar" class="rounded-circle me-2" style="width: 50px; height: 50px;">
                                        @else
                                            @php
                                                // Generate initials if no picture is available
                                                $initials = strtoupper(substr($user->name, 0, 2)); // Use first two initials for a better representation
                                                $stateNum = rand(0, 5);
                                                $states = ['success', 'danger', 'warning', 'info', 'primary', 'secondary'];
                                                $state = $states[$stateNum];
                                            @endphp
                                            <span class="avatar-initial rounded-circle bg-label-{{ $state }} me-2" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                                {{ $initials }}
                                            </span>
                                        @endif
                                        <div>
                                            <span class="text-heading text-wrap fw-medium">{{ $user->name }}</span><br>
                                            <small>{{ $user->email }}</small>
                                        </div>
                                    </div>
                                    
                                </td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user->department }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->status }}</td>
                                <td class="text-lg-center">
                                    <div class="d-flex justify-content-center align-items-center">

                                      <button class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1 edit-user-btn"
                                        data-bs-toggle="offcanvas" 
                                        data-bs-target="#offcanvasEditUser" 
                                        data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}"
                                        data-phone="{{ $user->phone }}"
                                        data-picture="{{ $user->picture }}"
                                        data-department="{{ $user->department }}"
                                        data-role="{{ $user->role }}"
                                        data-status="{{ $user->status }}">
                                        <i class="ti ti-edit"></i>
                                    </button>

                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:            inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
            </div>

            {{-- Create User Modal --}}
            @include('pages.users.create-modal')

            {{-- Edit User Modal --}}
            @include('pages.users.edit-modal')
        </div>
    </div>

    <div class="content-backdrop fade"></div>
</div>
@endsection

@section('scripts')
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

<!-- Include DataTables JS -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#userTable').DataTable({
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
    });

    // Custom search input
    $('#userSearch').on('keyup', function() {
        table.search(this.value).draw();
    });

    // Debugging: Log to check if search input is detected
    $('#userSearch').on('keyup', function() {
        console.log("Searching for: ", this.value); // Log the input value
    });
});
</script>
@endsection
