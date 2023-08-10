<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Users;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class CompanyAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Company $company): View
    {
        $data = [
            'title'     => 'Admin | ' . $company->company_name,
            'company'   => $company,
            'user'      => Users::where('company_id', $company->id)->paginate(5)
        ];
        return view('admin.company.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Company $company): View
    {
        $data = [
            'title'     => 'Tambah Admin | ' . $company->company_name,
            'company'   => $company
        ];
        return view('admin.company.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Company $company): RedirectResponse
    {
        $validData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:6|max:16'
        ]);

        $validData['company_id'] = $company->id;
        $validData['role'] = 'client';
        $validData['is_active'] = 'yes';
        $validData['password'] = Hash::make($validData['password']);

        Users::create($validData);
        return redirect('/admin/company/' . $company->id . '/user')->with('success', 'Data admin berhasil ditambahkan!');
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
            'user'  => $user
        ];
        return view('admin.company.user.edit', $data);
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
        return redirect('/admin/company/' . $user->company_id . '/user')->with('success', 'Data admin berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Users $user): RedirectResponse
    {
        $user->delete();
        return redirect('/admin/company/' . $user->company_id . '/user')->with('success', 'Data admin berhasil dihapus!');
    }
}
