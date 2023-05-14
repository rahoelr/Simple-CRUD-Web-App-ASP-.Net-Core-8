@extends('layouts.crud')

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
            <h1>Edit Mitra</h1>
            @if (Auth::user()->level == 'admin')
            <a href="/db_admin-mitra-detail/{{$mitras->id}}"><img class="mr-4 img-back-form"
                    src="{{asset('img/back.png')}}" alt=""></a>
            @else
            <a href="/db_mitra-toko/{{Auth::user()->id}}"><img class="mr-4 img-back-form"
                    src="{{asset('img/back.png')}}" alt=""></a>
            @endif
            <form action="{{ route('admin-mitras.update', $mitras->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                {{ csrf_field() }}
                <div class="content">
                    <div class="kiri">
                        <label for="file-input"><input type="file" class="form-control 
                        @error('images')
                            is-invalid
                        @enderror" id="input-file" name="images" accept="image/*" onchange="previewImage()"><i
                                class="fa-solid fa-upload"></i> &nbsp; Choose A Pictures</label>
                        <p id="num-of-files">No File Chosen</p>
                        <div id="images"></div>
                    </div>
                    <div class="kanan">
                        <div class="name">
                            <label for="mitra_name">Nama Toko</label>
                            <input type="text" name="mitra_name" id="mitra_name" class="form-control @error('mitra_name')
                        is-invalid
                    @enderror" value="{{ $mitras->mitra_name }}">
                            @error('mitra_name')
                            <div class="invalid-feedback ml-4">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="Owner">
                            <label for="owner">Pemilik Toko</label>
                            <input type="text" name="owner" id="owner" class="form-control @error('owner')
                        is-invalid
                    @enderror" value="{{ $mitras->owner }}">
                            @error('owner')
                            <div class="invalid-feedback ml-4">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="type-of-business">
                            <label for="t_o_business">Jenis Usaha</label>
                            <select class="form-control @error('t_o_business')
                        is-invalid
                    @enderror" name="t_o_business" id="t_o_business">
                                @if(count($usahas)>0)
                                @foreach ($usahas as $usaha)
                                <option value='{{$usaha->jenisUsaha}}'
                                    {{($mitras->t_o_business === $usaha->jenisUsaha) ? 'selected' : ''}}>
                                    {{$usaha->jenisUsaha}}</option>
                                @endforeach
                                @else
                                <option value='Tidak ada data jenis usaha!!' disabled>Tidak ada data jenis usaha!!!
                                </option>
                                @endif
                            </select>
                            @error('t_o_business')
                            <div class="invalid-feedback ml-4">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="desa">
                            <label for="desa">Alamat Desa</label>
                            <select class="form-control @error('desa')
                        is-invalid
                    @enderror" name="desa" id="desa">
                                @if(count($desas)>0)
                                @foreach ($desas as $desa)
                                <option value='{{$desa->desa}}' {{($mitras->desa === $desa->desa) ? 'selected' : ''}}>
                                    {{$desa->desa}}</option>
                                @endforeach
                                @else
                                <option value='Tidak ada data desa!!' disabled>Tidak ada data desa!!!
                                </option>
                                @endif
                            </select>
                            @error('desa')
                            <div class="invalid-feedback ml-4">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="kecamatan">
                            <label for="kecamatan">Alamat Kecamatan</label>
                            <select class="form-control @error('kecamatan')
                        is-invalid
                    @enderror" name="kecamatan" id="kecamatan">
                                @if(count($kecamatans)>0)
                                @foreach ($kecamatans as $kecamatan)
                                <option value='{{$kecamatan->kecamatan}}'
                                    {{($mitras->kecamatan === $kecamatan->kecamatan) ? 'selected' : ''}}>
                                    {{$kecamatan->kecamatan}}</option>
                                @endforeach
                                @else
                                <option value='Tidak ada data kecamatan!!' disabled>Tidak ada data kecamatan!!!
                                </option>
                                @endif
                            </select>
                            @error('kecamatan')
                            <div class="invalid-feedback ml-4">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="buttonProd">Simpan Mitra</button>
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
