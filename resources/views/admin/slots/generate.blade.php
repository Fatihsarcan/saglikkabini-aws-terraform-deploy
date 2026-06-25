@extends('layouts.admin')

@section('title', 'Slot Üret')

@section('content')
<h4 class="mb-4">Randevu Slotu Üret</h4>

<div class="card shadow-sm p-4" style="max-width:600px;">
    <form method="POST" action="{{ route('admin.slots.generate') }}">
        @csrf

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $e) <div>{{ $e }}</div> @endforeach
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">Doktor</label>
            <select name="doctor_id" class="form-select" required>
                <option value="">-- Seçin --</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                        {{ $doctor->name }} ({{ $doctor->specialty }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-6">
                <label class="form-label">Başlangıç Tarihi</label>
                <input type="date" name="date_from" class="form-control"
                       value="{{ old('date_from', now()->addDay()->format('Y-m-d')) }}"
                       min="{{ now()->format('Y-m-d') }}" required>
            </div>
            <div class="col-6">
                <label class="form-label">Bitiş Tarihi</label>
                <input type="date" name="date_to" class="form-control"
                       value="{{ old('date_to', now()->addDays(7)->format('Y-m-d')) }}" required>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-6">
                <label class="form-label">Başlangıç Saati</label>
                <input type="time" name="start_time" class="form-control"
                       value="{{ old('start_time', '09:00') }}" required>
            </div>
            <div class="col-6">
                <label class="form-label">Bitiş Saati</label>
                <input type="time" name="end_time" class="form-control"
                       value="{{ old('end_time', '17:00') }}" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Aralık (dakika)</label>
            <select name="interval_minutes" class="form-select">
                <option value="15" {{ old('interval_minutes') == 15 ? 'selected' : '' }}>15 dakika</option>
                <option value="30" {{ old('interval_minutes', 30) == 30 ? 'selected' : '' }}>30 dakika</option>
                <option value="60" {{ old('interval_minutes') == 60 ? 'selected' : '' }}>60 dakika</option>
            </select>
        </div>

        <p class="text-muted small"><i class="bi bi-info-circle"></i> Hafta sonları atlanır. Var olan slotlar tekrar oluşturulmaz.</p>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-lightning-charge"></i> Slotları Oluştur
        </button>
    </form>
</div>
@endsection
