<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        $users = User::where('role', 'kasir')->get();
        return view('karyawan.index', compact('users'));
    }

    public function create()
    {
        return view('karyawan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'kasir',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('karyawan.index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('karyawan.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('karyawan.index');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('karyawan.index');
    }
}
