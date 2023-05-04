@extends('layout.main-pembeli')

@section('container')
    <section id="container">
        <!-- Navbar -->
        @include('partials.navbar-pembeli')

        <section id="dpenjual">
            <div class="container-fluid p-5">
                <div class="row">
                    <div class="col-lg px-0">
                        <h3>List Pesanan</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 py-3 text-white" style="background-color: #4abdac">
                        <h5 class="mb-0">Pesanan Anda</h5>
                    </div>
                    <div class="col-lg-12 bg-white pt-3">
                        @php
                            $nomer_pesanan_var = 0;
                        @endphp
                        @forelse ($pesanan as $key => $value)
                            @if ($nomer_pesanan_var == $value->nomer_pesanan)
                                @continue
                            @endif
                            <div class="d-flex border-bottom border-2 py-4">
                                <div class="w-100">
                                    <h5 class="small text-danger">Nomor Antrian {{ $value->nomer_antrian }}</h5>
                                    <h5 class="small">Tanggal Pesanan {{ $value->created_at }}</h5>
                                    @foreach ($nomerPesanan as $key => $y)
                                        @if ($y->nomer_pesanan == $value->nomer_pesanan)
                                            @foreach ($value->getNomerPesanan($value->nomer_pesanan) as $key => $as)
                                                <h5 class="mb-0">{{ $as->name_menu }}</h5>
                                            @endforeach
                                        @endif
                                    @endforeach
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
                                        href="{{ route('nota.pesanan.view', ['id' => $value->nomer_pesanan]) }}">detail
                                        pesanan</a>
                                </h5><br>
                            </div>
                            @php
                                $nomer_pesanan_var = $value->nomer_pesanan;
                            @endphp
                        @empty
                            <p>tidak ada riwayat pesanan</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection
