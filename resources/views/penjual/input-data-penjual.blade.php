@extends('layout.main-pembeli')
@section('container')
    <section id="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid px-5">
                <img src="{{ asset('assets/img/logo1.png') }}" height="30" alt="" />
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item my-2 mx-3">
                            <a class="nav-link active"> Input Data Penjual </a>
                        </li>
                        <li class="nav-item my-2 mx-3">
                            <a href="{{ route('logout') }}" class="nav-link active"> logout </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <section id="auth">
            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-lg-9 py-5" style="background-color: #f4f4f4">
                        <div class="row">
                            <div class="col text-center">
                                <h2>Input Data Penjual</h2>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5">
                            <div class="col-lg-10">
                                <form action="{{ route('input.data.penjual.process') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nama_warung" class="form-label">Nama Warung</label>
                                        <input type="text" id="nama_warung" name="nama_warung"
                                            value="{{ old('nama_warung') }}" class="form-control" />
                                        @error('nama_warung')
                                            <span class="text-danger error-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="lokasi" class="form-label">Lokasi</label>
                                        <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}"
                                            class="form-control" />
                                        @error('lokasi')
                                            <span class="text-danger error-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="nomer_telepon" class="form-label">No. Hp</label>
                                        <input type="text" id="nomer_telepon" name="nomer_telepon"
                                            value="{{ old('nomer_telepon') }}" class="form-control" />
                                        @error('nomer_telepon')
                                            <span class="text-danger error-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-auth px-5 py-2 mx-2" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
