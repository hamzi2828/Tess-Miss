<?php

namespace App\Services;

use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DepartmentService
{
    /**
     * Get all departments
     */
    public function getAllDepartments()
    {
       
        $departments = Department::with('users')->get();
        
       return $departments; 
    }
    
    

    /**
     * Store a new department
     */
    public function storeDepartment($validatedData)
    {
        // Create a new Department record
        $department = Department::create([
            'title' => $validatedData['departmentTitle'],
            'supervisor_id' => null,
            'stage' => $validatedData['department_stage'], 
            'added_by' => Auth()->user()->id,
            'date_added' => now(),
        ]);
    
        
        $user = User::find($validatedData['supervisor_id']); 
    
        if ($user) {
            $user->department = $department->id; 
            $user->save();
        }
    
        return $department; 
    }
    
    /**
     * Update an existing department
     */
    // public function updateDepartment($validatedData, Department $department)
    // {
    //     // Update the department with the new data
    //     return $department->update([
    //         'title' => $validatedData['departmentTitle'],
    //         'supervisor_id' => $validatedData['supervisor_id'],
    //     ]);
    // }

    /**
     * Update an existing department
     */
    public function updateDepartment($validatedData, Department $department)
    {
        // Update the department with the new data
        $department->update([
            'title' => $validatedData['departmentTitle'],
            'supervisor_id' => null, 
            'stage' => $validatedData['department_stage'], 
        ]);

        // Update the supervisor's department if the supervisor is changed
        if (isset($validatedData['new_supervisor_id'])) {
            $user = User::find($validatedData['new_supervisor_id']);
            
            if ($user) {
                $user->department = $department->id; 
                $user->save();
            }
        }

        return $department; // Return the updated department
    }




    /**
     * Delete a department
     */
    public function deleteDepartment(Department $department)
    {
        return $department->delete();
    }
}
