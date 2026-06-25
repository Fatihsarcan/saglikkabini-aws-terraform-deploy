@extends('layouts.admin')

@section('title', 'Yeni Doktor')

@section('content')
<h4 class="mb-4">Yeni Doktor Ekle</h4>

<div class="card shadow-sm p-4" style="max-width:600px;">
    <form method="POST" action="{{ route('admin.doctors.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.doctors._form')
        <button type="submit" class="btn btn-primary">Kaydet</button>
        <a href="{{ route('admin.doctors.index') }}" class="btn btn-link">Geri</a>
    </form>
</div>
@endsection
