@extends('layouts.admin')

@section('title', 'Doktor Düzenle')

@section('content')
<h4 class="mb-4">Doktor Düzenle — {{ $doctor->name }}</h4>

<div class="card shadow-sm p-4" style="max-width:600px;">
    <form method="POST" action="{{ route('admin.doctors.update', $doctor) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.doctors._form')
        <button type="submit" class="btn btn-primary">Güncelle</button>
        <a href="{{ route('admin.doctors.index') }}" class="btn btn-link">Geri</a>
    </form>
</div>
@endsection
