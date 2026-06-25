@extends('frontend.layouts.app')

@section('content')
 <!-- Header Banner -->
    @include('frontend.inc.breadcrumb')
 <!-- Services Page -->
 <section class="barber-pricing section-padding">
    <div class="container">
        <div class="row">
            <!-- Content -->
            <div class="col-md-7 mb-30">
                <div class="section-head mb-15">
                    <div class="section-title">{{ $service->name }}</div>
                </div>
                <p>{!! $service->content !!}</p>
                <!-- Pricing -->
                <!-- Image Gallery -->
                <div class="row">
                    @if (isset($service->images) && $service->images > 0)
                    @foreach ($service->images as $image)
                    <div class="col-md-4 gallery-item">
                        <a href="{{$image->image_url}}" title="" class="img-zoom">
                            <div class="gallery-box">
                                <div class="gallery-img"> <img src="{{$image->image_url}}" class="img-fluid mx-auto d-block" alt="work-img"> </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <!-- Sidebar -->
            <div class="col-md-4 offset-md-1 sidebar-side">
                <aside class="sidebar blog-sidebar mb-60">
                    <div class="sidebar-widget services">
                        <div class="widget-inner">
                            <div class="sidebar-title">
                                <h4>{{__('Hizmetler')}}</h4>
                            </div>
                            <ul>
                                @foreach ($services as $otherService)
                                <li class="{{$otherService->id == $service->id ? 'active' : ''}}"><a href="{{ route('hizmet', $otherService->slug) }}">{{ $otherService->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

@endsection
