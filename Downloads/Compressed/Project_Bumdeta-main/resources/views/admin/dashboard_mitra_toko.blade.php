@extends('layouts.admin')

@section('mitra')
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
                <h1 class="dashboard-title">Toko Saya</h1>
                @if (\Session::has('success'))
                <div class="alert alert-success">
                    {!! \Session::get('success') !!}
                </div>
                @endif
                <p class="dashboard-subtitle">Update your current store profile</p>
            </div>
            <div class="dashboard-content" data-aos="fade-up">
                @if ($mitras != null)
                <h4>{{ $mitras->mitra_name }}</h4>
                <div class="row mt-4">
                    <div class="col-md-3 mb-5">
                        <a href="{{asset("storage/mitra_images/".$mitras->images)}}" class="example-image-link"
                            data-lightbox="example-2" data-title="{{ $mitras->images }}">
                            <img src="{{asset("storage/mitra_images/".$mitras->images)}}" alt="image-1"
                                class="card-img-top"></a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <th>Pemilik</th>
                            <td>{{$mitras->owner}}</td>
                        </tr>
                        <tr>
                            <th>Jenis Usaha</th>
                            <td>{{$mitras->t_o_business}}</td>
                        </tr>
                        <tr>
                            <th>Desa</th>
                            <td>{{$mitras->desa}}</td>
                        </tr>
                        <tr>
                            <th>Kecamatan</th>
                            <td>{{$mitras->kecamatan}}</td>
                        </tr>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/admin-mitras/{{$mitras->id}}/edit"
                        class="btn btn-primary mr-2 btn-edit text-light">Edit</a>
                    <form action="{{ route('admin-mitras.destroy', $mitras->id) }}" method="POST">
                        @method('DELETE')
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $mitras->id }}">
                        <button type="button" class="btn btn-danger btn-delete" data-toggle="modal"
                            data-target="#modalConfirmDelete">
                            Delete
                        </button>

                        <div class="modal fade modal-delete" id="modalConfirmDelete" data-backdrop="false">
                            <div class="modal-dialog modal-dialog-centered modal-notify modal-danger">
                                <div class="modal-content text-center">
                                    <div class="modal-header d-flex justify-content-center">
                                        <p class="heading">Are you sure to delete this store?</p>
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
                @else
                <div class="row">
                    <div class="col-12">
                        <a href="/admin-mitras/create" class="btn btn-success btn-dashboard">Tambah
                            Toko</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.2.slim.js"
    integrity="sha256-OflJKW8Z8amEUuCaflBZJ4GOg4+JnNh9JdVfoV+6biw=" crossorigin="anonymous"></script>
<script>
    $('.delete').click(function () {
        var mitraId = $(this).attr('data-id');
        var mitraName = $(this).attr('data-name');
        swal({
                title: "Yakin?",
                text: "Anda akan menghapus " + mitraName + "",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/admin-mitras-delete/" + mitraId + ""
                    swal("Toko berhasil dihapus", {
                        icon: "success",
                    });
                } else {
                    swal("Toko batal dihapus");
                }
            });
    });

</script>
<!-- /#page-content-wrapper -->
@endsection
