@extends('layout.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <p class="ms-3 mt-3">
            <a href="/client/document/add" class="btn btn-primary waves-effect waves-light">
                <span class="ti-xs ti ti-plus me-1"></span> Tambah</a>
        </p>

        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Masa Berlaku</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($documents as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td>{{ date('d M Y', strtotime($item->due_date)) }}</td>
                            <td>
                                <a href="/client/document/{{ $item->id }}"
                                    class="btn btn-sm btn-info waves-effect waves-light">
                                    <span class="ti-xs ti ti-eye"></span></a>
                                <a href="/client/document/{{ $item->id }}/edit"
                                    class="btn btn-sm btn-success waves-effect waves-light">
                                    <span class="ti-xs ti ti-pencil"></span></a>
                                <form action="/client/document/{{ $item->id }}/delete" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')

                                    <button class="btn btn-sm btn-danger waves-effect waves-light"
                                        onclick="return confirm('Apakah anda yakin akan menghapus data tersebut?)">
                                        <span class="ti-xs ti ti-trash"></span></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Data belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer pb-0">
            {{ $documents->links() }}
        </div>
    </div>
@endsection
