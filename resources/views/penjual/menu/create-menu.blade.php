@extends('layout.main-penjual')

@section('container')
    <div id="wrapper">
        @include('partials.penjual-sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('partials.penjual-navbar')
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tambah Menu</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.view') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Menu</li>
                        </ol>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{ route('menu.add.process') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="name_menu" class="col-sm-3 col-form-label">Nama Menu</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name_menu" name="name_menu"
                                            placeholder="Ex : soto daging" value="{{ old('name_menu') }}">
                                        @error('name_menu')
                                            <span style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="price" class="col-sm-3 col-form-label">Harga Menu</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="price" id="price" value="{{ old('price') }}">
                                        <input type="text" class="form-control" value="{{ old('price') }}"
                                            name="priceShow" id="priceShow" placeholder="Ex : 200000">
                                        @error('price')
                                            <span style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="stock" class="col-sm-3 col-form-label">Stock Menu</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="stock" name="stock"
                                            placeholder="Ex : 10" value="{{ old('stock') }}">
                                        @error('stock')
                                            <span style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="picture" class="col-sm-3 col-form-label">Gambar Menu</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <img class="img-show mb-3 img-fluid rounded d-block" style="height: 200px"
                                            id="foto" alt=""><br><br>
                                        <input type="file" name="picture" class="form-control-file" id="picture"
                                            onchange="previewImage()" value="{{ old('picture') }}">
                                        <input type="hidden" name="action" id="action"">
                                        <span id="lblError" style="color: red;"></span>
                                        @error('picture')
                                            <span style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button id="btnSubmit" type="submit" class="btn-info btn">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function previewImage() {
            const imageShow = document.querySelector('.img-show');
            const image = document.querySelector('#picture');
            imageShow.src = ''
            if (image.value) {
                let action = document.querySelector('#action')
                action.value = "false"
                console.log(action.value)
                imageShow.style.display = 'block';
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);
                oFReader.onload = function(oFREvent) {
                    if (image.value) {
                        imageShow.src = oFREvent.target.result;
                    }
                }
            }

        }
    </script>

    <script>
        $("body").on("click", "#btnSubmit", function() {
            var allowedFiles = [".png", ".jpg", ".jpeg"];
            var fileUpload = $("#picture");
            var lblError = $("#lblError");
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
            let file = document.getElementById("picture").files[0];
            if (file == undefined) {
                let action = document.querySelector('#action')
                action.value = "true"
            } else {
                let action = document.querySelector('#action')
                action.value = "false"
            }
            if (file.size > 2097152) {
                lblError.html("file terlalu besar, max file 2mb");
                return false;
            }
            if (fileUpload.val().toLowerCase()) {
                if (!regex.test(fileUpload.val().toLowerCase())) {
                    lblError.html("Gunakan Extension: <b>" + allowedFiles.join(' ') + "</b> only.");
                    return false;
                }
                lblError.html('');
                return true;
            }
        });
    </script>

    {{-- input rupiah --}}
    <script type="text/javascript">
        var rupiah = document.getElementById('priceShow');
        rupiah.value = formatRupiah(rupiah.value, 'Rp. ');
        rupiah.addEventListener('keyup', function(e) {
            $("#price").val(formatRupiahEsc(this.value))
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, 'Rp. ');
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        function formatRupiahEsc(angka) {
            let al = "";
            if (angka == "" || angka == null || angka == "null" || angka == undefined) {
                al = "";
            } else {
                al = Math.abs(angka.replace(/[^,\d]/g, '').toString());
            }
            return al;
        }
    </script>
@endsection
