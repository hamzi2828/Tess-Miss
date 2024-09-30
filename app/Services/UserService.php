<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    /**
     * Create a new user.
     *
     * @param array $data
     * @return User
     */
    public function createUser(array $data): User
    {
        // Handle image upload
        if (isset($data['userPicture']) && $data['userPicture']->isValid()) {
            $filePath = $data['userPicture']->store('uploads', 'public');
        } else {
            $filePath = null; // Set null if no image is uploaded
        }

        // Create the user
        return User::create([
            'name' => $data['userFullname'],
            'email' => $data['userEmail'],
            'password' => Hash::make($data['userPassword']), // Hash the password
            'phone' => $data['userPhone'],
            'department' => $data['userDepartment'] ?? null,
            'role' => $data['userRole'] ?? null,
            'status' => $data['userStatus'],
            'address' => $data['userAddress']    ?? null,
            'picture' => $filePath, // Store image path
        ]);
    }

    /**
     * Update an existing user.
     *
     * @param User $user
     * @param array $data
     * @return User
     */
    public function updateUser(User $user, array $data): User
    {
        // Update user information
        $user->name = $data['userFullname'];
        $user->email = $data['userEmail'];
        $user->phone = $data['userPhone'] ?? null;
        $user->department = $data['userDepartment'] ?? null;
        $user->role = $data['userRole'] ?? null;
        $user->status = $data['userStatus'];
   

            // Handle profile picture upload if there's a new picture
        if (isset($data['userPicture']) && $data['userPicture']->isValid()) {
            // Remove the old picture if it exists
            if ($user->picture) {
                Storage::disk('public')->delete($user->picture);
            }

            // Store the new image and get the path
            $imagePath = $data['userPicture']->store('uploads', 'public');
            $user->picture = $imagePath;
        }

        // Save updated user information
        $user->save();

        return $user;
    }

    public function updateUserPermissions(User $user, array $permissions): void
    {
        // Retrieve the existing permission record or create a new one if it doesn't exist
        $userPermission = UserPermission::firstOrNew(['user_id' => $user->id]);
    
        // Initialize all permissions to false (0)
        $permissionData = [
            'add_kyc' => 0,
            'view_kyc' => 0,
            'change_kyc' => 0,
            'approve_kyc' => 0,
            'add_documents' => 0,
            'view_documents' => 0,
            'change_documents' => 0,
            'approve_documents' => 0,
            'add_sales' => 0,
            'view_sales' => 0,
            'change_sales' => 0,
            'approve_sales' => 0,
            'add_services' => 0,
            'view_services' => 0,
            'change_services' => 0,
            'approve_services' => 0,
            'add_user' => 0,
            'view_users' => 0,
            'change_user' => 0,
        ];
    
        // Loop through the permissions array from the request and set corresponding fields to true (1)
        foreach ($permissions as $permission) {
            $field = strtolower(str_replace(['add', 'view', 'change', 'approve'], ['add_', 'view_', 'change_', 'approve_'], $permission));
            if (array_key_exists($field, $permissionData)) {
                $permissionData[$field] = 1;
            }
        }
    
        // Update or create the user permission record
        $userPermission->fill($permissionData);
        $userPermission->save();
    }
    
    

    /**
     * Delete a user.
     *
     * @param User $user
     * @return bool
     */
    public function deleteUser(User $user): bool
    {
        // Optionally delete user picture if it exists
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        return $user->delete();
    }
}
