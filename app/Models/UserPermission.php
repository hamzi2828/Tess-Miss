<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_permissions'; // Define the table name explicitly if it differs from default plural form

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', // Foreign key to users table
        'add_kyc',
        'view_kyc',
        'change_kyc',
        'approve_kyc',
        'add_documents',
        'view_documents',
        'change_documents',
        'approve_documents',
        'add_sales',
        'view_sales',
        'change_sales',
        'approve_sales',
        'add_services',
        'view_services',
        'change_services',
        'approve_services',
        'add_user',
        'view_users',
        'change_user'
    ];

    /**
     * Get the user that owns the permission.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
