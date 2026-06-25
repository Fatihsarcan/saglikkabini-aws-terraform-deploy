<section class="testimonials">
    <div class="background bg-img bg-fixed section-padding pb-0" data-background="img/slider/20.jpg" data-overlay-dark="6">
        <div class="container">
            <div class="row">
                <!-- Appointment call -->
                <div class="col-md-5 mb-30 mt-60">
                    <p class="mb-0"><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i></p>
                    <h5>{{__('Randevu Al')}}</h5>
                    <div class="reservations mb-10">
                        <div class="icon color-1"><span class="fa-solid fa-user-doctor"></span></div>
                        <div class="text">
                            <p class="color-1">{{__('Randevu Al')}}</p>

                        </div>
                    </div>
                </div>
                <!-- Appointment form -->
                <div class="col-md-5 offset-md-2">
                    <div class="booking-box">
                        <div class="head-box text-center">
                            <h4>{{__('Randevu Al')}}</h4>
                        </div>
                        <div class="booking-inner clearfix">
                            @if (session('AppointmentSuccess'))
                                <div class="alert alert-info">
                                    {{ session('AppointmentSuccess') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
                            <form class="form1 clearfix" action="{{route('randevu.post')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input1_wrapper">
                                            <label>{{__('Ad Soyad')}}</label>
                                            <div class="input2_inner">
                                                <input type="text" class="form-control input" name="name" placeholder="Ad Soyad" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input1_wrapper">
                                            <label>{{__('Telefon')}}</label>
                                            <div class="input2_inner">
                                                <input type="text" class="form-control input" name="phone" placeholder="Telefon" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input1_wrapper">
                                            <label>{{__('Tarih')}}</label>
                                            <div class="input1_inner">
                                                <input type="text" class="form-control input datepicker" name="date" placeholder="Tarih" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="select1_wrapper">
                                            <label>{{__('Saat')}}</label>
                                            <div class="select1_inner">
                                                <select class="select2 select" name="time" style="width: 100%">
                                                    <option value="">{{__('Saat Seçiniz')}}</option>
                                                    <option value="10:00">{{__('10:00')}}</option>
                                                    <option value="11:00">{{__('11:00')}}</option>
                                                    <option value="12:00">{{__('12:00')}}</option>
                                                    <option value="14:00">{{__('14:00')}}</option>
                                                    <option value="16:00">{{__('16:00')}}</option>
                                                    <option value="18:00">{{__('18:00')}}</option>
                                                    <option value="20:00">{{__('20:00')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="select1_wrapper">
                                            <label>{{__('Hizmetler')}}</label>
                                            <div class="select1_inner">
                                                <select class="select2 select" name="service_id" style="width: 100%">
                                                    <option value="">{{__('Hizmet Seçiniz')}}</option>
                                                    @foreach ($services as $service)
                                                    <option value="{{$service->id}}">{{$service->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="select1_wrapper">
                                            <label>{{__('Ekibimiz')}}</label>
                                            <div class="select1_inner">
                                                <select class="select2 select" name="team_id" style="width: 100%">
                                                    <option value="">{{__('Ekibimiz Seçiniz')}}</option>
                                                    @foreach ($teams as $team)
                                                    <option value="{{$team->id}}">{{$team->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn-form1-submit mt-15">{{__('Randevu Al')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
