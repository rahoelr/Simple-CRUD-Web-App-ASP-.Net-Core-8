@extends('layouts.base')

@section('content')
<div class="page-content page-home">
    <section class="store-trend-categories">
        <div class="container">
            <h1 class="title" data-aos="fade-up">Mitra</h1>
            <div class="row">
                @php
                $i = 100;
                @endphp
                @foreach ($mitras as $mitra)
                <div class="col-6 col-md-4 col-lg-6" data-aos="fade-up" data-aos-delay="{{$i+=50}}">
                    <div class="component-products d-block">
                        <a href="/detail_mitra/{{$mitra->id}}" class="component-products d-block">
                            <div class="products-thumbnail mitra-thumbnail">
                                <div class="products-image" style="
                                background-image: url('{{asset("storage/mitra_images/".$mitra->images)}}');
                            "></div>
                            </div>
                            <div class="products-title">{{$mitra->mitra_name}}</div>
                            <div class="products-desc">Pemilik: {{$mitra->owner}}</div>
                            <div class="products-desc">Jenis Usaha: {{$mitra->t_o_business}}</div>
                            <div class="products-desc">Alamat: Desa {{$mitra->desa}}, Kecamatan {{$mitra->kecamatan}}
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $mitras->links() }}
            </div>
        </div>
    </section>
</div>
@endsection
