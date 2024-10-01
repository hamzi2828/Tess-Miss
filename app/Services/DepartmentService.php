<?php

namespace App\Services;

use App\Models\Department;
use Illuminate\Support\Facades\DB;

class DepartmentService
{
    /**
     * Get all departments
     */
    public function getAllDepartments()
    {
        return Department::all();
    }

    /**
     * Store a new department
     */
    public function storeDepartment($validatedData)
    {
        // Create a new Department record
        return Department::create([
            'title' => $validatedData['departmentTitle'],
            'supervisor_id' => $validatedData['supervisor_id'],
            'added_by' => Auth()->user()->id,
            'date_added' => now(),
        ]);
    }

    /**
     * Update an existing department
     */
    public function updateDepartment($validatedData, Department $department)
    {
        // Update the department with the new data
        return $department->update([
            'title' => $validatedData['departmentTitle'],
            'supervisor_id' => $validatedData['supervisor_id'],
        ]);
    }

    /**
     * Delete a department
     */
    public function deleteDepartment(Department $department)
    {
        return $department->delete();
    }
}
