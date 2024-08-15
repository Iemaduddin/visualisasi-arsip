<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
// use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'nik' => 'required|max:255|min:2|unique:employees,nik',
            'nama' => 'required|max:255|min:2',
            'username' => 'required|max:255|min:2',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255',
        ]);
        $employee = new Employee;
        $employee->nik = $request->nik;
        $employee->nama = $request->nama;
        $employee->username = $request->username;
        $employee->email = $request->email;
        $employee->password = Hash::make($request->password);
        $employee->save();

        $user = new User;
        $user->employees_id = $employee->id;
        $user->username = $employee->username;
        $user->email = $employee->email;
        $user->password = $request->password;
        $user->save();
        auth()->login($user);
        toast('Registrasi berhasil. Anda sekarang login.', 'success');
        return redirect()->route('dashboard_employee');
    }
}
