<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rej;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Mail\emailMailable;
use App\Mail\TestMail;

class DbController extends Controller

{
    
    public function signup(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'full_name' => 'required',
            'user_name' => 'required|unique:Rejs',
            'birthday' => 'required|date',
            'phone' => 'required',
            'address' => 'required',
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[@$!%*#?&])(?=.*[0-9]).{8,}$/'
            ],
            'email' => 'required|email|unique:Rejs',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        // Check if user already exists
        if (Rej::where('user_name', $request->user_name)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'User already exists.'
            ]);
        }
    
        // Move uploaded photo to images directory
        $file_name = time() . '.' . $request->photo->getClientOriginalExtension();
        $request->photo->move(public_path('images'), $file_name);
    
        // Send email notification
        Mail::to('saifeldeen201770@gmail.com')->send(new TestMail($request->user_name));
    
        // Insert data into the database using Eloquent
        Rej::create([
            'full_name' => $validatedData['full_name'],
            'user_name' => $validatedData['user_name'],
            'birthday' => $validatedData['birthday'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'password' => Crypt::encrypt($validatedData['password']),
            'email' => $validatedData['email'],
            'photo' => $file_name,
        ]);
    
        // Return success response
        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully.'
        ]);
    }
    
}
