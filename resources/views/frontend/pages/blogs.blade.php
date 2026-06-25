@extends('frontend.layouts.app')

@section('content')

<!-- Header Banner -->
@include('frontend.inc.breadcrumb')



<section>
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





</section>
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
    </div>
</section>

<!-- Team -->


@endsection
