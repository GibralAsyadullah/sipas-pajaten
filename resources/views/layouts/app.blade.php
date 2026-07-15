<!DOCTYPE html>
<html lang="id"@auth data-admin="1"@endauth>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#0F3D28">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'SIPAS Pajaten') — Sistem Edukasi Pengelolaan Sampah · KKN Cibuaya 2026</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Fredoka:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script>/* cegah intro muncul lagi saat pindah halaman (jalan sebelum render) */
try{if(sessionStorage.getItem('sipas-splash')==='1'){document.documentElement.classList.add('no-splash')}}catch(e){}</script>
</head>
<body>
<div class="leaf-bg" aria-hidden="true"></div>

@include('partials.splash')
@include('partials.header')
@include('partials.navbar')

<main class="shell">
@yield('content')
@include('partials.footer')
</main>

@include('partials.modals')

<script>
window.SIPAS_ITEMS = @json($sipasItems ?? []);
window.SIPAS_QUIZ  = @json($sipasQuiz ?? []);
window.SIPAS_URLS  = { paparan: @json(route('paparan')) };
</script>
<script src="{{ asset('js/data.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
