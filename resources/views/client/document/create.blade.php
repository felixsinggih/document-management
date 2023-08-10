@extends('layout.main')

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <form action="/client/document/store" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Dokumen</label>
                    <div class="col-sm-10">
                        <input class="form-control @error('document_name') is-invalid @enderror" type="file"
                            name="document_name">
                        @error('document_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Masa Berlaku</label>
                    <div class="col-sm-10">
                        <input type="text"
                            class="form-control dob-picker flatpickr-input active @error('due_date') is-invalid @enderror"
                            placeholder="YYYY-MM-DD" name="due_date" value="{{ old('due_date') }}" readonly="readonly">
                        @error('due_date')
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
