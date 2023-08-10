<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Document;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $company = Company::find(auth()->user()->company_id);
        $data = [
            'title'     => 'Document | ' . $company->company_name,
            'company'   => $company,
            'documents' => Document::where('company_id', $company->id)->paginate(5)
        ];
        return view('client.document.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $company = Company::find(auth()->user()->company_id);
        $data = [
            'title'     => 'Tambah Document | ' . $company->company_name,
            'company'   => $company
        ];
        return view('client.document.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validData = $request->validate([
            'document_name' => 'file|mimes:pdf|max:1024',
            'due_date' => 'required'
        ]);

        $company = Company::find(auth()->user()->company_id);
        $validData['company_id'] = $company->id;

        if ($request->file('document_name')) {
            $doc = $request->file('document_name');
            $extension = $doc->getClientOriginalExtension();
            $location = 'public/doc/' . Str::replace(' ', '_', $company->company_name);
            $fileName = $company->company_code . '_' . date("Ymdhis") . '.' . $extension;
            $validData['document_name'] = $doc->storeAs($location, $fileName);
        }

        Document::create($validData);
        return redirect('/client/document')->with('success', 'Data dokumen berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document): View
    {
        $company = Company::find(auth()->user()->company_id);
        $data = [
            'title'     => 'Lihat Dokumen | ' . $company->company_name,
            'company'   => $company,
            'document'  => $document
        ];
        return view('client.document.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document): View
    {
        $company = Company::find(auth()->user()->company_id);
        $data = [
            'title'     => 'Lihat Dokumen | ' . $company->company_name,
            'company'   => $company,
            'document'  => $document
        ];
        return view('client.document.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document): RedirectResponse
    {
        $rules = [
            'document_name' => 'file|mimes:pdf|max:1024',
            'due_date' => 'required'
        ];

        $company = Company::find(auth()->user()->company_id);
        $validData = $request->validate($rules);

        if ($request->file('document_name')) {
            if ($document->document_name) {
                Storage::delete($document->document_name);
            }

            $doc = $request->file('document_name');
            $extension = $doc->getClientOriginalExtension();
            $location = 'public/doc/' . Str::replace(' ', '_', $company->company_name);
            $fileName = $company->company_code . '_' . date("Ymdhis") . '.' . $extension;
            $validData['document_name'] = $doc->storeAs($location, $fileName);
        }

        Document::where('id', $document->id)->update($validData);
        return redirect('/client/document')->with('success', 'Data dokumen berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document): RedirectResponse
    {
        if ($document->document_name) {
            Storage::delete($document->document_name);
        }

        $document->delete();
        return redirect('/client/document')->with('success', 'Data dokumen berhasil dihapus!');
    }
}
