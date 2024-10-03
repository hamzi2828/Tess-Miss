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
            'department' => $data['department_id'] ?? 'null',
            'role' => $data['userRole'] ?? 'null',
            'status' => $data['userStatus'],
            'address' => $data['userAddress'] ?? 'null',
            'picture' => $filePath, // Store image path
            'userGender' => $data['userGender'] ?? 'null',
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
        $user->department = $data['department_id'] ?? 'null';
        $user->role = $data['userRole'] ?? 'null';
        $user->status = $data['userStatus'];
        $user->address = $data['userAddress'] ?? null;
        $user->userGender = $data['userGender'] ?? null;
   

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
        // Delete previous permissions if any
        UserPermission::where('user_id', $user->id)->delete();
    
        // Create or update new permissions record
        $userPermission = new UserPermission();
        $userPermission->user_id = $user->id;
        $userPermission->permissions = json_encode($permissions);
    
        // Save the new permissions record
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
