@extends('frontend.layouts.app')


<!-- Header Banner -->
@include('frontend.inc.breadcrumb')


@section('content')



    <!-- arrow down -->
    <div class="arrow bounce text-center">
        <a href="#" data-scroll-nav="1" class=""> <i class="ti-arrow-down"></i> </a>
    </div>

    <!-- arrow d


Blog Detail -->
<section class="blog-detail section-padding">
    <div class="container">
        <div class="col-md-6 mb-30">
            <h1>{{ $blog->title }}</h1>
            <p class="text-muted">
                {{ \Carbon\Carbon::parse($blog->created_at)->translatedFormat('d M Y') }}
            </p>
            <div class="content">
                {!! $blog->content !!}
            </div>
        </div>


                    <h2>{{$slider->content}}</h2>
       <a href="tel:{{ $slider->button_text }}" class="button-1 mt-20">
    <i class="fa-solid fa-phone"></i>  {{ $slider->button_text }}
</a>



    </div>

</section>






<!-- Team -->


@endsection

