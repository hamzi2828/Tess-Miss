<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('pages.users.users-list', compact('users'));
    }


    public function create(){

        return view('pages.users.create-user');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // Validate the request data
        $validatedData = $request->validate([
            'userFullname' => 'required|string|max:255',
            'userPassword' => 'required|string|min:8',
            'userEmail' => 'required|email|unique:users,email',
            'userPhone' => 'required|string|max:20',
            'userDepartment' => 'nullable|string|max:100',
            'userRole' => 'nullable|string',
            'userStatus' => 'required|in:active,inactive',
            'userAddress' => 'nullable|string|max:500',
            'userPicture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // Use the UserService to create the user and get the created user object
        $user = $this->userService->createUser($validatedData);
    
        // Redirect with success message to edit the newly created user
        return redirect()->route('users.edit', ['user_id' => $user->id])->with('success', 'User created successfully.');
    }
    public function edit(Request $request)
    {
        // Get the user ID from the request
        $userId = $request->input('user_id');
        $user = User::findOrFail($userId);
    
        // Get the user's permissions
        $permissions = UserPermission::firstOrNew(['user_id' => $user->id]);
    
        // Decode the permissions, or use them directly if they're already an array
        $permissionsArray = is_string($permissions->permissions) ? json_decode($permissions->permissions, true) : $permissions->permissions ?? [];
    
        return view('pages.users.edit-user', compact('user', 'permissionsArray'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        
       
        // Validate the request data
        $validatedData = $request->validate([
            'userFullname' => 'required|string|max:255',
            'userEmail' => 'required|email|max:255',
            'userPhone' => 'nullable|string|max:20',
            'userDepartment' => 'nullable|string|max:255',
            'userRole' => 'nullable|string|max:50',
            'userStatus' => 'required|string|in:active,inactive',
            'userPicture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'permissions' => 'nullable|array', 
            'userAddress' => 'nullable|string|max:500',
        
        ]);
        

        // Use the UserService to update the user
        $this->userService->updateUser($user, $validatedData);
        $this->userService->updateUserPermissions($user, $request->input('permissions', []));

        // Redirect back with a success message
        return redirect()->back()->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Use the UserService to delete the user
        $this->userService->deleteUser($user);

        // Redirect with a success message
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
