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
            <h1>Edit Anggota</h1>
            <a href="/db_admin-team-detail/{{$teams->id}}"><img class="mr-4 img-back-form"
                    src="{{asset('img/back.png')}}" alt=""></a>
            <form action="{{ route('admin-teams.update', $teams->id) }}" method="POST" enctype="multipart/form-data">
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
                            <label for="name">Nama Anggota</label>
                            <input type="text" name="name" id="name" class="form-control @error('name')
                        is-invalid
                    @enderror" value="{{ $teams->name }}">
                            @error('name')
                            <div class="invalid-feedback ml-4">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="Position">
                            <label for="position">Jabatan</label>
                            <select class="form-control @error('position')
                        is-invalid
                    @enderror" name="position" id="position">
                                <option value='Ketua' {{($teams->position === 'Ketua') ? 'selected' : ''}}>Ketua
                                </option>
                                <option value='Sekretaris 1'
                                    {{($teams->position === 'Sekretaris 1') ? 'selected' : ''}}>
                                    Sekretaris 1</option>
                                <option value='Sekretaris 2'
                                    {{($teams->position === 'Sekretaris 2') ? 'selected' : ''}}>
                                    Sekretaris 2</option>
                                <option value='Bendahara' {{($teams->position === 'Bendahara') ? 'selected' : ''}}>
                                    Bendahara
                                </option>
                                <option value='Manager Unit Pangan'
                                    {{($teams->position === 'Manager Unit Pangan') ? 'selected' : ''}}>Manager Unit
                                    Pangan
                                </option>
                                <option value='Manager Unit Barang & Jasa'
                                    {{($teams->position === 'Manager Unit Barang & Jasa') ? 'selected' : ''}}>Manager
                                    Unit
                                    Barang & Jasa</option>
                            </select>
                            @error('position')
                            <div class="invalid-feedback ml-4">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
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
