@extends('layout.main-pembeli')

@section('container')
    <section id="container">
        <!-- Navbar -->
        @include('partials.navbar-pembeli')
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
                                <p class="my-0">{{ Auth()->user()->username }}</p>
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
                                <div class="col-lg-12">
                                    <br>
                                    <h5>
                                        {{ $p->nama_warung }}
                                    </h5>
                                </div>
                                <div class="col-lg">
                                    @foreach ($p->getMenu($p->id_penjual) as $x)
                                        @foreach ($pesanan as $key => $z)
                                            @if ($z->id_menu == $x->id)
                                                <div class="d-flex border-2 py-4">
                                                    <img src="{{ asset('menu/' . $x->picture) }}" width="110"
                                                        alt="" />
                                                    <div class="mt-auto ps-3">
                                                        <p class="mt-0">{{ $x->name_menu }}</p>
                                                        <p class="mb-0">@rupiah($x->price)</p>
                                                        <p class="text-danger mb-0">{{ $z->jumlah_pesanan }}x</p>
                                                    </div>
                                                </div>
                                                <div class="text-end w-100 mt-auto mb-0">
                                                    <p> @rupiah($z->total_harga) </p>
                                                    <p class="text-end w-100 mt-auto mb-0 text-info">
                                                        {{ $z->status_pesanan }}
                                                    </p><br>
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
                                    @php
                                        $status = false;
                                    @endphp
                                    @if ($pesanan[0]->status_pesanan == null)
                                        @php
                                            $status = true;
                                        @endphp
                                        silahkan lakukan pembayaran terlebih dahulu dikasir<br><br>
                                        <h6>
                                            <div style="color: red">pemesanan anda akan dibatalkan secara otomatis jika
                                                sudah
                                                melebihi batas hari ini</div>
                                        </h6>
                                    @else
                                        @foreach ($pesanan as $key => $x)
                                            @if ($x->status_pesanan == 'pesanan disiapkan')
                                                pesanan disiapkan
                                                @php
                                                    $status = true;
                                                @endphp
                                            @break
                                        @endif
                                    @endforeach
                                    @if ($status == false)
                                        {{ $pesanan[0]->status_pesanan }}
                                    @endif
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

                    @php
                        $statusKonfimarsi = true;
                    @endphp
                    @foreach ($pesanan as $key => $y)
                        @if ($y->status_pesanan != 'pesanan telah siap')
                            @php
                                $statusKonfimarsi = false;
                                break;
                            @endphp
                        @elseif($y->status_pesanan == 'pesanan telah siap')
                            @php
                                $statusKonfimarsi = true;
                            @endphp
                        @elseif($y->status_pesanan == 'pesanan selesai')
                            @php
                                $statusKonfimarsi = false;
                            @endphp
                        @endif
                    @endforeach
                    @if ($statusKonfimarsi == true)
                        <form action="{{ route('pembeli.konfirmasi.pesanan.view') }}" method="post">
                            @csrf
                            @method('put')
                            <div class="text-center pt-4">
                                <input type="hidden" value="{{ $pesanan[0]->nomer_pesanan }}" name="nomer_pesanan">
                                <button type="submit" class="btn btn-danger rounded-pill px-4 py-3">
                                    <h5 class="mb-0">Konfirmasi Pesanan Diterima</h5>
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection
