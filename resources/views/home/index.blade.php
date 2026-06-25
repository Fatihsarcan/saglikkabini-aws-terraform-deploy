@extends('layouts.app')

@section('title', 'Doktorlarımız')

@section('content')
<div class="text-center mb-5">
    <h1 class="display-5 fw-bold text-primary"><i class="bi bi-hospital-fill"></i> Sağlık Kabini</h1>
    <p class="lead text-muted">Uzman doktorlarımızdan online randevu alın.</p>
</div>

<div class="row g-4">
    @forelse($doctors as $doctor)
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm doctor-card">
            <div class="card-body text-center p-4">
                <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}" class="doctor-img mb-3">
                <h5 class="card-title mb-1">{{ $doctor->name }}</h5>
                <span class="badge bg-primary mb-3">{{ $doctor->specialty }}</span>
                @if($doctor->bio)
                    <p class="card-text text-muted small">{{ Str::limit($doctor->bio, 80) }}</p>
                @endif
                <a href="{{ route('appointments.create', $doctor) }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-calendar-plus"></i> Randevu Al
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center text-muted py-5">
        <i class="bi bi-person-x fs-1"></i>
        <p class="mt-2">Henüz aktif doktor bulunmuyor.</p>
    </div>
    @endforelse
</div>
@endsection
