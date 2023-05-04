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
                                <h2>Sign Up</h2>
                            </div>
                        </div>
                        <div class="row justify-content-center pt-5">
                            <div class="col-lg-10">
                                <div class="alert alert-success" role="alert" id="success" style="display: none"></div>
                                <form action="{{ route('register.process') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" id="username" name="username" class="form-control" />
                                        <span class="text-danger error-text username_err"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" id="email" name="email" class="form-control" />
                                        <span class="text-danger error-text email_err"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" />
                                        <span class="text-danger error-text password_err"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                                        <input type="password" id="confirm_password" name="confirm_password"
                                            class="form-control" />
                                        <span class="text-danger error-text password_confirmation_err"></span>
                                    </div>
                                    <div id="button" class="d-grid gap-2 d-md-block pt-3 text-center">
                                        <p id="text_daftar">Daftar Sebagai :</p>
                                        <button class="btn btn-auth1 px-5 py-2 mx-4" id="button_penjual"
                                            type="button">Penjual</button>
                                        <button class="btn btn-auth1 px-5 py-2 mx-4" id="button_pembeli"
                                            type="button">Pembeli</button><br><br>
                                        <p>anda ingin melakukan login?<a href="{{ route('login.view') }}">Login</a></p>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#button_penjual").click(function() {
            let username = $("#username").val();
            let email = $("#email").val();
            let password = $("#password").val();
            let confirm_password = $("#confirm_password").val();
            let role = 'penjual';
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('register.process') }}",
                data: {
                    username: username,
                    email: email,
                    password: password,
                    password_confirmation: confirm_password,
                    role: role
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error) && $.isEmptyObject(data.error500)) {
                        $('.username_err').text('');
                        $('.email_err').text('');
                        $('.password_err').text('');
                        $('.password_confirmation_err').text('');
                        $("#success").css('display', 'block');
                        $("#success").append(
                            `<div>pendaftaran berhasil <a href="{{ route('login.view') }}">klik disini untuk login</a></div>`
                        );
                        $("#button").remove();
                    } else {
                        if (data.error500) {
                            if (alert('maaf terjadi kesalah pada server')) {} else window
                                .location.reload();
                        } else {
                            printErrorMsg(data.error);
                        }
                    }
                }
            })
        })
        $("#button_pembeli").click(function() {
            let username = $("#username").val();
            let email = $("#email").val();
            let password = $("#password").val();
            let confirm_password = $("#confirm_password").val();
            let role = 'pembeli';
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('register.process') }}",
                data: {
                    username: username,
                    email: email,
                    password: password,
                    password_confirmation: confirm_password,
                    role: role
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error) && $.isEmptyObject(data.error500)) {
                        $('.username_err').text('');
                        $('.email_err').text('');
                        $('.password_err').text('');
                        $('.password_confirmation_err').text('');
                        $("#success").css('display', 'block');
                        $("#success").append(
                            `<div>pendaftaran berhasil <a href="{{ route('login.view') }}">klik disni untuk login</a></div>`
                        );
                        $("#button").remove();
                    } else {
                        if (data.error500) {
                            if (alert('maaf terjadi kesalah pada server')) {} else window
                                .location.reload();
                        } else {
                            printErrorMsg(data.error);
                        }
                    }
                }
            })
        })

        function printErrorMsg(msg) {
            $.each(msg, function(key, value) {
                if (!msg.username) {
                    $('.username_err').text('');
                }
                if (!msg.email) {
                    $('.email_err').text('');
                }
                if (!msg.password) {
                    $('.password_err').text('');
                    $('.password_confirmation_err').text('');
                }
                $('.' + key + '_err').text(value);
                if (msg.password) {
                    if (msg.password.length > 1) {
                        $('.password_confirmation_err').text(msg.password[1]);
                        $('.password_err').text(msg.password[0]);
                    }
                }
            });
        }
    })
</script>
