@extends('layouts.base')

@section('content')
<div class="page-content page-home">
    <div class="container">
        <h1 class="title" data-aos="fade-up">Tentang Kami</h1>
        <div>
            @foreach ($about_us as $object)
            <div data-aos="fade-up">
                <h2 class="second-title">Sejarah Singkat</h2>
                @php
                $paragraph = explode('<br />', $object->history);
                @endphp
                @foreach ($paragraph as $item)
                <p class="item-list" style="text-align: justify; text-indent: 0.5in;">{{$item}}</p>
                @endforeach
            </div>
            <div data-aos="fade-up">
                <h2 class="second-title">Makna Logo</h2>
                <img data-aos="zoom-in" class="contents-img" src="{{asset("storage/aboutUs_images/".$object->images)}}"
                    alt="">
                @php
                $paragraph = explode('<br />', $object->logo_meaning);
                @endphp
                @foreach ($paragraph as $item)
                <ul class="list-about_us">
                    <li>
                        <p class="item-list" data-aos="fade-up">{{$item}}</p>
                    </li>
                </ul>
                @endforeach
            </div>
            <div data-aos="fade-up">
                <h2 class="second-title">Visi</h2>
                @php
                $paragraph = explode('<br />', $object->visi);
                @endphp
                @foreach ($paragraph as $item)
                <ul class="list-about_us">
                    <li>
                        <p class="item-list">{{$item}}</p>
                    </li>
                </ul>
                @endforeach
            </div>
            <div data-aos="fade-up">
                <h2 class="second-title">Misi</h2>
                @php
                $paragraph = explode('<br />', $object->misi);
                @endphp
                @foreach ($paragraph as $item)
                <ul class="list-about_us">
                    <li>
                        <p class="item-list">{{$item}}</p>
                    </li>
                </ul>
                @endforeach
            </div>
            @endforeach
        </div>
        <h2 class="second-title" data-aos="fade-up">Anggota</h2>
        <div class="flex-horizontal">
            @php
            $i = 100;
            @endphp
            @foreach ($teams as $team)
            <div class="team" data-aos="fade-up" data-aos-delay="{{$i+=200}}">
                <img src="{{asset("storage/team_images/".$team->images)}}">
                <h4 class="fourth-title">{{ $team->name }}</h4>
                <p>{{ $team->position }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
