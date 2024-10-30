<?php

namespace App\Http\Controllers;

use App\Models\JenisPenggunaModel; // Ensure this model exists and is correctly set up
use App\Models\PenggunaModel; // Ensure this model exists and is correctly set up
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('/'); // Redirect logged-in users to the homepage
        }
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        // Menggunakan 'email' sebagai username
        $credentials = $request->only('email', 'password'); 

        if (Auth::attempt($credentials)) {
            return response()->json([
                'status' => true,
                'message' => 'Login Berhasil',
                'redirect' => url('/') // Redirect user after successful login
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Login Gagal'
        ], 401); // Added 401 status for failed login
    }


    public function logout(Request $request)
    {
        Auth::logout(); // Log out the user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/login')->with('success', 'Anda berhasil logout.'); // Redirect after logout
    }

    public function postregister()
    {
        // Fetch the list of user types from the database
        $jenisPengguna = JenisPenggunaModel::all(); 
        return view('auth.register', compact('jenisPengguna')); // Pass to the view
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_jenis_pengguna' => 'required|integer|exists:jenis_pengguna,id_jenis_pengguna',
            'username' => 'required|string|min:4|max:20|unique:pengguna,username',
            'nama' => 'required|string|max:100', // Adjusted max length to match DB
            'email' => 'required|email|max:100|unique:pengguna,email', // Ensure email is validated and unique
            'password' => 'required|string|min:6',
            'NIP' => 'nullable|string|max:20', // Optional field
            'terms' => 'accepted', // Ensure terms checkbox is checked
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        }

        // Create new user
        $user = new PenggunaModel();
        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->email = $request->email; // Save email
        $user->password = Hash::make($request->password); // Hash the password
        $user->NIP = $request->NIP; // Save NIP, if provided
        $user->id_jenis_pengguna = $request->id_jenis_pengguna; // Store foreign key
        $user->save();

        return response()->json(['status' => true, 'message' => 'Registrasi berhasil!', 'redirect' => url('/login')]);
    }

}
