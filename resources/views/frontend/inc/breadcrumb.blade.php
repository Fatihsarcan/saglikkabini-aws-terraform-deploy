<div class="banner-header valign bg-img bg-fixed" data-overlay-dark="4" data-background="img/slider/1.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center caption mt-60">
                <h1>{{$breadcrumbs[count($breadcrumbs) - 1]['name']}}</h1>
                <ul class="breadcrumbs">
                    <li><a href="{{ route('anasayfa') }}">{{__('Anasayfa')}}</a></li>
                    @foreach ($breadcrumbs as $breadcrumb)
                        @if ($loop->last)
                            <li>{{ $breadcrumb['name'] }}</li>
                        @else
                            <li><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>