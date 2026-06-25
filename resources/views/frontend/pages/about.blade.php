@extends('frontend.layouts.app')

@section('content')

 <!-- Header Banner -->
    @include('frontend.inc.breadcrumb')
    <!-- About -->
    <section class="about section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-30">
                    <div class="section-head mb-20">
                        <div class="section-title">{{$about->name}}</div>
                    </div>
                    <p>{!! $about->content !!}</p>

                    <p>{!! $about->vision !!}</p>
                    <p>{!! $about->mission !!}</p>
                </div>
                <div class="col col-md-3"> <img src="{{asset($about->image_url)}}" alt="" class="mt-90 mb-30"> </div>

            </div>
        </div>
    </section>
    <!-- Services Box -->
    <section class="services-box  section-padding pt-0 ">
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


    <!-- Team -->

@endsection
