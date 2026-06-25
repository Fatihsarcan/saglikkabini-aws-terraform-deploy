<!-- FontAwesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="footer-column footer-contact">
                        <h3 class="footer-title">{{__('İletişim')}}</h3>
                        <p class="footer-contact-text">{{$settings['adress'] ?? ''}}
                        </p>
                        <div class="footer-contact-info">
                            <p class="footer-contact-phone">{{$settings['phone'] ?? ''}}</p>
                            <p class="footer-contact-mail">{{$settings['email'] ?? ''}}</p>
                        </div>
                        <div class="footer-about-social-list">
                            @if(isset($settings['instagram']) && $settings['instagram'] != '')
                            <a href="{{$settings['instagram']}}" target="_blank"><i class="ti-instagram"></i></a>
                            @endif
                            @if(isset($settings['twitter']) && $settings['twitter'] != '')
                            <a href="{{$settings['twitter']}}" target="_blank"><i class="ti-twitter"></i></a>
                            @endif
                            @if(isset($settings['youtube']) && $settings['youtube'] != '')
                            <a href="{{$settings['youtube']}}" target="_blank"><i class="ti-youtube"></i></a>
                            @endif
                            @if(isset($settings['facebook']) && $settings['facebook'] != '')
                            <a href="{{$settings['facebook']}}" target="_blank"><i class="ti-facebook"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3 offset-md-1">
                    <div class="item opening">
                        <h3 class="footer-title">{{__('Çalışma Saatleri')}}</h3>
                        <ul>
                            @foreach ($workTimes as $workTime)
                            <li>
                                <div class="tit">{{__($workTime->day_name)}}</div>
                                <div class="dots"></div>
                                <span>
                                    @if($workTime->status == 0)
                                    {{__('Kapalı')}}
                                    @else
                                    {{$workTime->open_time}} - {{$workTime->close_time}}
                                    @endif
                                </span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 offset-md-1">
                    <div class="footer-column footer-explore clearfix">
                        <h3 class="footer-title">{{__('Abone Ol')}}</h3>
                        <div class="row subscribe">
                            <div class="col-md-12">
                                <p>{{__('Abone olarak kampanyalarımızdan ve hediyelerimizden yararlanabilirsiniz.')}}</p>
                                <form class="subscribe-form" action="{{route('subscribe.post')}}" method="post">
                                    @csrf
                                    <input type="text" name="email" placeholder="{{__('Emailinizi Giriniz')}}"  >
                                    <button>{{__('Abone Ol')}}</button>
                                </form>
                                @if(session('success'))
                                <div class="alert alert-success">
                                    {{session('success')}}
                                </div>
                                @endif

                                @if($errors->has('email'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('email') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer-bottom-inner">
                        <p class="footer-bottom-copy-right">{{ date('Y') }} © {{ __($settings['copyright'] ?? '')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>