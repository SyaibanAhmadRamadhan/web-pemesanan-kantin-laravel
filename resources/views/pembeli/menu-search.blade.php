@extends('layout.main-pembeli')
@section('container')
    <section id="container">
        <!-- Navbar -->
        @include('partials.navbar-pembeli')
        <!-- Navbar Akhir -->

        <!-- Search Bar -->
        <section id="search">
            <div class="container py-3">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <form action="{{ route('search.view') }}">
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
        <!-- Search Bar Akhir -->
        <!-- Menu -->
        @if (Auth()->user())
            <section id="menu">
                <div class="container-fluid px-5">
                    @if (count($penjual) == 0)
                        <p style="text-align: center">menu tidak tersedia</p>
                    @else
                        @foreach ($penjual as $key => $p)
                            <div class="row">
                                @if (count($p->getMenuSearch($search, $p->id_penjual)) > 0)
                                    <div class="col-lg-12 px-3 py-2 bg-abu">
                                        <h3 class="my-0">{{ $p->nama_warung }}</h3>
                                    </div>
                                @endif
                                @foreach ($p->getMenuSearch($search, $p->id_penjual) as $x)
                                    <div class="col-lg-3 py-4">
                                        <div class="card border-0 rounded-4">
                                            <img src="{{ asset('menu/' . $x->picture) }}"
                                                class="card-img-top rounded-4 menu-img-display" alt="..." />
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $x->name_menu }}</h5>
                                                <a href="#" class="stretched-link" data-bs-toggle="modal"
                                                    data-bs-target="#modalmesan{{ $x->id }}"></a>
                                                <input type="hidden" value="{{ $x->id }}"
                                                    id="menu_id{{ $x->id }}">
                                                <p class="card-text text-danger">@rupiah($x->price)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modalmesan{{ $x->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="card border-0 rounded-4">
                                                        <img src="{{ asset('menu/' . $x->picture) }}"
                                                            class="card-img-top rounded-4 menu-img-modal" alt="..." />
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $x->name_menu }}</h5>
                                                            <p class="card-text text-danger">Rp. {{ $x->price }}
                                                            </p>
                                                            <div class="row mb-3">
                                                                <div class="col-3 my-auto">
                                                                    <p class="my-auto">Qty</p>
                                                                </div>
                                                                <div class="col-1 my-auto">
                                                                    <p class="my-auto">:</p>
                                                                </div>
                                                                <div class="col">
                                                                    @if (session('pemesanan'))
                                                                        <input type="number" min="1" name="qty"
                                                                            id="qty{{ $x->id }}"
                                                                            @foreach (session('pemesanan') as $key => $s) @if (substr($key, 3) == $x->id) value="{{ $s }}" @break @endif @endforeach
                                                                            class="form-control" />
                                                                    @else
                                                                        <input type="number" min="1" name="qty"
                                                                            id="qty{{ $x->id }}" value="1"
                                                                            class="form-control" />
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="button" class="btn btn-primary"
                                                        id="button_menu{{ $x->id }}"
                                                        data-bs-dismiss="modal">Pesan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if (count($p->getMenuSearch($search, $p->id_penjual)) == 0)
                                        <p style="text-align: center">menu tidak tersedia</p>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    @endif
                </div>
            </section>
            <section id="pesanan"
                class="@if (count($penjual) == 0 || count($penjual) == 1) fixed-bottom @else sticky-bottom @endif bg-white overflow-hidden">
                <div class="container-fluid px-0">
                    <form action="{{ route('pemesanan.process') }}" method="POST">
                        @csrf
                        <div class="row justify-content-between my-auto">
                            <div class="col my-auto d-flex">
                                <input type="text" class="text-danger pe-2 pb-0 fw-bold border-0 w-25 h4 text-end"
                                    id="inc" value="0">
                                <h4>Pesanan</h4></input>
                            </div>
                            <div class="col text-end">
                                <button type="submit" id="button_pesan_sekarang"
                                    class="btn btn-danger rounded-0 py-3">Pesan
                                    Sekarang</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        @else
            <!-- Menu -->
            <section id="menu">
                <div class="container-fluid px-5">
                    @if (count($penjual) == 0)
                        <p style="text-align: center">menu tidak tersedia</p>
                    @else
                        @foreach ($penjual as $key => $p)
                            <div class="row">
                                @if (count($p->getMenuSearch($search, $p->id_penjual)) > 0)
                                    <div class="col-lg-12 px-3 py-2 bg-abu">
                                        <h3 class="my-0">{{ $p->nama_warung }}</h3>
                                    </div>
                                @endif
                                @foreach ($p->getMenuSearch($search, $p->id_penjual) as $x)
                                    <div class="col-lg-3 py-4">
                                        <div class="card border-0 rounded-4">
                                            <img src="{{ asset('menu/' . $x->picture) }}"
                                                class="card-img-top rounded-4 menu-img-display" alt="..." />
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $x->name_menu }}</h5>
                                                <a href="{{ route('login.view') }}" class="stretched-link"></a>
                                                <p class="card-text text-danger">@rupiah($x->price)</p>
                                            </div>
                                        </div>
                                    </div>
                                    @if (count($p->getMenuSearch($search, $p->id_penjual)) == 0)
                                        <p style="text-align: center">menu tidak tersedia</p>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    @endif
                </div>
            </section>
        @endif
        <!-- Menu Akhir -->
    </section>

    <!-- Modal -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        @if (Session::get('pemesanan'))
            let sum = 0;
            @foreach (session('pemesanan') as $x)
                sum += parseInt("{{ $x }}");
            @endforeach
            document.getElementById("inc").value = sum;
        @endif
        @foreach ($menu as $x)
            $("#button_menu{{ $x->id }}").click(function() {
                let qty = 'qty{{ $x->id }}';
                let valQty = $("#qty{{ $x->id }}").val();
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('pemesanan.session') }}",
                    data: {
                        qty: qty,
                        valQty: valQty,
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error) && $.isEmptyObject(data.error500)) {
                            Swal.fire({
                                icon: "success",
                                text: "Pesanan Berhasil Dimasukan",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            let sum = 0;
                            for (var name in data.data) {
                                let intege = parseInt(data.data[name]);
                                sum += intege;
                            }
                            document.getElementById("inc").value = sum;
                        } else {
                            if (data.error500) {
                                if (alert('maaf terjadi kesalah pada server')) {} else window
                                    .location.reload();
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    text: data.error,
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                                printErrorMsg(data.error);
                            }
                        }
                    }
                })
            })
        @endforeach
    </script>
@endsection
