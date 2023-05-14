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
            <h1>{{$title}}</h1>
            <a href="/db_admin-landing/1" class="btn btn-info btn-edit text-light">Back</a>
            <h2>Carousel</h2>
            <div class="row mt-4">
                @php
                $image = explode('|', $landings->carousel);
                $i = 1;
                @endphp
                @foreach ($image as $item)
                <div class="col-md-3">
                    <div class="card mb-5" style="max-width: 20rem;">
                        <a href="{{asset("storage/landingPage_images/".$item)}}" class="example-image-link"
                            data-lightbox="example-2" data-title="{{ $item }}">
                            <img src="{{asset("storage/landingPage_images/".$item)}}" alt="image-1"
                                class="card-img-top"></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="container">
            <h2>Testimoni</h2>
            <div class="row mt-4">
                @php
                $image = explode('|', $landings->testimoni);
                $i = 1;
                @endphp
                @foreach ($image as $item)
                <div class="col-md-3">
                    <div class="card mb-5" style="max-width: 20rem;">
                        <a href="{{asset("storage/landingPage_images/".$item)}}" class="example-image-link"
                            data-lightbox="example-2" data-title="{{ $item }}">
                            <img src="{{asset("storage/landingPage_images/".$item)}}" alt="image-1"
                                class="card-img-top"></a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex flex-row">
                <a href="/admin-landing/{{$landings->id}}/edit"
                    class="btn btn-primary mr-2 mb-3 btn-edit text-light">Edit</a>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
