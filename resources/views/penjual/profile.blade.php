@extends('layout.main-penjual')

@section('container')
    <div id="wrapper">
        @include('partials.penjual-sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('partials.penjual-navbar')
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Menu</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.view') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Menu</li>
                        </ol>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{ route('profile.penjual.edit.process') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 col-form-label">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control"
                                            @error('username') value="{{ old('username') }}" @else value="{{ $dataUser->username }}" @enderror
                                            id="username" name="username" placeholder="Ex : soto daging">
                                        @error('username')
                                            <span style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">email</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control"
                                            @error('email') value="{{ old('email') }}" @else value="{{ $dataUser->email }}" @enderror
                                            id="email" name="email" placeholder="Ex : soto daging">
                                        @error('email')
                                            <span style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_warung" class="col-sm-3 col-form-label">Nama Warung</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control"
                                            @error('nama_warung') value="{{ old('nama_warung') }}" @else value="{{ $dataPenjual->nama_warung }}" @enderror
                                            id="nama_warung" name="nama_warung" placeholder="Ex : soto daging">
                                        @error('nama_warung')
                                            <span style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lokasi" class="col-sm-3 col-form-label">Lokasi</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control"
                                            @error('lokasi') value="{{ old('lokasi') }}" @else value="{{ $dataPenjual->lokasi }}" @enderror
                                            id="lokasi" name="lokasi" placeholder="Ex : lantai3">
                                        @error('lokasi')
                                            <span style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nomer_telepon" class="col-sm-3 col-form-label">Nomer Telepon</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control"
                                            @error('nomer_telepon') value="{{ old('nomer_telepon') }}" @else value="{{ $dataPenjual->nomer_telepon }}" @enderror
                                            id="nomer_telepon" name="nomer_telepon" placeholder="Ex : lantai3">
                                        @error('nomer_telepon')
                                            <span style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button id="btnSubmit" type="submit" class="btn-info btn">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
