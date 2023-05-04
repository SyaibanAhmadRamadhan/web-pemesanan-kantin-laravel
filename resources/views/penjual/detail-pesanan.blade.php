@extends('layout.main-pembeli')

@section('container')
    <section id="container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid px-5">
                <img src="{{ asset('assets/img/logo1.png') }}" height="30" alt="" />
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item my-2 mx-3 dropdown">
                            <a class="nav-link active" href="{{ route('penjual.pesanan.view') }}"> Back </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Navbar Akhir -->
        <section id="dpesanan">
            <div class="container-fluid p-5">
                <div class="row">
                    <div class="col-lg px-0">
                        <h3>Detail Pesanan</h3>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-lg-7 mx-auto">
                        <div class="row my-3 px-3 py-4 bg-white">
                            <div class="col-lg">
                                <h5 class="small">Nomor Antrian</h5>
                                <h5 class="text-danger">{{ $pesanan[0]->nomer_antrian }}</h5>
                            </div>
                        </div>
                        <div class="row my-3 px-3 py-4 bg-white">
                            <div class="col-lg">
                                <p class="text-secondary">Pemesanan</p>
                                <p class="my-0">{{ $pesanan[0]->getUser->username }}</p>
                                <p>{{ Auth()->user()->mobile_phone }}</p>
                                <div class="d-flex">
                                    <p class="fw-light small text-secondary w-100">Waktu Pemesanan</p>
                                    <p class="fw-light small text-secondary text-end w-100">{{ $pesanan[0]->created_at }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row my-3 px-3 py-4 bg-white">
                            @php
                                $subTotal = 0;
                            @endphp
                            @foreach ($menu as $key => $p)
                                <div class="col-lg">
                                    @foreach ($p->getMenu($p->id_penjual) as $x)
                                        @foreach ($pesanan as $key => $z)
                                            @if ($z->id_menu == $x->id)
                                                <div class="d-flex border-2 py-4">
                                                    <img src="{{ asset('menu/' . $x->picture) }}" width="110"
                                                        alt="" />
                                                    <div class="mt-auto ps-3">
                                                        <p class="mt-0">{{ $x->name_menu }}</p>
                                                        <p class="mt-0">@rupiah($x->price)</p>
                                                        <p class="text-danger mb-0">{{ $z->jumlah_pesanan }}x</p>
                                                    </div>
                                                </div>
                                                <div class="text-end w-100 mt-auto mb-0">
                                                    <p> @rupiah($z->total_harga) </p>
                                                </div>
                                                <div class="border-bottom "></div>
                                                @php
                                                    $subTotal += $z->total_harga;
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg mx-auto dtotal">
                        <div class="my-3 px-3 py-4 bg-white">
                            <div class="d-flex border-bottom border-2 py-4">
                                <h5 class="mb-0 w-100 fw-bold">Total Pesanan</h5>
                                <h5 class="text-end w-100 mb-0 text-danger">@rupiah($subTotal)</h5>
                            </div>
                            <div class="d-flex border-bottom border-2 py-4">
                                <h5 class="mb-0 w-100 fw-bold">Metode Pembayaran</h5>
                                <h5 class="text-end w-100 mb-0">Kasir</h5>
                            </div>
                        </div>
                        <div class="my-3 px-3 py-4 bg-white">
                            <div class="border-bottom border-2 py-4">
                                <h5 class="w-100 fw-bold text-secondary small">Status Pesanan</h5>
                                <h5 class="w-100 mb-0">
                                    @if ($pesanan[0]->status_pesanan == null)
                                        belum melakukan bayar
                                    @else
                                        {{ $pesanan[0]->status_pesanan }}
                                    @endif
                                </h5>
                            </div>
                            <div class="d-flex border-2 py-4">
                                @if ($pesanan[0]->status_pesanan == 'dibatalkan')
                                    <h5 class="mb-0 w-100 fw-bold text-danger">dibatalkan</h5>
                                @else
                                    <h5
                                        class="mb-0 w-100 fw-bold @if ($pesanan[0]->status_pembayaran == 'belum bayar') text-danger
                                        @else
                                        text-success @endif"">
                                        {{ $pesanan[0]->status_pembayaran }}</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection
