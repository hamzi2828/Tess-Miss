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
    
        // Render the view and pass the users to the front end
        return view('pages.users.users-list');
    }
    


    public function getUsers()
    {
        // Fetch users from the database
        $users = User::all();
    
        // Ensure the directory exists
        if (!is_dir(public_path('assets/json'))) {
            mkdir(public_path('assets/json'), 0755, true); // Create the directory if it doesn't exist
        }
    
        // Define the JSON file path
        $jsonFilePath = public_path('assets/json/user-list.json');
        
        // Write the data to the JSON file with error handling
        $result = file_put_contents($jsonFilePath, json_encode(['data' => $users], JSON_PRETTY_PRINT), LOCK_EX);
    
        if ($result === false) {
            return response()->json(['error' => 'Failed to write to the JSON file'], 500);
        }
    
        // Optionally return the users as JSON response
        return response()->json(['data' => $users]);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
