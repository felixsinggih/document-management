@extends('layout.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <p class="ms-3 mt-3">
            <a href="/admin/company/add" class="btn btn-primary waves-effect waves-light">
                <span class="ti-xs ti ti-plus me-1"></span> Tambah</a>
        </p>

        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Nama Perusahaan</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->company_code }}</td>
                            <td>{{ $item->company_name }}</td>
                            <td>
                                {{-- User --}}
                                <a href="/admin/company/{{ $item->id }}/user"
                                    class="btn btn-sm btn-primary waves-effect waves-light">
                                    <span class="ti-xs ti ti-user"></span></a>

                                {{-- Company --}}
                                <a href="/admin/company/{{ $item->id }}/edit"
                                    class="btn btn-sm btn-success waves-effect waves-light">
                                    <span class="ti-xs ti ti-pencil"></span></a>
                                <form action="/admin/company/{{ $item->id }}" method="post" class="d-inline">
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
            {{ $data->links() }}
        </div>
    </div>
@endsection
