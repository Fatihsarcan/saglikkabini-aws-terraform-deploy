@extends('frontend.layouts.app')

@section('content')
 <!-- Header Banner -->
    @include('frontend.inc.breadcrumb')
<!-- Services -->
<section class="services-1 section-padding">
    <div class="container">
        <div class="row">
            @foreach ($services as $service)
            <div class="col-md-4">
                <div class="item">
                    <a href="{{route('hizmet', $service->slug)}}"> <span class="fa-solid fa-user-doctor"></span>
                        <h5>{{$service->name}}</h5>
                        <p>{!! $service->description !!}</p>
                        <div class="shape"> <span class="icon icon-icon-1-3"></span> </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- First Class Services -->
<div class="first-class-services section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-head text-center">
                    <div class="section-title white">{{__('Öne Çıkan Kategoriler')}}</div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($categories as $category)
            <div class="col-md-4">
                <div class="square-flip">
                    <div class="square bg-img" data-background="{{asset($category->image)}}">
                        <div class="square-container d-flex align-items-end justify-content-end">
                            <div class="box-title">
                                <h4>{{$category->name}}</h4>
                            </div>
                        </div>
                        <div class="flip-overlay"></div>
                    </div>
                    <div class="square2">
                        <div class="square-container2">
                            <h4>{{$category->name}}</h4>
                            <p><i>{{$category->content}}</i></p>
                            <a href="{{route('kategori.detay', $category->slug)}}" class="button-2 mt-15">Hemen Bilgi Edin<span></span></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!-- Appointment Form -->
@include('frontend.inc.appoimentform')
<!-- Clients -->
<section class="clients">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="owl-carousel owl-theme">
                    <div class="clients-logo">
                        <a href="#0"><img src="img/clients/2.jpg" alt=""></a>
                    </div>
                    <div class="clients-logo">
                        <a href="#0"><img src="img/clients/3.jpg" alt=""></a>
                    </div>
                    <div class="clients-logo">
                        <a href="#0"><img src="img/clients/5.png" alt=""></a>
                    </div>
                    <div class="clients-logo">
                        <a href="#0"><img src="img/clients/5.png" alt=""></a>
                    </div>
                    <div class="clients-logo">
                        <a href="#0"><img src="img/clients/6.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
