@extends('layouts.admin')

@section('title', 'Doktorlar')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Doktorlar</h4>
    <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-circle"></i> Yeni Doktor
    </a>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Doktor</th>
                    <th>Uzmanlık</th>
                    <th>Randevu</th>
                    <th>Durum</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($doctors as $doctor)
                <tr>
                    <td class="d-flex align-items-center gap-2">
                        <img src="{{ $doctor->photo_url }}" style="width:36px;height:36px;object-fit:cover;border-radius:50%;" alt="">
                        {{ $doctor->name }}
                    </td>
                    <td>{{ $doctor->specialty }}</td>
                    <td>{{ $doctor->appointments_count }}</td>
                    <td>
                        @if($doctor->is_active)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-secondary">Pasif</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.doctors.edit', $doctor) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.doctors.destroy', $doctor) }}" class="d-inline"
                              onsubmit="return confirm('Bu doktoru silmek istiyor musunuz?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-3">Doktor yok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
