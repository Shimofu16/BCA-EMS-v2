@extends('BCA.Backend.admin-layouts.index')
@section('page-title')
    Import Backups
@endsection
@section('contents')
    <div class="row shadow-sm bg-white rounded align-items-center mb-3">
        <div class="col">
            <h1 class="h3 text-gray-800 m-0 py-3">@yield('page-title')</h1>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end">
                <a class="btn btn-outline-primary" href="{{ route('admin.manage.backups.show', ['date' => now()]) }}">
                    <span class="d-flex align-items-center"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> &#160;
                        Back</span>
                </a>
            </div>
        </div>
    </div>

    <div class="row shadow-sm bg-white rounded p-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <form action="{{ route('admin.manage.backups.import.backup', ['type' => 'Students']) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex align-items-center">
                                <div
                                    class="form-group
                                    @error('backup') is-invalid @enderror">
                                    <h5 span class="text-dark text-black font-weight-bold">Students:</h5>
                                    <input type="file" name="backup" class="form-control">
                                    @error('backup')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="button">
                                    <button type="submit" class="btn btn-outline-success ml-1 mt-3">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                        Import
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <form action="{{ route('admin.manage.backups.import.backup', ['type' => 'Enrollments']) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex align-items-center">
                                <div
                                    class="form-group
                                    @error('backup') is-invalid @enderror">
                                    <h5 span class="text-dark text-black font-weight-bold">Enrollments:</h5>
                                    <input type="file" name="backup" class="form-control">
                                    @error('backup')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="button">
                                    <button type="submit" class="btn btn-outline-success ml-1 mt-3">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                        Import
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-- success --}}
                    @if (session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif
                    {{-- error from session --}}
                    @if (session('error'))
                        <div class="alert alert-danger mt-3">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
