<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Sağlık Kabini</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { display: flex; min-height: 100vh; }
        #sidebar { width: 240px; min-height: 100vh; background: #1a1a2e; flex-shrink: 0; }
        #sidebar .nav-link { color: #adb5bd; }
        #sidebar .nav-link:hover, #sidebar .nav-link.active { color: #fff; background: rgba(255,255,255,.1); border-radius: 6px; }
        #sidebar .brand { color: #fff; font-weight: 700; font-size: 1.1rem; }
        #content { flex: 1; background: #f8f9fa; }
    </style>
</head>
<body>
<div id="sidebar" class="p-3 d-flex flex-column">
    <div class="brand mb-4"><i class="bi bi-hospital"></i> Sağlık Kabini</div>
    <nav class="nav flex-column gap-1">
        <a class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-speedometer2 me-2"></i>Dashboard
        </a>
        <a class="nav-link @if(request()->routeIs('admin.doctors.*')) active @endif" href="{{ route('admin.doctors.index') }}">
            <i class="bi bi-person-badge me-2"></i>Doktorlar
        </a>
        <a class="nav-link @if(request()->routeIs('admin.slots.*')) active @endif" href="{{ route('admin.slots.form') }}">
            <i class="bi bi-clock me-2"></i>Slot Üret
        </a>
        <a class="nav-link @if(request()->routeIs('admin.appointments.*')) active @endif" href="{{ route('admin.appointments.index') }}">
            <i class="bi bi-calendar-check me-2"></i>Randevular
        </a>
    </nav>
    <div class="mt-auto">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-outline-light btn-sm w-100" type="submit">Çıkış Yap</button>
        </form>
    </div>
</div>
<div id="content" class="p-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
