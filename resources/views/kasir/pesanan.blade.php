@extends('layout.main-pembeli')

@section('container')
    <section id="container">
        @include('partials.kasir-navbar')
        <section id="search">
            <div class="container py-3">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <form action="{{ route('kasir.search.view') }}">
                            <div class="input-group rounded-pill bg-white shadow-primary">
                                <input id="search_menu" name="search" class="form-control border-0 rounded-pill ps-4"
                                    type="search" @if (isset($_GET['search'])) value="{{ $_GET['search'] }}" @endif
                                    placeholder="Search" aria-label="Search" />
                                <button class="btn" id="basic-addon2"><i class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section id="dpenjual">
            <div class="container-fluid p-5">
                <div class="row">
                    <div class="col-lg-12 py-3 text-white" style="background-color: #4abdac">
                        <h5 class="mb-0">Pesanan</h5>
                    </div>
                    <div class="col-lg-12 bg-white pt-3">
                        @php
                            $nomer_pesanan_var = 0;
                            $nomer = 1;
                            $status = false;
                        @endphp
                        @foreach ($pesanan as $key => $value)
                            @if ($nomer_pesanan_var == $value->nomer_pesanan)
                                @continue
                            @endif
                            <div class="d-flex border-bottom border-2 py-4">
                                <div class="w-100">
                                    <h5 class="small text-danger">Nomor Antrian {{ $value->nomer_antrian }}</h5>
                                    <h5 class="small">Tanggal Pesanan {{ $value->created_at }}</h5>
                                    <h5 class="mb-0">{{ $value->getUser->username }}</h5>
                                </div>
                                <h5
                                    class="text-end w-100 mb-0 mt-auto @if ($value->status_pembayaran == 'belum bayar' || $value->status_pesanan == 'dibatalkan') text-danger
                                    @else
                                    text-success @endif">
                                    @if ($value->status_pesanan == 'dibatalkan')
                                        dibatalkan
                                    @elseif($value->status_pesanan == 'pesanan selesai')
                                        {{ $value->status_pembayaran }} | pesanan selesai
                                    @else
                                        {{ $value->status_pembayaran }}
                                    @endif <a
                                        href="{{ route('kasir.detial.pesanan.view', ['id' => $value->nomer_pesanan]) }}">detail
                                        pesanan</a>
                                </h5><br>
                            </div>
                            @php
                                $nomer_pesanan_var = $value->nomer_pesanan;
                            @endphp
                        @endforeach
                        @if (count($pesanan) == 0)
                            <p>tidak ada pesanan</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection
