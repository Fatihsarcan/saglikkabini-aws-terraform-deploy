@extends('frontend.layouts.app')

@section('content')
 <!-- Header Banner -->
    @include('frontend.inc.breadcrumb')
 <!-- Contact -->
 <section class="info-box section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="section-head mb-30">
                    <div class="section-subtitle">{{__('İletişim Bilgileri')}}</div>
                    <div class="section-title mb-20">{{__('Bize Ulaşın')}}</div>
                    <p>{{__('Bizimle iletişime geçebilirsiniz.')}}</p>
                </div>
                <div class="item"> <span class="icon ti-location-pin"></span>
                    <div class="cont">
                        <h5>{{__('Adres')}}</h5>
                        <p>{{__($settings['adress'] ?? '')}}</p>
                    </div>
                </div>
                <div class="item"> <span class="icon ti-mobile"></span>
                    <div class="cont">
                        <h5>{{__('Telefon')}}</h5>
                        <p><a href="tel:{{$settings['phone'] ?? ''}}">{{$settings['phone'] ?? ''}}</a></p>
                    </div>
                </div>
                <div class="item"> <span class="icon ti-email"></span>
                    <div class="cont">
                        <h5>{{__('e-Mail')}}</h5>
                        <p>{{$settings['email'] ?? ''}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5 offset-md-1">
                <div class="contact-form bg-darkbrown">
                    <div class="booking-inner clearfix">
                        <form method="post" class="form1 clearfix" action="{{route('iletisim.post')}}" id="contactForm">
                            @csrf

                            <div class="row">
                                <div class="col-md-12 text-center mb-20">
                                    <h4 class="white">{{__('İletişim Formu')}}</h4>
                                </div>
                            </div>
                            <!-- Form message -->
                            <div class="row">
                                <div class="col-12">
                                    @if(session('success'))
                                        <div class="alert alert-success" role="alert">
                                            {{session('success')}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- Form elements -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input1_wrapper">
                                        <label>{{__('Ad Soyad')}}</label>
                                        <div class="input2_inner">
                                            <input type="text" name="name" class="form-control input" placeholder="{{__('Ad Soyad')}}"  >
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input1_wrapper">
                                        <label>{{__('Telefon')}}</label>
                                        <div class="input2_inner">
                                            <input type="text" name="phone" class="form-control input" placeholder="{{__('Telefon')}}"  >
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input1_wrapper">
                                        <label>{{__('E-posta')}}</label>
                                        <div class="input2_inner">
                                            <input type="email" name="email" class="form-control input" placeholder="{{__('E-posta')}}"  >
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input1_wrapper">
                                        <label>{{__('Konu')}}</label>
                                        <div class="input2_inner">
                                            <input type="text" name="subject" class="form-control input" placeholder="{{__(key: 'Konu')}}"  >
                                            @error('subject')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <textarea name="message" id="message" cols="30" rows="4" placeholder="{{__('Mesaj')}}"  ></textarea>
                                    @error('message')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-30">
                                    <button type="submit" class="btn-form2-submit">{{__('Mesaj Gönder')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Maps -->
<section class="section-padding pb-0 pt-0 bg-darkbrown">
    <!-- Maps -->
    <div class="full-width">
        <div class="no-spacing map">
            <iframe src="{{$settings['map'] ?? ''}}" frameborder="0" class="google-maps" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </div>
</section>
@endsection
