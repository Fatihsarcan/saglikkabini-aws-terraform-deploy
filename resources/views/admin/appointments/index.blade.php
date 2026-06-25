@extends('layouts.admin')

@section('title', 'Randevular')

@section('content')
<h4 class="mb-4">Tüm Randevular</h4>

<div class="card shadow-sm mb-3 p-3">
    <form method="GET" class="row g-2 align-items-end">
        <div class="col-md-3">
            <label class="form-label small">Doktor</label>
            <select name="doctor_id" class="form-select form-select-sm">
                <option value="">Tümü</option>
                @foreach($doctors as $d)
                    <option value="{{ $d->id }}" {{ request('doctor_id') == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label small">Tarih</label>
            <input type="date" name="date" class="form-control form-control-sm" value="{{ request('date') }}">
        </div>
        <div class="col-md-2">
            <label class="form-label small">Durum</label>
            <select name="status" class="form-select form-select-sm">
                <option value="">Tümü</option>
                <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Onaylı</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>İptal</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-sm btn-primary w-100">Filtrele</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('admin.appointments.index') }}" class="btn btn-sm btn-outline-secondary w-100">Temizle</a>
        </div>
    </form>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Hasta</th>
                    <th>Doktor</th>
                    <th>Tarih / Saat</th>
                    <th>Durum</th>
                    <th>Kayıt</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $a)
                <tr>
                    <td>{{ $a->id }}</td>
                    <td>{{ $a->user->name }}<br><small class="text-muted">{{ $a->user->email }}</small></td>
                    <td>{{ $a->doctor->name }}</td>
                    <td>{{ $a->timeSlot->slot_date->format('d.m.Y') }} {{ substr($a->timeSlot->slot_time, 0, 5) }}</td>
                    <td>
                        @if($a->status === 'confirmed')
                            <span class="badge bg-success">Onaylı</span>
                        @else
                            <span class="badge bg-secondary">İptal</span>
                        @endif
                    </td>
                    <td><small class="text-muted">{{ $a->created_at->format('d.m.Y H:i') }}</small></td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-3">Randevu bulunamadı.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($appointments->hasPages())
        <div class="card-footer">{{ $appointments->links() }}</div>
    @endif
</div>
@endsection
