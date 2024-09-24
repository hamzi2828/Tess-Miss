<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $users = User::all();
        
        // Render the view and pass the users to the front end
        return view('pages.users.users-list', compact('users'));
    }
    
    



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
            // Validate the request data
        $request->validate([
            'userFullname' => 'required|string|max:255',
            'userPassword' => 'required|string|min:8',
            'userEmail' => 'required|email|unique:users,email',
            'userPhone' => 'required|string|max:20',
            'userDepartment' => 'required|string|max:100',
            'userRole' => 'required|string',
            'userStatus' => 'required|in:active,inactive',
            'userAddress' => 'nullable|string|max:500',
            'userPicture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('userPicture')) {
            // Store the file in a folder called 'uploads' inside the public directory
            $filePath = $request->file('userPicture')->store('uploads', 'public');
        } else {
            $filePath = null; // Set null if no image is uploaded
        }

        // Create the user
        $user = User::create([
            'name' => $request->input('userFullname'),
            'email' => $request->input('userEmail'),
            'password' => Hash::make($request->input('userPassword')), // Hash the password
            'phone' => $request->input('userPhone'),
            'department' => $request->input('userDepartment'),
            'role' => $request->input('userRole'),
            'status' => $request->input('userStatus'),
            'address' => $request->input('userAddress'),
            'picture' => $filePath, // Store image path
        ]);

        // Redirect or return a response
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   
     public function update(Request $request, User $user)
     {
        
         // Validate the incoming request
         $validatedData = $request->validate([
             'userFullname' => 'required|string|max:255',
             'userEmail' => 'required|email|max:255',
             'userPhone' => 'nullable|string|max:20',
             'userDepartment' => 'required|string|max:255',
             'userRole' => 'required|string|max:50',
             'userStatus' => 'required|string|in:active,inactive',
             'userPicture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
         ]);
 
         // Update user information
         $user->name = $validatedData['userFullname'];
         $user->email = $validatedData['userEmail'];
         $user->phone = $validatedData['userPhone'];
         $user->department = $validatedData['userDepartment'];
         $user->role = $validatedData['userRole'];
         $user->status = $validatedData['userStatus'];
 
         // Handle profile picture upload if there's a new picture
         if ($request->hasFile('userPicture')) {
             // Store the image and get the path
             $imagePath = $request->file('userPicture')->store('profile_pictures', 'public');
 
             // Save the image path in the database
             $user->profile_picture = $imagePath;
         }
 
         // Save updated user information
         $user->save();
 
         // Redirect back with a success message
         return redirect()->back()->with('success', 'User updated successfully');
     }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
