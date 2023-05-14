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
            <h1>Detail Artikel</h1>
            <div class="d-flex justify-content-start mt-4">
                <a href="/db_admin-article" class="mr-4"><img class="img-back mb-2" src="{{asset('img/back.png')}}"
                        alt=""></a>
                <h4>{{ $articles->title }}</h4>
            </div>
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card mb-5" style="max-width: 20rem;">
                        <a href="{{asset("storage/article_images/".$articles->images)}}" class="example-image-link"
                            data-lightbox="example-2" data-title="{{ $articles->images }}">
                            <img src="{{asset("storage/article_images/".$articles->images)}}" alt="image-1"
                                class="card-img-top"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <tr>
                        <th>Penulis</th>
                        <td>{{$articles->author}}</td>
                    </tr>
                    <tr>
                        <th>Waktu Penulisan</th>
                        <td>{{$articles->created_at}}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>
                            @php
                            $paragraph = explode('<br />', $articles->description);
                            @endphp
                            @foreach ($paragraph as $item)
                            <div>{{$item}}</div>
                            @endforeach
                        </td>
                    </tr>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                <a href="/admin-articles/{{$articles->id}}/edit"
                    class="btn btn-primary mr-2 mb-3 btn-edit text-light">Edit</a>
                <form action="{{ route('admin-articles.destroy', $articles->id) }}" method="POST">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $articles->id }}">
                    <button type="button" class="btn btn-danger btn-delete" data-toggle="modal"
                        data-target="#modalConfirmDelete">
                        Delete
                    </button>

                    <div class="modal fade modal-delete" id="modalConfirmDelete" data-backdrop="false">
                        <div class="modal-dialog modal-dialog-centered modal-notify modal-danger">
                            <div class="modal-content text-center">
                                <div class="modal-header d-flex justify-content-center">
                                    <p class="heading">Are you sure to delete this article?</p>
                                </div>
                                <div class="modal-body"><i class="fa-solid fa-trash fa-4x"></i></div>
                                <div class="modal-footer flex-center">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    <button type="submit" class="btn btn-outline-danger">Yes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
