@extends('layouts.base')

@section('content')
<div class="page-content page-home">
    <div class="container">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="row">
                <div class="col-12">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/home">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Article Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>
        <h2 class="second-title" data-aos="fade-up">{{$article->title}}</h2>
        <div class="meta-post post-author" data-aos="fade-up">
            <span><i class="fa-solid fa-calendar-days"></i> {{$article->updated_at}}</span>
            <span><i class="fa-solid fa-user"></i> Penulis: {{$article->author}}</span>
        </div>
        <img class="img-article" data-aos="zoom-in" src="{{asset("storage/article_images/".$article->images)}}" alt="">
        <div data-aos="fade-up">
            @php
            $paragraph = explode('<br />', $article->description);
            @endphp
            @foreach ($paragraph as $item)
            <p>{{$item}}</p>
            @endforeach
        </div>
        <hr class="hr-artikel">
        <h3 class="third-title" data-aos="fade-up">Latest Article</h3>
        <div class="row">
            @php
            $i = 200;
            $j = 200;
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
                        style="background-image: url('{{asset("storage/article_images/".$article->images)}}')"></div>
                </div>
                <div class="products-text">
                    {{ substr($article->title, 0, 30) }}...
                </div>
            </a>
        </div>
        @endforeach
        @endif
    </div>
</div>
</div>
@endsection
