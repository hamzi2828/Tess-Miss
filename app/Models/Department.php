<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Department extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'supervisor_id', 'added_by', 'date_added', 'stage'];

    // Relationship with the User model for Supervisor
    public function users()
    {
        return $this->hasMany(User::class, 'department'); 
    }
    
    

    // Relationship with the User model for Added By
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function getDepartmentTitle($departmentId)
    {
        
        $department = Department::find($departmentId);
        return $department ? $department->title : 'N/A';
    }
}
