@extends("layouts.app")

@section('content')

    @include('components.navbarSite')

    <div class="flex flex-col w-full h-full m-0 p-0 bg-gray-800">

        <!-- Header -->
        <header class="relative flex w-full min-h-screen text-white flex-col items-center justify-center overflow-hidden">
            <!-- Vidéo -->
            <video autoplay muted loop class="absolute top-0 left-0 w-full h-full object-cover">
                <source src="{{ asset("videos/header.mp4") }}" type="video/mp4">
                Votre navigateur ne supporte pas la vidéo en arrière-plan.
            </video>

            <!-- Overlay -->
            <div class="absolute top-0 left-0 w-full h-full bg-black/50"></div>

            <!-- Contenu -->
            <div class="relative z-10 flex flex-col items-center justify-center gap-6 px-4 text-center">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold">Bienvenue chez Horizon Moto</h1>
                <p class="text-xs sm:text-sm lg:text-base max-w-xl">
                    Rendez-nous visite à Saint-Ouen-l'Aumône et découvrez un lieu 100% dédié aux motards.
                </p>
                <button class="px-4 sm:px-6 py-2 rounded-xl bg-red-600 text-xs sm:text-sm hover:bg-red-700 transition">
                    En savoir plus...
                </button>
            </div>
        </header>

        <!-- Logos défilants -->
        <section class="relative flex w-full h-16 sm:h-20 p-4 sm:p-6 overflow-hidden mt-5">
            <div class="flex animate-marquee whitespace-nowrap">
                <img src="{{ asset('img/ESPACEK.jpg') }}" class="h-full mx-4 sm:mx-6 inline-block" alt="">
                <img src="{{ asset('img/honda.svg') }}" class="h-full mx-4 sm:mx-6 inline-block" alt="">
                <img src="{{ asset('img/maxess.png') }}" class="h-full mx-4 sm:mx-6 inline-block" alt="">
                <img src="{{ asset('img/MOTOPLEX.jpg') }}" class="h-full mx-4 sm:mx-6 inline-block" alt="">
                <img src="{{ asset('img/suzuki.svg') }}" class="h-full mx-4 sm:mx-6 inline-block" alt="">
                <!-- Copie pour effet infini -->
                <img src="{{ asset('img/ESPACEK.jpg') }}" class="h-full mx-4 sm:mx-6 inline-block" alt="">
                <img src="{{ asset('img/honda.svg') }}" class="h-full mx-4 sm:mx-6 inline-block" alt="">
                <img src="{{ asset('img/maxess.png') }}" class="h-full mx-4 sm:mx-6 inline-block" alt="">
                <img src="{{ asset('img/MOTOPLEX.jpg') }}" class="h-full mx-4 sm:mx-6 inline-block" alt="">
                <img src="{{ asset('img/suzuki.svg') }}" class="h-full mx-4 sm:mx-6 inline-block" alt="">
            </div>
        </section>

        <!-- Produits -->
        <section class="flex flex-col w-full h-full px-4 sm:px-10 py-10 sm:py-16 bg-gray-800 text-white">
            <h2 class="text-2xl sm:text-3xl font-bold mb-8 sm:mb-10 text-center">Nos Produits</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @forelse($produits as $produit)
                    <div class="bg-gray-900 rounded-xl shadow-lg overflow-hidden flex flex-col">
                        <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->name }}" class="w-full h-48 sm:h-64 object-cover">
                        <div class="p-4 sm:p-6 flex flex-col flex-grow">
                            <h3 class="text-lg sm:text-xl font-semibold mb-2">{{ $produit->name }}</h3>
                            <p class="text-xs sm:text-sm text-gray-400 mb-1">{{ $produit->ref }}</p>
                            <p class="text-base sm:text-lg font-bold text-red-500 mb-4">{{ $produit->price }} €</p>
                            <a href="{{ route('site.show.produits') }}" class="mt-auto px-3 sm:px-4 py-2 text-center bg-red-600 rounded-lg hover:bg-red-700 transition text-xs sm:text-sm">
                                En savoir plus
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="flex text-center items-center justify-center w-full">
                        <p>Pas de produits disponibles sur le site web</p>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Carte + Infos -->
        <section class="flex flex-col lg:flex-row w-full h-auto bg-gray-800 text-white px-4 sm:px-10 py-10 sm:py-16 gap-8 lg:gap-10">
            <!-- Carte -->
            <div class="w-full lg:w-1/2 rounded-xl overflow-hidden shadow-lg">

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3374.6986184773705!2d2.1193524584707246!3d49.0541152714713!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e65f85b6c9ddd7%3A0x16017c0e046b395f!2sMaxxess%20Horizon%20Moto!5e0!3m2!1sfr!2sfr!4v1765188987063!5m2!1sfr!2sfr"
                        class="w-full h-72 sm:h-96 lg:h-[500px] rounded-lg"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

            <!-- Infos -->
            <div class="flex flex-col w-full lg:w-1/2 justify-center items-start gap-4 sm:gap-6">
                <h2 class="text-2xl sm:text-3xl font-bold">Nous retrouver</h2>
                <p class="text-gray-300">Venez nous voir directement en magasin à Saint-Ouen-l’Aumône.</p>
                <p class="text-red-600">Rue : 11 rue d'epluches (95310)</p>
                <p class="text-gray-300">5 min à pied de la gare d'Epluches</p>

                <div class="flex flex-wrap gap-4 mt-4">
                    <a href="https://www.facebook.com/" target="_blank"
                       class="px-3 sm:px-4 py-2 bg-blue-600 rounded-lg hover:bg-blue-700 transition flex items-center gap-2 text-xs sm:text-sm">
                        Facebook
                    </a>
                    <a href="https://www.instagram.com/" target="_blank"
                       class="px-3 sm:px-4 py-2 bg-pink-600 rounded-lg hover:bg-pink-700 transition flex items-center gap-2 text-xs sm:text-sm">
                        Instagram
                    </a>
                </div>

                <h2 class="text-xl sm:text-2xl font-bold">Nos Horaires</h2>
                <p class="text-sm sm:text-base">
                    Lundi - Vendredi: 9h30 - 12h30 / 14h00 - 19h00 <br>
                    Samedi: 10h00 - 12h30 / 14h00 - 18h30 <br>
                    Dimanche: <span class="text-red-500">Fermé</span>
                </p>
            </div>
        </section>

    </div>

    @include('components.footer')

@endsection
