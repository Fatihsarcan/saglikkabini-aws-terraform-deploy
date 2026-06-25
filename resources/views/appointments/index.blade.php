@extends('layouts.app')

@section('title', 'Randevularım')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-calendar-check"></i> Randevularım</h3>
    <a href="{{ route('home') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-circle"></i> Yeni Randevu
    </a>
</div>

@forelse($appointments as $appointment)
<div class="card shadow-sm mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
            <div class="d-flex gap-3 align-items-center">
                <img src="{{ $appointment->doctor->photo_url }}" style="width:52px;height:52px;object-fit:cover;border-radius:50%;" alt="">
                <div>
                    <h6 class="mb-0">{{ $appointment->doctor->name }}</h6>
                    <small class="text-muted">{{ $appointment->doctor->specialty }}</small><br>
                    <span class="fw-semibold">
                        <i class="bi bi-calendar3"></i>
                        {{ $appointment->timeSlot->slot_date->format('d.m.Y') }}
                        &nbsp;
                        <i class="bi bi-clock"></i>
                        {{ substr($appointment->timeSlot->slot_time, 0, 5) }}
                    </span>
                </div>
            </div>
            <div class="text-end">
                @if($appointment->status === 'confirmed')
                    <span class="badge bg-success mb-2">Onaylı</span><br>
                    @if($appointment->timeSlot->slot_date->isFuture())
                        <form method="POST" action="{{ route('appointments.cancel', $appointment) }}"
                              onsubmit="return confirm('Randevunuzu iptal etmek istiyor musunuz?')">
                            @csrf
                            <button class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-x-circle"></i> İptal Et
                            </button>
                        </form>
                    @endif
                @else
                    <span class="badge bg-secondary">İptal Edildi</span>
                @endif
            </div>
        </div>
        @if($appointment->notes)
            <div class="mt-2 text-muted small"><i class="bi bi-chat-left-text"></i> {{ $appointment->notes }}</div>
        @endif
    </div>
</div>
@empty
<div class="text-center py-5 text-muted">
    <i class="bi bi-calendar-x fs-1"></i>
    <p class="mt-2">Henüz randevunuz yok.</p>
    <a href="{{ route('home') }}" class="btn btn-primary">Randevu Al</a>
</div>
@endforelse
@endsection
