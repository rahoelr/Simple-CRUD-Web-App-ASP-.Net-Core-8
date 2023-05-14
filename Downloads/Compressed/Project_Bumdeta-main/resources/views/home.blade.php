@extends('layouts.base')

@section('content')
<div class="page-content page-home">
    @if (\Session::has('success'))
    <div class="alert alert-success">
        {!! \Session::get('success') !!}
    </div>
    @endif
    <section class="store-carousel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" data-aos="zoom-in">
                    <div id="storeCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li class="active" data-target="#storeCarousel" data-slide-to="0"></li>
                            <li data-target="#storeCarousel" data-slide-to="1"></li>
                            <li data-target="#storeCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            @php
                            $carousel = explode('|', $landings->carousel);
                            @endphp
                            <div class="carousel-item active">
                                <img src="{{asset("storage/landingPage_images/".$carousel[0])}}" alt="Carousel Image"
                                    class="d-block w-100" />
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset("storage/landingPage_images/".$carousel[1])}}" alt="Carousel Image"
                                    class="d-block w-100" />
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset("storage/landingPage_images/".$carousel[2])}}" alt="Carousel Image"
                                    class="d-block w-100" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="store-trend-categories">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>Kategori</h5>
                </div>
            </div>
            <div class="row">
                @php
                $i = 100;
                @endphp
                @foreach ($categories as $category)
                <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="{{$i+=200}}">
                    <a href="/produk" class="component-categories d-block">
                        <div class="categories-image">
                            <img src="{{asset("storage/category_images/".$category->images)}}" alt="" class="w-100" />
                        </div>
                        <p class="categories-text">{{$category->category}}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="store-new-products">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>Produk Baru</h5>
                </div>
            </div>
            <div class="row">
                @php
                $i = 100;
                $j = 100;
                @endphp
                @if (count($products) > 7)
                @for ($k = 0; $k < 8; $k++) <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up"
                    data-aos-delay="{{$i+=100}}">
                    @php
                    $image = explode('|', $products[$k]->images);
                    @endphp
                    <a href="/detail_produk/{{$products[$k]->id}}" class="component-products d-block">
                        <div class="products-thumbnail">
                            <div class="products-image" style="
                    background-image: url('{{asset("storage/product_images/".$image[0])}}');"></div>
                        </div>
                        <div class="products-text">{{$products[$k]->product_name}}</div>
                        <div class="products-price">Rp {{$products[$k]->price}}</div>
                    </a>
            </div>
            @endfor
            @else
            @foreach ($products as $product)
            <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{$j+=200}}">
                @php
                $image = explode('|', $product->images);
                @endphp
                <a href="/detail_produk/{{$product->id}}" class="component-products d-block">
                    <div class="products-thumbnail">
                        <div class="products-image" style="
                    background-image: url('{{asset("storage/product_images/".$image[0])}}');"></div>
                    </div>
                    <div class="products-text">{{$product->product_name}}</div>
                    <div class="products-price">Rp {{$product->price}}</div>
                </a>
            </div>
            @endforeach
            @endif
        </div>
    </section>
    <section class="store-new-products">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up" data-aos-delay="200">
                    <h5>Mitra</h5>
                </div>
            </div>
            <div class="row">
                @php
                $i = 100;
                $j = 100;
                @endphp
                @if (count($mitras) > 3)
                @for ($k = 0; $k < 4; $k++) <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up"
                    data-aos-delay="{{$i+=200}}">
                    <a href="/mitra" class="component-products d-block">
                        <div class="products-thumbnail">
                            <div class="products-image" style="
                        background-image: url('{{asset("storage/mitra_images/".$mitras[$k]->images)}}');
                    "></div>
                        </div>
                        <div class="products-text">{{$mitras[$k]->mitra_name}}</div>
                        <div class="products-price">{{$mitras[$k]->t_o_business}}</div>
                    </a>
            </div>
            @endfor
            @else
            @foreach ($mitras as $mitra)
            <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{$j+=200}}">
                <a href="#" class="component-products d-block">
                    <div class="products-thumbnail">
                        <div class="products-image" style="
                        background-image: url('{{asset("storage/mitra_images/".$mitra->images)}}');
                    "></div>
                    </div>
                    <div class="products-text">{{$mitra->mitra_name}}</div>
                    <div class="products-price">{{$mitra->t_o_business}}</div>
                </a>
            </div>
            @endforeach
            @endif
        </div>
    </section>
    <section class="testimoni-carousel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" data-aos="zoom-in" data-aos-delay="100">
                    <div id="testimoniCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li class="active" data-target="#testimoniCarousel" data-slide-to="0"></li>
                            <li data-target="#testimoniCarousel" data-slide-to="1"></li>
                            <li data-target="#testimoniCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            @php
                            $testimoni = explode('|', $landings->testimoni);
                            @endphp
                            <div class="carousel-item active">
                                <img src="{{asset("storage/landingPage_images/".$testimoni[0])}}" alt="Carousel Image"
                                    class="d-block w-100" />
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset("storage/landingPage_images/".$testimoni[1])}}" alt="Carousel Image"
                                    class="d-block w-100" />
                            </div>
                            <div class="carousel-item">
                                <img src="{{asset("storage/landingPage_images/".$testimoni[2])}}" alt="Carousel Image"
                                    class="d-block w-100" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="store-new-products">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-4" data-aos="fade-up" data-aos-delay="500">
                    <h5>Artikel</h5>
                </div>
            </div>
            <div class="row">
                @php
                $i = 500;
                $j = 500;
                @endphp
                @if (count($articles) > 3)
                @for ($k = 0; $k < 4; $k++) <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up"
                    data-aos-delay="{{$i+=200}}">
                    <a href="/detail-artikel/{{$articles[$k]->id}}" class="component-products d-block">
                        <div class="products-thumbnail">
                            <div class="products-image"
                                style="background-image: url('{{asset("storage/article_images/".$articles[$k]->images)}}')">
                            </div>
                        </div>
                        <div class="products-text">
                            {{ substr($articles[$k]->title, 0, 30) }}...
                        </div>
                    </a>
            </div>
            @endfor
            @else
            @foreach ($articles as $article)
            <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{$j+=200}}">
                <a href="/detail-artikel/{{$article->id}}" class="component-products d-block">
                    <div class="products-thumbnail">
                        <div class="products-image"
                            style="background-image: url('{{asset("storage/article_images/".$article->images)}}')">
                        </div>
                    </div>
                    <div class="products-text">
                        {{ substr($article->title, 0, 30) }}...
                    </div>
                </a>
            </div>
            @endforeach
            @endif
        </div>
    </section>
    <section class="store-new-products">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-4" data-aos="fade-up" data-aos-delay="600">
                    <h5>Hubungi Kami</h5>
                </div>
            </div>
            <form action="{{ route('admin-message.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row" data-aos="fade-up" data-aos-delay="700">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fullName">Nama Lengkap</label>
                            <input type="text" class="form-control @error('fullName')
                        is-invalid
                    @enderror" id="fullName" aria-describedby="emailHelp" name="fullName"
                                value="{{ old('fullName') }}" />
                            @error('fullName')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email')
                        is-invalid
                    @enderror" id="email" aria-describedby="emailHelp" name="email" value="{{ old('email') }}" />
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="subject">Subjek Pesan</label>
                            <input type="text" class="form-control @error('subject')
                        is-invalid
                    @enderror" id="subject" aria-describedby="emailHelp" name="subject" value="{{ old('subject') }}" />
                            @error('subject')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="content">Isi Pesan</label>
                            <textarea type="text" class="form-control @error('content')
                        is-invalid
                    @enderror" id="content" rows="5" aria-describedby="emailHelp"
                                name="content">{{ old('content') }}</textarea>
                            @error('content')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="800">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-success btn-block px-5 btn-send">
                            Kirim Sekarang
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
