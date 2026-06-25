<nav class="navbar navbar-expand-lg">
    <div class="container">
        <!-- Logo -->
        <div class="logo-wrapper">
            <a class="logo" href="{{route('anasayfa')}}"> <img src="{{asset('img/logo.png')}}" class="logo-img" alt=""> </a>
            <!-- <a class="logo" href="index.html"> <h2>Perukar <span>Barber Shop</span></h2> </a> -->
        </div>
        <!-- Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"><i class="ti-menu"></i></span> </button>
        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link {{request()->routeIs('anasayfa') ? 'active' : ''}}" href="{{route('anasayfa')}}">{{__('Anasayfa')}}</a></li>
                <li class="nav-item"><a class="nav-link {{request()->routeIs('hakkimizda') ? 'active' : ''}}" href="{{route('hakkimizda')}}">{{__('Hakkımızda')}}</a></li>
                @if(isset($services))
                <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="{{route('hizmetler')}}"  >Hizmetlerimiz <i class="ti-angle-down"></i></a>
                    <ul class="dropdown-menu">
                            @foreach ($services as $service)
                                <li><a href="{{route('hizmet', $service->slug)}}" class="dropdown-item"><span>{{$service->name}}</span></a></li>
                            @endforeach
                    </ul>
                </li>
                @endif
                <li class="nav-item"><a class="nav-link {{request()->routeIs('iletisim') ? 'active' : ''}}" href="{{route('iletisim')}}">{{__('İletişim')}}</a></li>
            </ul>
            <div class="language-selector">
                <a href="{{route('language', 'tr')}}" class="{{app()->getLocale() == 'tr' ? 'active' : ''}}">{{__('Türkçe')}}</a>
                <a href="{{route('language', 'en')}}" class="{{app()->getLocale() == 'en' ? 'active' : ''}}">{{__('İngilizce')}}</a>
            </div>
        </div>
    </div>
</nav>