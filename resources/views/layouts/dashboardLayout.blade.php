<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
          integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-800">
{{-- Messages globaux du Dashboard --}}
<div class="max-w-4xl mx-auto mt-4">

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-blue-500 text-white shadow z-2">
            {{ session('success') }}
        </div>
    @endif

    {{-- Message d’erreur --}}
    @if(session('error'))
        <div class="mb-4 p-3 rounded bg-red-500 text-white shadow">
            {{ session('error') }}
        </div>
    @endif

    {{-- Erreurs de validation --}}
    @if ($errors->any())
        <div class="mb-4 p-3 rounded bg-red-600 text-white shadow">
            <strong>Veuillez corriger les erreurs suivantes :</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</div>
<div id="app">
    <main class="">
        <div class="flex flex-row w-full h-screen">
            <div class="flex flex-col w-1/5">
                @include('components.navbarDashboard')
            </div>
            <div class="flex w-full max-h-screen bg-gray-900">
                @yield('content')
            </div>
        </div>
    </main>
</div>
</body>
</html>
