@extends("layouts.app")

@section('content')

    @include('components.navbarSite')

    <div class="flex flex-col w-full h-full m-0 p-0 bg-gray-900 text-white">

        <!-- Header -->
        <header class="relative flex w-full h-[60vh] items-center justify-center overflow-hidden">
            <video autoplay muted loop class="absolute top-0 left-0 w-full h-full object-cover">
                <source src="{{ asset('videos/header.mp4') }}" type="video/mp4">
                Votre navigateur ne supporte pas la vidéo en arrière-plan.
            </video>
            <div class="absolute top-0 left-0 w-full h-full bg-black/50"></div>
            <div class="relative z-10 text-center">
                <h1 class="text-5xl font-bold mb-4">Présentation de Horizon Moto</h1>
                <p class="text-lg">Votre partenaire passion moto à Saint-Ouen-l’Aumône</p>
            </div>
        </header>

        <!-- Section Présentation -->
        <section class="px-10 py-16 text-center">
            <h2 class="text-3xl font-bold mb-6">Qui sommes-nous ?</h2>
            <p class="max-w-4xl mx-auto text-gray-300 leading-relaxed">
                Chez <span class="text-red-500 font-semibold">Horizon Moto</span>, nous mettons la passion et l’expertise au service des motards.
                Situés à Saint-Ouen-l’Aumône (95310), nous proposons une large gamme de motos, accessoires et équipements.
                Notre équipe vous accompagne dans vos choix, que vous soyez débutant ou pilote confirmé.
            </p>
        </section>

        <!-- Valeurs -->
        <section class="px-10 py-16 bg-gray-800">
            <h2 class="text-3xl font-bold text-center mb-10">Nos valeurs</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="p-6 bg-gray-700 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4">Passion</h3>
                    <p class="text-gray-300">Nous vivons et respirons moto, et partageons cette passion avec nos clients.</p>
                </div>
                <div class="p-6 bg-gray-700 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4">Expertise</h3>
                    <p class="text-gray-300">Notre équipe est composée de professionnels expérimentés, prêts à vous conseiller.</p>
                </div>
                <div class="p-6 bg-gray-700 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4">Confiance</h3>
                    <p class="text-gray-300">Nous privilégions la transparence et la satisfaction de nos clients.</p>
                </div>
            </div>
        </section>




        <!-- Footer -->
        @include('components.footer')
    </div>
@endsection
