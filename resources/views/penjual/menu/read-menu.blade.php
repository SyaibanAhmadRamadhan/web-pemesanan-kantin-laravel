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
                                                <th style="text-align: center">Nama Menu</th>
                                                <th style="text-align: center">Harga Menu</th>
                                                <th style="text-align: center">Stock Menu</th>
                                                <th style="text-align: center">picture</th>
                                                <th style="text-align: center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($menu as $key => $x)
                                                <tr>
                                                    <td style="text-align: center">{{ $x->name_menu }}</td>
                                                    <td style="text-align: center">@rupiah($x->price)</td>
                                                    <td style="text-align: center">{{ $x->stock }}</td>
                                                    <td class="w-25" style="text-align: center">
                                                        <img src="{{ asset('menu/' . $x->picture) }}"
                                                            style="max-width: 100px; max-height: 100px; object-fit: contain"
                                                            class="img-fluid img-thumbnail" alt="Sheep">
                                                    </td>
                                                    <td style="text-align: center">
                                                        <a href="{{ route('menu.edit.view', ['id' => $x->id]) }}"
                                                            class="btn btn-sm btn-primary">Edit</a>&emsp;
                                                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                                                            data-target="#hapusModal{{ $x->id }}">Hapus</a>
                                                        <div class="modal fade" id="hapusModal{{ $x->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Apakah Anda Yakin Ingin Menghapus Menu
                                                                            '<strong>{{ $x->name_menu }}</strong>' ini?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-outline-primary"
                                                                            data-dismiss="modal">Cancel</button>
                                                                        <form
                                                                            action="{{ route('menu.delete.process', ['id' => $x->id]) }}"
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
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" style="text-align: center">tidak terdapat menu.
                                                        apakah anda ingin menambahkan menu?<a
                                                            href="{{ route('menu.add.view') }}">yes</a></td>
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
