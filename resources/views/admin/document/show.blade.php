@extends('layout.main')

@section('content')
    <div class="card overflow-hidden">
        <div class="card-body">
            <a class="btn btn-label-primary mb-4 waves-effect" href="/admin/document">
                <i class="ti ti-chevron-left scaleX-n1-rtl me-1 me-1"></i>
                <span class="align-middle">Kembali</span></a>
            {{-- <a href="/client/document/{{ $document->id }}/edit" class="btn btn-success mb-4 waves-effect">
                <i class="ti ti-pencil scaleX-n1-rtl me-1 me-1"></i>
                <span class="align-middle">Edit</span></a> --}}
            {{-- <form action="/client/document/{{ $document->id }}/delete" method="post" class="d-inline">
                @csrf
                @method('delete')

                <button class="btn btn-danger mb-4 waves-effect"
                    onclick="return confirm('Apakah anda yakin akan menghapus data tersebut?)">
                    <i class="ti ti-trash scaleX-n1-rtl me-1 me-1"></i>
                    <span class="align-middle">Hapus</span></button>
            </form> --}}
            <h4 class="d-flex align-items-center mt-2 mb-4">
                Detail Dokumen
            </h4>

            <div class="mb-4">
                <h6 class="mb-1">Kode / Nama Perusahaan :</h6>
                <p class="mb-1">{{ $document->company->company_code }} / {{ $document->company->company_name }}</p>
            </div>
            <div class="mb-4">
                <h6 class="mb-1">Tanggal Pengajuan :</h6>
                <p class="mb-1">{{ $document->created_at->format('d M Y') }}</p>
            </div>
            <div class="mb-4">
                <h6 class="mb-1">Masa Berlaku :</h6>
                <p class="mb-1">{{ date('d M Y', strtotime($document->due_date)) }}</p>
            </div>
            <div class="mb-4">
                <h6 class="mb-1">Dokumen :</h6>
                <iframe src="{{ asset('storage/' . str_replace('public/', '', $document->document_name)) }}" width="100%"
                    height="700">
                    This browser does not support PDFs. Please download the PDF to view it: <a
                        href="{{ asset('storage/' . str_replace('public/', '', $document->document_name)) }}">Download
                        PDF</a>
                </iframe>
            </div>
        </div>
    </div>
@endsection
