@extends('layouts.admin')

@section('content')
<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top" data-aos="fade-down">
        <div class="container-fluid">
            <button class="btn btn-secondary d-md-none mr-auto mr-2" id="menu-toggle">
                &laquo; Menu
            </button>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Desktop Menu -->
                <ul class="navbar-nav d-none d-lg-flex ml-auto">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                            <img src="{{asset("storage/user_images/".Auth::user()->images)}}" alt=""
                                class="rounded-circle mr-2 profile-picture" />
                            Hi, {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            <a href="/home" class="dropdown-item">Back To Home</a>
                            <a href="/users/{{Auth::user()->id}}/edit" class="dropdown-item">Settings</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{route("logout")}}" class="dropdown-item">Logout</a>
                        </div>
                    </li>
                </ul>

                <ul class="navbar-nav d-block d-lg-none">
                    <li class="nav-item">
                        <a href="#" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                            <img src="{{asset("storage/user_images/".Auth::user()->images)}}" alt=""
                                class="rounded-circle mr-2 profile-picture" />
                            Hi, {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            <a href="/home" class="dropdown-item">Back To Home</a>
                            <a href="/users/{{Auth::user()->id}}/edit" class="dropdown-item">Settings</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{route("logout")}}" class="dropdown-item">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container">
            <h1>Tambahkan Desa</h1>
            <a href="/admin-desas" class="btn btn-info btn-edit text-light">Back</a>
            <form action="{{ route('admin-desas.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="content">
                    <div class="kiri">
                        <label for="file-input"><input type="file" class="form-control 
                        @error('images')
                            is-invalid
                        @enderror" id="input-file" name="images[]" accept="image/*" onchange="previewImage()"
                                multiple><i class="fa-solid fa-upload"></i> &nbsp; Pilih Gambar</label>
                        <p id="num-of-files">Tidak Terdapat Gambar Terpilih</p>
                        <div id="images"></div>
                    </div>
                    <div class="kanan">
                        <div class="desa">
                            <label for="desa">Nama Desa</label>
                            <input type="text" name="desa" id="desa" class="form-control @error('desa')
                        is-invalid
                    @enderror" placeholder="Masukkan Nama Desa" value="{{ old('desa') }}">
                            @error('desa')
                            <div class="invalid-feedback ml-4">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="kecamatan">
                            <label for="kecamatan">Nama Kecamatan</label>
                            <select class="form-control @error('kecamatan')
                        is-invalid
                    @enderror" name="kecamatan" id="kecamatan">
                                @if(count($kecamatans)>0)
                                @foreach ($kecamatans as $kecamatan)
                                <option value='{{$kecamatan->kecamatan}}'
                                    {{($kecamatan->kecamatan ===  old('kecamatan')) ? 'selected' : ''}}>
                                    {{$kecamatan->kecamatan}}</option>
                                @endforeach
                                @else
                                <option value='Tidak ada kecamatan!!!' disabled>Tidak ada data kecamatan!!!</option>
                                @endif
                            </select>
                            @error('kecamatan')
                            <div class="invalid-feedback ml-4">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="kabupaten">
                            <label for="kabupaten">Nama Kabupaten</label>
                            <input type="text" name="kabupaten" id="kabupaten" class="form-control @error('kabupaten')
                        is-invalid
                    @enderror" placeholder="Masukkan Nama Kabupaten" value="{{ old('kabupaten') }}">
                            @error('kabupaten')
                            <div class="invalid-feedback ml-4">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="provinsi">
                            <label for="provinsi">Nama Provinsi</label>
                            <input type="text" name="provinsi" id="provinsi" class="form-control @error('provinsi')
                        is-invalid
                    @enderror" placeholder="Masukkan Nama Provinsi" value="{{ old('provinsi') }}">
                            @error('provinsi')
                            <div class="invalid-feedback ml-4">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="desc">
                            <label for="description">Deskripsi Singkat</label>
                            <textarea class="form-control @error('description')
                        is-invalid
                    @enderror" placeholder="Masukkan Deskripsi Desa" name="description" id="description"
                                rows="5">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback ml-4">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="buttonProd">Simpan Desa</button>
            </form>
        </div>
    </div>
</div>
<script>
    let fileInput = document.getElementById("input-file");
    let imageContainer = document.getElementById("images")
    let numOfFiles = document.getElementById("num-of-files");

    function previewImage() {
        imageContainer.innerHTML = "";
        numOfFiles.textContent = '';

        for (i of fileInput.files) {
            let reader = new FileReader();
            let figure = document.createElement("figure");
            let figCap = document.createElement("figcaption");
            figCap.innerText = '';
            figure.appendChild(figCap);
            reader.onload = () => {
                let img = document.createElement("img");
                img.setAttribute("src", reader.result);
                figure.insertBefore(img, figCap);
            }
            imageContainer.appendChild(figure);
            reader.readAsDataURL(i);
        }
    }

</script>
@endsection
