@extends('master.master')

@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="app-ecommerce-department">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="fw-bold">Departments</h4>
                <div class="d-flex col-lg-5">
                    <input type="text" id="customDepartmentSearch" class="form-control me-2" placeholder="Search departments" onkeyup="filterTable()">
                    <button class="btn btn-primary btn-lg" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddDepartment" style="width: 394px;">
                        <i class="ti ti-plus me-1"></i> Add Department
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-datatable table-responsive">
                    <table id="customDepartmentTable" class="table border-top">
                        <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Department Title</th> 
                                <th>Supervisor Name</th>
                                <th>Stage</th>
                                <th>Added By</th>
                                <th>Date Added</th>
                                <th class="text-lg-center">Actions</th>
                            </tr>
                        </thead>
                       <tbody>
                    
                   
                            @php $i = 1; @endphp
                            @foreach($departments as $department)
                            <tr>
                                <td></td>
                                <td>{{ $i++ }}</td>
                                <td>{{ $department->title }}</td>
                                <td>
                                    @foreach($department->users as $user)
                                        {{ $user->name }}<br>
                                    @endforeach
                                </td> 
                                <td>
                                    @switch($department->stage)
                                        @case(1)
                                            Stage 1 - KYC
                                            @break
                                        @case(2)
                                            Stage 2 - Document
                                            @break
                                        @case(3)
                                            Stage 3 - Sales
                                            @break
                                        @case(4)
                                            Stage 4 - Services
                                            @break
                                        @default
                                            <!-- Default case for undefined stages -->
                                            Not Assigned
                                    @endswitch
                                </td>
                                
                                <td>{{ $department->addedBy->name }}</td> 
                                <td>{{ $department->date_added }}</td>

                                <td class="text-lg-center">
                                    <div class="d-flex justify-content-center align-items-center">

                                         <!-- Edit Button -->
                                     <button class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1 edit-department-btn"
                                         data-bs-toggle="offcanvas" 
                                         data-bs-target="#offcanvasEditDepartment" 
                                         data-id="{{ $department->id }}"
                                         data-title="{{ $department->title }}"
                                         data-supervisor="{{ $department->supervisor->id ?? '' }}"
                                         data-added_by="{{ $department->addedBy->id }}"
                                         data-date_added="{{ $department->date_added }}"
                                         data-stage="{{ $department->stage }}"
                                         data-users="{{ $department->users->pluck('name')->implode(', ') }}"> 
                                         <i class="ti ti-edit"></i>
                                     </button>
                                     
                                     
                            

                                     <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-icon btn-text-secondary rounded-pill waves-effect waves-light mx-1">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                    
                                    <script>
                                        function confirmDelete() {
                                            return confirm('Are you sure you want to delete this department?');
                                        }
                                    </script>
                                    

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody> 
                    </table>
                </div>
            </div>

            {{-- Create Department Modal --}}
            @include('pages.department.department-create-modal')

            {{-- Edit Department Modal --}}
            @include('pages.department.department-edit-modal')
        </div>
    </div>

    <div class="content-backdrop fade"></div>
</div>

<script>
    // Function to filter table rows based on the search input
    function filterTable() {
        let input = document.getElementById('customDepartmentSearch');
        let filter = input.value.toLowerCase();
        let table = document.getElementById('customDepartmentTable');
        let rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
            let cells = rows[i].getElementsByTagName('td');
            let match = false;

            for (let j = 0; j < cells.length; j++) {
                let cellValue = cells[j].textContent || cells[j].innerText;
                if (cellValue.toLowerCase().indexOf(filter) > -1) {
                    match = true;
                    break;
                }
            }

            if (match) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
</script>

@endsection
