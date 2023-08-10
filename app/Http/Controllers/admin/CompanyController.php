<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $data = [
            'title' => 'Daftar Perusahaan',
            'data'  => Company::paginate(5)
        ];
        return view('admin.company.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $data = [
            'title' => 'Tambah Perusahaan'
        ];
        return view('admin.company.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validData = $request->validate([
            'company_code' => 'required|max:255|unique:companies',
            'company_name' => 'required|max:255'
        ]);

        Company::create($validData);
        return redirect('/admin/company')->with('success', 'Data perusahaan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company): View
    {
        $data = [
            'title' => 'Edit Perusahaan',
            'company'  => $company
        ];
        return view('admin.company.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company): RedirectResponse
    {
        $rules = [
            'company_code' => 'required|max:255',
            'company_name' => 'required|max:255'
        ];

        if ($request->company_code != $company->company_code) {
            $rules['company_code'] = 'required|max:255|unique:companies';
        }

        $validData = $request->validate($rules);

        Company::where('id', $company->id)->update($validData);
        return redirect('/admin/company')->with('success', 'Data perusahaan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company): RedirectResponse
    {
        $company->delete();
        return redirect('/admin/company')->with('success', 'Data perusahaan berhasil dihapus!');
    }
}
