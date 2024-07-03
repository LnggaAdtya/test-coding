<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() {
        return view('login');
    }

    public function users() {
        $users = User::orderBy('created_at', 'DESC')->get();
        return view('profile', compact('users'));
    }

    public function auth (Request $request) {
        $request-> validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);
        $user = $request->only('email', 'password');
        if (Auth::attempt($user)) {
            return  redirect()->route('landing');
        } else {
            return redirect()->back()->withErrors('error', 'Gagal Login!');
        }
        
    }

   public function landing() {
        return view('landing');
    }

    public function editUser($id)
    {
        $dataUser = User::where('id', '=', $id)->first();
        return view('editUser', compact('dataUser'));
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'lastName' => 'required',
            'email' => 'required|email:dns',
            'birthDate' => 'required',
            'gender' => 'required',
            'password' => ' ',
        ]);

        User::where('id', '=', $id)->update([
            'name' => $request->name,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'birthDate' => $request->birthDate,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users')->with('success', 'Akun berhasil diupdate!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}



