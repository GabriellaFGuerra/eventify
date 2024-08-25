<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function create()
    {
        return route('signup');
    }

    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'confirmPassword' => 'required|same:password',
            'type' => 'required|in:admin,user',
            'address' => 'required|string',
            'phone' => 'required|string',
            'birthday' => 'required|date'
        ]);
        if (!$validate) {
            return Redirect::back()->withErrors($request->errors())->withInput($request->all());
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->user_type = $request->input('type');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->birthday = $request->input('birthday');

        if (!$user->save()) {
            return Redirect::back()->withErrors($request->errors())->withInput($request->all());
        } else {
            return redirect('login');
        }
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request->input('email'))->first();
            Auth::login($user);
            $request->session()->regenerate();

            if (Auth::user()->user_type == 'admin') {
                return redirect()->intended('dashboard');
            } else {
                return redirect()->intended('/');
            }
        }

        return back()->withInput($request->all())->withErrors([
            'email' => 'Invalid Email',
            'password' => 'Wrong Password'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerate();
        return redirect('login');
    }
}
