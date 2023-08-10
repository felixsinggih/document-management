@extends('layout.main')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <p class="ms-3 mt-3">
            <a href="/admin/company/{{ $company->id }}/user/add" class="btn btn-primary waves-effect waves-light">
                <span class="ti-xs ti ti-user-plus me-1"></span> Tambah</a>
        </p>

        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($user as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ ucfirst($item->role) }}</td>
                            <td>
                                {{-- Modal --}}
                                <button type="button" class="btn btn-sm btn-info waves-effect waves-light"
                                    data-bs-toggle="modal" data-bs-target="#adminModal{{ $item->id }}">
                                    <span class="ti-xs ti ti-eye"></span>
                                </button>

                                {{-- Non Modal --}}
                                <a href="/admin/company/user/{{ $item->id }}/edit"
                                    class="btn btn-sm btn-success waves-effect waves-light">
                                    <span class="ti-xs ti ti-pencil"></span></a>
                                <form action="/admin/company/user/{{ $item->id }}/delete" method="post"
                                    class="d-inline">
                                    @csrf
                                    @method('delete')

                                    <button class="btn btn-sm btn-danger waves-effect waves-light"
                                        onclick="return confirm('Apakah anda yakin akan menghapus data tersebut?)">
                                        <span class="ti-xs ti ti-trash"></span></button>
                                </form>
                            </td>
                        </tr>

                        {{-- Modal --}}
                        <div class="modal fade" id="adminModal{{ $item->id }}" tabindex="-1" style="display: none;"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-unstyled mb-0 mt-3">
                                            <li class="d-flex align-items-center mb-3">
                                                <span class="fw-bold mx-2">Nama :</span>
                                                <span>{{ $item->name }}</span>
                                            </li>
                                            <li class="d-flex align-items-center mb-3">
                                                <span class="fw-bold mx-2">Username :</span>
                                                <span>{{ $item->username }}</span>
                                            </li>
                                            <li class="d-flex align-items-center mb-3">
                                                <span class="fw-bold mx-2">Email :</span>
                                                <span>{{ $item->email }}</span>
                                            </li>
                                            <li class="d-flex align-items-center mb-3">
                                                <span class="fw-bold mx-2">Role :</span>
                                                <span>{{ ucfirst($item->role) }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="/admin/company/user/{{ $item->id }}/edit"
                                            class="btn btn-success waves-effect waves-light">
                                            <span class="ti-xs ti ti-pencil"></span> Edit</a>
                                        <form action="/admin/company/user/{{ $item->id }}/delete" method="post"
                                            class="d-inline ms-0">
                                            @csrf
                                            @method('delete')

                                            <button class="btn btn-danger waves-effect waves-light"
                                                onclick="return confirm('Apakah anda yakin akan menghapus data tersebut?)">
                                                <span class="ti-xs ti ti-trash"></span> Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6">Data belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer pb-0">
            {{ $user->links() }}
        </div>
    </div>
@endsection
