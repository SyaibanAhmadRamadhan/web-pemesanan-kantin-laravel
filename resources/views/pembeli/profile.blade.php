@extends('layout.main-pembeli')

@section('container')
    <section id="container">
        <!-- Navbar -->
        @include('partials.navbar-pembeli')
        <!-- Navbar Akhir -->

        <!-- auth -->
        <section id="auth">
            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-lg-9 py-5" style="background-color: #f4f4f4">
                        <div class="row">
                            <div class="col text-center">
                                <img class="rounded-circle" src="./assets/img/profile.svg" alt="" />
                                <p>{{ Auth()->user()->username }}</p>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5">
                            <div class="col-lg-10">
                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert" id="allert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success" role="alert" id="allert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <form>
                                    <div class="row mb-3">
                                        <div class="col-3 my-auto">
                                            <p class="my-auto">Username</p>
                                        </div>
                                        <div class="col-1 my-auto">
                                            <p class="my-auto">:</p>
                                        </div>
                                        <div class="col">
                                            <input type="text" disabled name="username"
                                                value="{{ Auth()->user()->username }}" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3 my-auto">
                                            <p class="my-auto">Nama</p>
                                        </div>
                                        <div class="col-1 my-auto">
                                            <p class="my-auto">:</p>
                                        </div>
                                        <div class="col">
                                            <input type="text" disabled name="name"
                                                @if ($profile == null) @else
                                value="{{ $profile->name }}" @endif
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3 my-auto">
                                            <p class="my-auto">E-mail</p>
                                        </div>
                                        <div class="col-1 my-auto">
                                            <p class="my-auto">:</p>
                                        </div>
                                        <div class="col">
                                            <input type="email" disabled name="email"
                                                value="{{ Auth()->user()->email }}" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3 my-auto">
                                            <p class="my-auto">No. Telepon</p>
                                        </div>
                                        <div class="col-1 my-auto">
                                            <p class="my-auto">:</p>
                                        </div>
                                        <div class="col">
                                            <input type="number" disabled name="mobile_phone"
                                                @if ($profile == null) @else
                                value="{{ $profile->mobile_phone }}" @endif
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3 my-auto">
                                            <p class="my-auto">Jenis Kelamin</p>
                                        </div>
                                        <div class="col-1 my-auto">
                                            <p class="my-auto">:</p>
                                        </div>
                                        <div class="col">
                                            <input type="text" disabled name="jenis_kelamin"
                                                @if ($profile == null) @else
                                value="{{ $profile->jenis_kelamin }}" @endif
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-3 my-auto">
                                            <p class="my-auto">Tanggal Lahir</p>
                                        </div>
                                        <div class="col-1 my-auto">
                                            <p class="my-auto">:</p>
                                        </div>
                                        <div class="col">
                                            <input type="text" disabled name="tanggal_lahir"
                                                @if ($profile == null) @else
                                            value="{{ $profile->tanggal_lahir }}" @endif
                                                class="form-control" />
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 d-md-block text-center">
                                        <button type="button" class="btn btn-auth px-5 py-2 mx-2" data-bs-toggle="modal"
                                            data-bs-target="#editProfile">Edit</button>
                                        {{-- <button class="btn btn-auth px-5 py-2 mx-2" type="button">Simpan</button> --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- auth Akhir -->
    </section>
    <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{ route('profile.edit.proccess') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="username" class="col-form-label">Username:</label>
                            <input type="text" name="username"
                                @error('username')
                                    value="{{ old('username') }}"
                                @else
                                    value="{{ Auth()->user()->username }}"
                                @enderror
                                class="form-control" id="username">
                            @error('username')
                                <div class="error" style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name:</label>
                            <input type="text" name="name" class="form-control"
                                @if ($profile == null) @else
                                value="{{ $profile->name }}" @endif
                                id="name">
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="email" name="email" class="form-control"
                                @error('email')
                                    value="{{ old('email') }}"
                                @else
                                    value="{{ Auth()->user()->email }}"
                                @enderror
                                class="form-control" id="email">
                            @error('email')
                                <div class="error" style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="mobile_phone" class="col-form-label">No. Telepon:</label>
                            <input type="text" name="mobile_phone" class="form-control"
                                @if ($profile == null) @else
                                @error('mobile_phone')
                                    value="{{ old('mobile_phone') }}"
                                @else
                                    value="{{ $profile->mobile_phone }}"
                                @enderror @endif
                                @error('mobile_phone')
                                    value="{{ old('mobile_phone') }}"
                                @enderror
                                id="mobile_phone">
                            @error('mobile_phone')
                                <div class="error" style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Jenis Kelamin:</label>
                            <div class="form-check">
                                <input class="form-check-input" name="jenis_kelamin" type="radio" value="pria"
                                    @if ($profile == null) @else
                                @if ($profile->jenis_kelamin == 'pria') checked @endif
                                    @endif
                                id="pria" >
                                <label class="form-check-label" for="pria">
                                    pria
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="jenis_kelamin" type="radio" value="wanita"
                                    id="wanita"
                                    @if ($profile == null) @else
                                @if ($profile->jenis_kelamin == 'wanita') checked @endif
                                    @endif>
                                <label class="form-check-label" for="wanita">
                                    wanita
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir" class="col-form-label">Tanggal Lahir:</label>
                            <input type="date" class="form-control" name="tanggal_lahir"
                                @if ($profile == null) @else
                                value="{{ $profile->tanggal_lahir }}" @endif
                                id="tanggal_lahir">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $("#editProfile").modal('show');
            });
        </script>
    @endif
@endsection
