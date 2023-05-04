@extends('layout.main-penjual')

@section('container')
    <div id="wrapper">
        <!-- Sidebar -->
        @include('partials.penjual-sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('partials.penjual-navbar')
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Data Menu</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.view') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Menu</li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th style="text-align: center">Nomer Antrian</th>
                                                <th style="text-align: center">Nama Pemesan</th>
                                                <th style="text-align: center">Waktu Pemesanan</th>
                                                <th style="text-align: center">status</th>
                                                <th style="text-align: center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $nomer_pesanan_var = 0;
                                            @endphp
                                            @forelse ($pesanan as $key => $x)
                                                @if ($nomer_pesanan_var == $x->nomer_pesanan)
                                                    @continue
                                                @endif
                                                <tr>
                                                    <td style="text-align: center">{{ $x->nomer_antrian }}</td>
                                                    <td style="text-align: center">{{ $x->getUser->username }}</td>
                                                    <td style="text-align: center">{{ $x->created_at }}</td>
                                                    <td style="text-align: center">{{ $x->status_pesanan }}</td>
                                                    <td style="text-align: center">
                                                        <a href="{{ route('penjual.detail.pesanan.view', ['id' => $x->nomer_pesanan]) }}"
                                                            class="btn btn-sm btn-info">Detail</a>&emsp;
                                                        @if ($x->status_pesanan == 'pesanan disiapkan')
                                                            <a href="#" class="btn btn-sm btn-primary"
                                                                data-toggle="modal"
                                                                data-target="#konfirmasiPesanan{{ $x->id }}">Pesanan
                                                                Telah
                                                                Siap</a>
                                                        @endif
                                                        <div class="modal fade" id="konfirmasiPesanan{{ $x->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Click Konfirmasi Jika Pesanan Ini Sudah Siap</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-outline-primary"
                                                                            data-dismiss="modal">Cancel</button>
                                                                        <form
                                                                            action="{{ route('penjual.konfirmasi.pesanan.view') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <input type="hidden" name="nomer_pesanan"
                                                                                value="{{ $x->nomer_pesanan }}">
                                                                            <input type="hidden" name="id_menu"
                                                                                value="{{ $x->id_menu }}">
                                                                            <button type="submit"
                                                                                class="btn btn-info">Konfirmasi</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @php
                                                    $nomer_pesanan_var = $x->nomer_pesanan;
                                                @endphp
                                            @empty
                                                <tr>
                                                    <td colspan="4" style="text-align: center">tidak terdapat pesanan
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
@endsection
