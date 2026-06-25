@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h4 class="mb-4">Dashboard</h4>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <div class="fs-1 text-primary"><i class="bi bi-person-badge"></i></div>
            <div class="fs-3 fw-bold">{{ $stats['total_doctors'] }}</div>
            <div class="text-muted small">Toplam Doktor</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <div class="fs-1 text-success"><i class="bi bi-person-check"></i></div>
            <div class="fs-3 fw-bold">{{ $stats['active_doctors'] }}</div>
            <div class="text-muted small">Aktif Doktor</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <div class="fs-1 text-warning"><i class="bi bi-calendar-check"></i></div>
            <div class="fs-3 fw-bold">{{ $stats['total_appointments'] }}</div>
            <div class="text-muted small">Toplam Randevu</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <div class="fs-1 text-info"><i class="bi bi-calendar-day"></i></div>
            <div class="fs-3 fw-bold">{{ $stats['today_appointments'] }}</div>
            <div class="text-muted small">Bugünkü Randevu</div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white fw-semibold">Son Randevular</div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Hasta</th>
                    <th>Doktor</th>
                    <th>Tarih / Saat</th>
                    <th>Durum</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentAppointments as $a)
                <tr>
                    <td>{{ $a->user->name }}</td>
                    <td>{{ $a->doctor->name }}</td>
                    <td>{{ $a->timeSlot->slot_date->format('d.m.Y') }} {{ substr($a->timeSlot->slot_time, 0, 5) }}</td>
                    <td>
                        @if($a->status === 'confirmed')
                            <span class="badge bg-success">Onaylı</span>
                        @else
                            <span class="badge bg-secondary">İptal</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted py-3">Randevu yok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
