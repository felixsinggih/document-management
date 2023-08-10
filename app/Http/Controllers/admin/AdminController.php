<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data = [
            'title' => 'Admin List',
            'data'  => Users::where('role', 'admin')->paginate(5)
        ];
        return view('admin.admin.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $data = [
            'title' => 'Tambah Admin'
        ];
        return view('admin.admin.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:6|max:16'
        ]);

        $validData['role'] = 'admin';
        $validData['is_active'] = 'yes';
        $validData['password'] = Hash::make($validData['password']);

        Users::create($validData);
        return redirect('/admin/admin')->with('success', 'Data admin berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Users $user): View
    {
        $data = [
            'title' => 'Edit Admin',
            'admin'  => $user
        ];
        return view('admin.admin.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Users $user): RedirectResponse
    {
        $rules = [
            'name' => 'required|max:255',
        ];

        if ($request->username != $user->username) {
            $rules['username'] = 'required|unique:users';
        }

        if ($request->email != $user->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }

        $validData = $request->validate($rules);

        Users::where('id', $user->id)->update($validData);
        return redirect('/admin/admin')->with('success', 'Data admin berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Users $user): RedirectResponse
    {
        $user->delete();
        return redirect('/admin/admin')->with('success', 'Data admin berhasil dihapus!');
    }
}
