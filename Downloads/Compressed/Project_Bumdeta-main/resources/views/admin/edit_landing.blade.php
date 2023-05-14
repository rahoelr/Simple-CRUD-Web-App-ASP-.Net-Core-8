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
            <div class="d-flex justify-content-start">
                <h1>Edit Landing Page Data</h1>
            </div>
            <a href="/db_admin-landing/1"><img class="mr-4 img-back-form" src="{{asset('img/back.png')}}" alt=""></a>
            <form action="{{ route('admin-landing.update', $landings->id) }}" method="POST"
                enctype="multipart/form-data">
                @method('PUT')
                {{ csrf_field() }}
                <div class="content">
                    <div class="kiri">
                        <label for="file-input"><input type="file" class="form-control 
                            @error('carousel')
                                is-invalid
                            @enderror" id="input-file" name="carousel[]" accept="image/*" onchange="previewImage()"
                                multiple><i class="fa-solid fa-upload"></i> &nbsp; Choose 3 Carousel Pictures</label>
                        <p id="num-of-files">No File Chosen</p>
                        <div id="images"></div>
                    </div>
                    <div class="kiri">
                        <label for="file-input"><input type="file" class="form-control 
                            @error('testimoni')
                                is-invalid
                            @enderror" id="input-file1" name="testimoni[]" accept="image/*" onchange="previewImage1()"
                                multiple><i class="fa-solid fa-upload"></i> &nbsp; Choose 3 Testimoni Pictures</label>
                        <p id="num-of-files1">No File Chosen</p>
                        <div id="images1"></div>
                    </div>
                </div>
                <button type="submit" class="buttonProd">Simpan Data</button>
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
        if (fileInput.files.length != 3) {
            Swal.fire({
                icon: 'error',
                title: 'Warning!!!',
                text: 'Wajib upload 3 gambar',
            }).then((value) => {
                location.reload();;
            });
        } else {
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
    }

    let fileInput1 = document.getElementById("input-file1");
    let imageContainer1 = document.getElementById("images1")
    let numOfFiles1 = document.getElementById("num-of-files1");

    function previewImage1() {
        imageContainer1.innerHTML = "";
        numOfFiles1.textContent = '';
        if (fileInput1.files.length != 3) {
            Swal.fire({
                icon: 'error',
                title: 'Warning!!!',
                text: 'Wajib upload 3 gambar',
            }).then((value) => {
                location.reload();;
            });
        } else {
            for (i of fileInput1.files) {
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
                imageContainer1.appendChild(figure);
                reader.readAsDataURL(i);
            }
        }
    }

</script>
@endsection
