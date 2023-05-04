@extends('layout.main-penjual')

@section('container')
    <div id="wrapper">
        @include('partials.penjual-sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('partials.penjual-navbar')
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Menu</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.view') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Menu</li>
                        </ol>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{ route('menu.edit.process', ['id' => $menu->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="name_menu" class="col-sm-3 col-form-label">Nama Menu</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control"
                                            @error('name_menu') value="{{ old('name_menu') }}" @else value="{{ $menu->name_menu }}" @enderror
                                            id="name_menu" name="name_menu" placeholder="Ex : soto daging">
                                        @error('name_menu')
                                            <span style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="priceShow" class="col-sm-3 col-form-label">Harga Menu</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="price" id="price"
                                            @if ($errors->any()) value="{{ old('price') }}" @else value="{{ $menu->price }}" @endif>
                                        <input type="text" class="form-control"
                                            @if ($errors->any()) value="{{ old('price') }}" @else value="@rupiah($menu->price)" @endif
                                            name="priceShow" id="priceShow" placeholder="Ex : 200000">
                                        @error('price')
                                            <span style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="stock" class="col-sm-3 col-form-label">Stock Menu</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control"
                                            @error('stock') value="{{ old('stock') }}" @else value="{{ $menu->stock }}" @enderror
                                            id="stock" name="stock" placeholder="Ex : 10">
                                        @error('stock')
                                            <span style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="oldPic" value="profile.svg">
                                    <label for="picture" class="col-sm-3 col-form-label">Gambar Menu</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <img src="{{ asset('menu/' . $menu->picture) }}"
                                            class="img-show mb-3 img-fluid rounded d-block" style="height: 200px"
                                            id="foto" alt=""><br><br>
                                        <input type="file" name="picture" class="form-control-file" id="picture"
                                            onchange="previewImage()">
                                        <input type="hidden" value="{{ $menu->picture }}" name="oldPic">
                                        <span id="lblError" style="color: red;"></span>
                                        @error('picture')
                                            <span style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row" id="divHapusFoto" style="display: none">
                                    <label for="picture" class="col-sm-3 col-form-label"></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <label class="css-control css-control-primary css-checkbox" for="hapusPic">
                                            <a style="cursor: pointer; color: blue" id="hapusPic" name="hapusPic"
                                                onclick="hapusImage()">click jika ingin menghapus foto
                                            </a>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button id="btnSubmit" type="submit" class="btn-info btn">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- image --}}
    <script>
        function previewImage() {
            $("#divHapusFoto").css('display', '');
            const image = document.querySelector('#picture');
            const imageShow = document.querySelector('.img-show');
            const oldPic = document.querySelector('[name="oldPic"]').value;
            if (image.value) {
                document.getElementById('picture').disabled = false;
                imageShow.style.display = 'block';
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);
                oFReader.onload = function(oFREvent) {
                    if (image.value) {
                        imageShow.src = oFREvent.target.result;
                    }
                }
            } else if (!image.value) {
                $("#divHapusFoto").css('display', 'none');
                imageShow.src = "{{ asset('menu/' . $menu->picture) }}";
                image.value = '';
            }
        }

        function hapusImage() {
            $("#divHapusFoto").css('display', 'none');
            const imageShow = document.querySelector('.img-show');
            const image = document.querySelector('#picture');
            image.value = '';
            imageShow.src = "{{ asset('menu/' . $menu->picture) }}";
        }
    </script>
    <script>
        $("body").on("click", "#btnSubmit", function() {
            const image = document.querySelector('#picture');
            if (image.value) {
                var allowedFiles = [".png", ".jpg", ".jpeg"];
                var fileUpload = $("#picture");
                var lblError = $("#lblError");
                var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
                let file = document.getElementById("picture").files[0];
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
