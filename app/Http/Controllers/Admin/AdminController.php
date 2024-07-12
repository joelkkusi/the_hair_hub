<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Import the User model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import the Hash class
use Illuminate\Validation\Rules; // Import the Rules namespace

class AdminController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        // Validate the request... 
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|min:10|max:10|regex:/^([0-9\s\-\+\(\)]*)$/|unique:users',
            'usertype' => 'required|in:Admin,Employee,Customer',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'usertype' => $request->usertype,
            'password' => Hash::make($request->password),
        ]);

        $user->save();

        return redirect()->route('admin.show')->with('success', 'User created successfully!');
    }

    public function show(Request $request)
    {
        $users = User::all();
        $filter = $request->query('filter');

        if ($filter) {
            $users = User::where('usertype', $filter)->get();
        } else {
            $users = User::whereIn('usertype', ['Admin', 'Employee', 'Customer'])->get();
        }

        return view('admin.show', compact('users'));
    }

    public function edit($id)
    {
        $users = User::findOrFail($id);

        return view('admin.edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|min:10|max:10|regex:/^([0-9\s\-\+\(\)]*)$/|unique:users,phone,' . $id,
            'usertype' => 'required|in:Admin,Employee,Customer',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'usertype' => $request->usertype,
        ]);

        $user->save();

        return redirect()->route('admin.show')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.show')->with('success', 'User deleted successfully!');
    }
}
