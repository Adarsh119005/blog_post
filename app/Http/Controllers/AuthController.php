<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered; 
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showRegisterForm(){
        return view('Sign');

    }

    
   public function register(Request $request)
    {

         
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        register_shutdown_function(function () {
            $error = error_get_last();
            if ($error && str_contains($error['message'], 'Maximum execution time')) {
                // Redirect or show custom error page
                header("Location: " . url('/timeout-error'));
                exit;
            }
        });

        event(new Registered($user)); 

        Auth::login($user);

        return redirect('/')->with('success', 'Registered successfully. Check your email to verify.');
    }



    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        throw ValidationException::withMessages([
            'email' => 'Invalid email or Password.',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}