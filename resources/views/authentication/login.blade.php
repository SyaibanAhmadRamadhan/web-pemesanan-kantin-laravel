@extends('layout.main-pembeli')
@section('container')
    <section id="container">
        @include('partials.navbar-pembeli')
        <!-- auth -->
        <section id="auth">
            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-lg-9 py-5" style="background-color: #f4f4f4">
                        <div class="row">
                            <div class="col text-center">
                                <h2>Login</h2>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5">
                            <div class="col-lg-10">
                                @if (session('errors_login'))
                                    <div class="alert alert-danger" role="alert" id="allert">
                                        {{ session('errors_login') }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}<br>
                                        @endforeach
                                    </div>
                                @endif
                                <form action="{{ route('login.process') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" name="username" id="username" value="{{ old('username') }}"
                                            class="form-control" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" id="password" value="{{ old('password') }}"
                                            class="form-control" />
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-auth px-5 py-2 mx-2" type="submit">Login</button><br><br>
                                        <p>Belum Mempunyai Akun?<a href="{{ route('register.view') }}">register</a></p>
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
@endsection
