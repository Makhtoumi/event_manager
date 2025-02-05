<?php 
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validate user registration data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Email format and uniqueness check
            'password' => 'required|string|min:8|confirmed',
        ], [
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'The email is already taken. Please choose another.',
        ]);

        // Create a new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect after registration
        return redirect()->route('login')->with('success', 'Registration successful!');
    }
}
