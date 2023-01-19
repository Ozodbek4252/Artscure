<?php

namespace App\Http\Controllers\Dashboard;


use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $credentials = $user->only('email', 'password');

        return redirect()->route('login.index');
    }

    function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'approve' => 'Wrong password / email or this account not approved yet.',
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }


    function show(){
        return User::where('role', 1)->first();
    }

}
