@extends('layout.main-pembeli')

@section('container')
    <section id="container">
        <!-- Navbar -->
        @include('partials.navbar-pembeli')
        <!-- Navbar Akhir -->
        @if ($urlStatus == true)
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
                                    <p class="text-secondary">Pemesanan</p>
                                    <p class="my-0">{{ Auth()->user()->username }}</p>
                                    <p class="my-0">
                                        @if ($pembeli)
                                            {{ $pembeli->mobile_phone }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="row my-3 px-3 py-4 bg-white">
                                @php
                                    $subTotal = 0;
                                @endphp
                                @foreach ($pesanan as $key => $p)
                                    <div class="col-lg-12">
                                        <br>
                                        <h5>
                                            {{ $p->nama_warung }}
                                        </h5>
                                    </div>
                                    <div class="col-lg">
                                        @foreach ($p->getMenu($p->id_penjual) as $x)
                                            @foreach ($sessionPemesanan as $key => $z)
                                                @if (substr($key, 3) == $x->id)
                                                    <div class="d-flex border-2 py-4">
                                                        <div>
                                                            <img src="{{ asset('menu/' . $x->picture) }}" alt="" />
                                                        </div>
                                                        <div class="mt-auto ps-3">
                                                            <p class="mt-0">{{ $x->name_menu }}</p>
                                                            <div class="row mb-3">
                                                                <div class="col-3 my-auto">
                                                                    <p class="my-auto">Qty</p>
                                                                </div>
                                                                <div class="col-1 my-auto">
                                                                    <p class="my-auto">:</p>
                                                                </div>
                                                                <div class="col">
                                                                    <input type="number" id="qty{{ $x->id }}"
                                                                        min="1" value="{{ $z }}"
                                                                        max="{{ $x->stock }}" name="qty"
                                                                        value="1" class="form-control" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-end w-100 mt-auto mb-0">
                                                        <p id="totalMenu{{ $x->id }}">
                                                            @php
                                                                $total = $x->price * $z;
                                                            @endphp
                                                            @rupiah($total)
                                                        </p>
                                                        <a href="#" class="btn btn-sm btn-danger"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#hapusModal{{ $x->id }}">Hapus</a>
                                                        <div class="modal fade" id="hapusModal{{ $x->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <p>Anda Ingin Menghapus Menu
                                                                            '{{ $x->name_menu }}'?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-outline-primary"
                                                                            data-bs-dismiss="modal">Cancel</button>
                                                                        <form
                                                                            action="{{ route('pemesanan.delete.process', ['id' => $x->id]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Hapus</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br>
                                                    <div class="border-bottom"></div>
                                                @endif
                                            @endforeach

                                            @foreach ($sessionPemesanan as $key => $z)
                                                @if (substr($key, 3) == $x->id)
                                                    @php
                                                        $total = $x->price * $z;
                                                        $subTotal += $x->price * $z;
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
                                    <h5 id="subTotal" class="text-end w-100 mb-0 text-danger">@rupiah($subTotal)</h5>
                                </div>
                                <div class="d-flex border-bottom border-2 py-4">
                                    <h5 class="mb-0 w-100 fw-bold">Metode Pembayaran</h5>
                                    <h5 class="text-end w-100 mb-0">Kasir</h5>
                                </div>
                            </div>
                            <div class="text-center pt-4">
                                <form action="{{ route('pemesanan.process.detail') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger rounded-pill px-4 py-3">
                                        <h5 class="mb-0">Pesan Sekarang</h5>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @else
            <script>
                if (alert(
                        'Beberapa informasi produk pada pesananmu telah diperbarui. Mohon kembali ke halaman keranjang dan coba lagi'
                    )) {} else {
                    window.location.href = "{{ route('menu.view') }}"
                }
            </script>
        @endif

    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @if ($urlStatus == true)
        <script>
            @foreach (session('pemesanan') as $key => $x)
                $("#qty{{ substr($key, 3) }}").on("change", function() {
                    let qty = 'qty{{ substr($key, 3) }}';
                    let valQty = $("#qty{{ substr($key, 3) }}").val();
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('pemesanan.update.session') }}",
                        data: {
                            qty: qty,
                            valQty: valQty,
                        },
                        success: function(data) {
                            if ($.isEmptyObject(data.error) && $.isEmptyObject(data.error500) && $
                                .isEmptyObject(data.errorRefresh)) {
                                const rupiah = (number) => {
                                    return new Intl.NumberFormat("id-ID", {
                                        style: "currency",
                                        currency: "IDR",
                                        minimumFractionDigits: 0,
                                    }).format(number);
                                }
                                $("#totalMenu{{ substr($key, 3) }}").text(rupiah(data.total));
                                $("#subTotal").text(rupiah(data.subTotal));
                            } else {
                                if (data.error500) {
                                    if (alert('maaf terjadi kesalah pada server')) {} else window
                                        .location.reload();
                                } else if (data.errorRefresh) {
                                    if (alert('pemesanan tidak boleh melebihi stock')) {} else window
                                        .location.reload();
                                } else {
                                    if (alert('maaf pesanan anda harus lebih dari 0')) {} else window
                                        .location.reload();
                                }
                            }
                        }
                    })
                })
            @endforeach
        </script>
    @endif
@endsection
