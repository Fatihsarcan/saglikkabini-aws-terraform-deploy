@extends('frontend.layouts.app')

@section('content')
<!-- Parallax Image -->
<div class="banner-header full-height valign bg-img bg-fixed" data-overlay-dark="5" data-background="img/slider/23.jpg">
    <div class="container">
        <div class="row content-justify-center">
            <div class="col-md-12 text-center">
                <div class="v-middle">
                    <h2>{{$slider->name}}</h2>
                    <h2>{{$slider->content}}</h2>
       <a href="tel:{{ $slider->button_text }}" class="button-1 mt-20">
    <i class="fa-solid fa-phone"></i>  {{ $slider->button_text }}
</a>


                </div>
            </div>
        </div>
    </div>
    <!-- arrow down -->
    <div class="arrow bounce text-center">
        <a href="#" data-scroll-nav="1" class=""> <i class="ti-arrow-down"></i> </a>
    </div>
</div>


<!-- Services Box -->
<section class="services-box  section-padding  ">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="item"> <span class="{{$settings['home_hero_image_1']}}"></span>
                    <div class="cont">
                        <h5>{{__($settings['home_hero_title_1'])}}</h5>
                        <p>{{__($settings['home_hero_description_1'])}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="item"> <span class="{{$settings['home_hero_image_2']}}"></span>
                    <div class="cont">
                        <h5>{{__($settings['home_hero_title_2'])}}</h5>
                        <p>{{__($settings['home_hero_description_2'])}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="item"> <span class="{{$settings['home_hero_image_3']}}"></span>
                    <div class="cont">
                        <h5>{{__($settings['home_hero_title_3'])}}</h5>
                        <p>{{__($settings['home_hero_description_3'])}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Our History -->
<section class="about section-padding bg-darkbrown">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mb-30 animate-box" data-animate-effect="fadeInLeft"> <img src="{{asset($about->image_url)}}" alt=""> </div>
            <div class="col-md-7 valign mb-30 animate-box" data-animate-effect="fadeInRight">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-head mb-20">
                            <div class="section-title white">{{$about->name}}</div>
                        </div>
                        <p>{{$about->content}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services -->
<section class="barber-services section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-head text-center">
                    <div class="section-title">{{__('Öne Çıkan Hizmetler')}}</div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($isFeaturedServices as $service)
            <div class="col-md-4 animate-box" data-animate-effect="fadeInUp">
                <div class="item">
                    <div class="position-re o-hidden"> <img src="{{asset($service->image_url)}}" alt=""> </div>
                    <div class="con">
                        <div class="fa-solid fa-user-doctor"></div>
                        <h5>{{$service->name}}</h5>
                        <div class="line"></div>
                         <div class="row">
                            <div class="col-md-12 text-center">

                                <h6>Hizmeti almak için arayın deneme</h6>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Testimonials -->
<section class="background bg-img bg-fixed section-padding pb-0" data-background="img/slider/6.jpg" data-overlay-dark="4">
    <div class="container">
        <div class="row">
            <!-- Testimonials -->
            <div class="col-md-8 offset-md-2 text-center">
                <div class="testimonials">
                    <div class="testimonials-box">
                        <div class="owl-carousel owl-theme">
                            @foreach ($comments as $comment)
                            <div class="item"> <span>
                                    @for ($i = 0; $i < $comment->star; $i++)
                                        <i class="star-rating"></i>
                                    @endfor
                                </span>
                                <p>{{$comment->content}}</p>
                                <div class="info">
                                    <div class="author-img"> <img src="{{asset($comment->image_url ?? 'img/team/3.jpg')}}" alt=""> </div>
                                    <div class="cont">
                                        <h6>{{$comment->name}}</h6>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
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



<!-- Services - We Also Offer -->

<!-- News -->
<section class="news section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-head text-center">
                    <div class="section-subtitle">{{__('Blog')}}</div>
                    <div class="section-title white">{{__('Son Blog Yazılarımız')}}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
               <div class="news owl-carousel owl-theme">
    @if(isset($blogs) && $blogs->count() > 0)
        @foreach ($blogs as $blog)
            <div class="item">
                <div class="position-re o-hidden">
                    <img src="{{ $blog->image_url }}" alt="">
                    <div class="date">
                        <a href="{{ route('blog.detay.'.app()->getLocale(), $blog->slug) }}">
                            <span>{{ \Carbon\Carbon::parse($blog->updated_at)->translatedFormat('M') }}</span>
                            <i>{{ \Carbon\Carbon::parse($blog->updated_at)->translatedFormat('d') }}</i>
                        </a>
                    </div>
                </div>
                <div class="con">
                    <span class="category">
                        <a href="{{ route('blog.detay.'.app()->getLocale(), $blog->slug) }}">{{ $blog->name }}</a>
                    </span>
                    <h5>
                        <a href="{{ route('blog.detay.'.app()->getLocale(), $blog->slug) }}">{{ $blog->description }}</a>
                    </h5>
                </div>
            </div>
        @endforeach
    @endif
</div>

            </div>
        </div>
    </div>
</section>
<!-- Appointment Form -->
@include('frontend.inc.appoimentform')
<!-- Clients -->
<section class="clients">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="owl-carousel owl-theme">
                    @foreach ($referances as $referance)
                    <div class="clients-logo">
                        <a href="#"><img src="{{asset($referance->image_url)}}" alt="{{$referance->name}}"></a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
