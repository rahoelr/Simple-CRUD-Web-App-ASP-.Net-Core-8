@extends('layouts.admin')

@section('content')
<!-- Page Content -->
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
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Tentang Kami</h2>
                <p class="dashboard-subtitle">Kelola halaman tentang kami</p>
                @if (\Session::has('success'))
                <div class="alert alert-success">
                    {!! \Session::get('success') !!}
                </div>
                @endif
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin-about_us.update', $about_us->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    {{ csrf_field() }}
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <div class="form-group text-center">
                                                <label class="label-edit" for="file-input"><input type="file" class="form-control 
                                                        @error('images')
                                                            is-invalid
                                                        @enderror" id="input-file" name="images" accept="image/*"
                                                        onchange="previewImage()"><i class="fa-solid fa-upload"></i>
                                                    &nbsp; Choose A Logo</label>
                                                <p class="text-center" id="num-of-files">No File Chosen</p>
                                                <div id="images">
                                                    <figure><img
                                                            src="{{asset("storage/aboutUs_images/".$about_us->images)}}"
                                                            alt=""></figure>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="history">Sejarah Singkat</label>
                                                <textarea class="form-control @error('history')
                                                        is-invalid
                                                    @enderror" placeholder="Masukkan Sejarah Singkat Organisasi"
                                                    name="history" id="history"
                                                    rows="5">{{ $about_us->history }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="logo_meaning">Makna Logo</label>
                                                <textarea class="form-control @error('logo_meaning')
                                                is-invalid
                                                @enderror" placeholder="Masukkan Makna Logo Organisasi"
                                                    name="logo_meaning" id="logo_meaning"
                                                    rows="5">{{ $about_us->logo_meaning }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="visi">Visi</label>
                                                <textarea class="form-control @error('visi')
                                                is-invalid
                                                @enderror" placeholder="Masukkan Visi Organisasi" name="visi" id="visi"
                                                    rows="5">{{ $about_us->visi }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="mission">Misi</label>
                                                <textarea class="form-control @error('misi')
                                                is-invalid
                                                @enderror" placeholder="Masukkan Misi Organisasi" name="misi" id="misi"
                                                    rows="5">{{ $about_us->misi }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn px-5 btn-admin-ab-us">
                                                Simpan Data
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#page-content-wrapper -->
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
