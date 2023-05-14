@extends('layouts.base')

@section('content')
<div class="page-content page-home">
    <div class="container">
        <h1 class="title" data-aos="fade-up">Artikel</h1>
        <div class="row">
            @php
            $i = 100;
            @endphp
            @foreach ($articles as $article)
            <a href="/detail-artikel/{{$article->id}}">
                <div class="col-12 col-md-12 col-lg-12" data-aos="fade-up" data-aos-delay="{{$i+=50}}">
                    <div class="component-products d-block">
                        <div class="products-thumbnail article-thumbnail">
                            <div class="products-image" style="
                            background-image: url('{{asset("storage/article_images/".$article->images)}}');
                        "></div>
                        </div>
                        <h2 class="sub-title">{{$article->title}}</h2>
                        <div class="flex-date">
                            <div class="date">
                                {{$article->updated_at}}
                            </div>
                            <div class="penulis">
                                Penulis: {{$article->author}}
                            </div>
                        </div>
                        <div class="article-desc">{{substr($article->description, 0, 200)}}</div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $articles->links() }}
        </div>
    </div>
</div>
@endsection
