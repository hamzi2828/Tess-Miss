<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * General method to check user permissions.
     */private function hasPermission(User $user, string $permission): bool
        {
            // Retrieve permissions from the user (ensure it's not null)
            $permissions = $user->permissions->permissions ?? '{}';

            // Decode only if it's a string
            if (is_string($permissions)) {
                $permissions = json_decode($permissions, true);
            }

            // Convert string "1" to integer 1
            $permissions = array_map(function($value) {
                return $value === "1" ? 1 : $value;
            }, $permissions);

            // Log the permissions to check if they are being decoded properly
            \Log::info('Decoded Permissions: ', $permissions);

            // Check if the permission exists and is set to 1
            return isset($permissions[$permission]) && $permissions[$permission] === 1;
        }

    // KYC Section
    public function addKYC(User $user)
    {
        return $this->hasPermission($user, 'add_kyc');
    }

    public function viewKYC(User $user)
    {
        return $this->hasPermission($user, 'view_kyc');
    }

    public function changeKYC(User $user)
    {
        return $this->hasPermission($user, 'change_kyc');
    }

    public function approveKYC(User $user)
    {
        return $this->hasPermission($user, 'approve_kyc');
    }

    // Documents Section
    public function addDocuments(User $user)
    {
        return $this->hasPermission($user, 'add_documents');
    }

    public function viewDocuments(User $user)
    {
        return $this->hasPermission($user, 'view_documents');
    }

    public function changeDocuments(User $user)
    {
        return $this->hasPermission($user, 'change_documents');
    }

    public function approveDocuments(User $user)
    {
        return $this->hasPermission($user, 'approve_documents');
    }

    // Sales Section
    public function addSales(User $user)
    {
        return $this->hasPermission($user, 'add_sales');
    }

    public function viewSales(User $user)
    {
        return $this->hasPermission($user, 'view_sales');
    }

    public function changeSales(User $user)
    {
        return $this->hasPermission($user, 'change_sales');
    }

    public function approveSales(User $user)
    {
        return $this->hasPermission($user, 'approve_sales');
    }

    // Services Section
    public function addServices(User $user)
    {
        return $this->hasPermission($user, 'add_services');
    }

    public function viewServices(User $user)
    {
        return $this->hasPermission($user, 'view_services');
    }

    public function changeServices(User $user)
    {
        return $this->hasPermission($user, 'change_services');
    }

    public function approveServices(User $user)
    {
        return $this->hasPermission($user, 'approve_services');
    }

    // Users Section 
    public function addUser(User $user)
    {
        return $this->hasPermission($user, 'add_user');
    }

    public function viewUsers(User $user)
    {
        return $this->hasPermission($user, 'view_users');
    }

    public function changeUser(User $user)
    {
        return $this->hasPermission($user, 'change_user');
    }
}


