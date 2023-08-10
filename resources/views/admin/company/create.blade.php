@extends('layout.main')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <form action="/admin/company/store" method="POST">
                @csrf

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Kode Perusahaan</label>
                    <div class="col-sm-10">
                        <input type="text" name="company_code"
                            class="form-control @error('company_code') is-invalid @enderror"
                            value="{{ old('company_code') }}" placeholder="Kode Perusahaan" autofocus>
                        @error('company_code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Nama Perusahaan</label>
                    <div class="col-sm-10">
                        <input type="text" name="company_name"
                            class="form-control @error('company_name') is-invalid @enderror"
                            value="{{ old('company_name') }}" placeholder="Nama Perusahaan">
                        @error('company_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
