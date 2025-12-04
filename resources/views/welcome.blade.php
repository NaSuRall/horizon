@extends("layouts.app")

@section('content')

    @include('components.navbarSite')

    <div class="flex flex-col w-full h-full m-0 p-0 bg-gray-800">

        <header class="relative flex w-full h-screen gap-6  text-white flex-col items-center justify-center overflow-hidden">
            <!-- Vidéo en arrière-plan -->
            <video autoplay muted loop class="absolute top-0 left-0 w-full h-full object-cover">
                <source src="{{ asset("videos/header.mp4") }}" type="video/mp4">
                Votre navigateur ne supporte pas la vidéo en arrière-plan.
            </video>

            <!-- Overlay sombre pour lisibilité -->
            <div class="absolute top-0 left-0 w-full h-full bg-black/50"></div>

            <!-- Contenu du header -->
            <div class="relative z-10 flex flex-col items-center justify-center gap-6">
                <h1 class="text-5xl font-bold">Bienvenue chez Horizon Moto</h1>
                <p class="text-sm">Situé à Saint-Ouen-l'Aumône, 95310 !</p>
                <button class="px-6 py-2 rounded-xl bg-red-600 text-sm hover:bg-red-700 transition">
                    En savoir plus...
                </button>
            </div>
        </header>

        <section class="relative flex w-full h-20 p-6 overflow-hidden mt-5 ">
            <!-- Piste qui défile -->
            <div class="flex animate-marquee whitespace-nowrap">
                <!-- Première série -->
                <img src="{{ asset('img/ESPACEK.jpg') }}" class="h-full mx-6 inline-block" alt="">
                <img src="{{ asset('img/honda.svg') }}" class="h-full mx-6 inline-block" alt="">
                <img src="{{ asset('img/maxess.png') }}" class="h-full mx-6 inline-block" alt="">
                <img src="{{ asset('img/MOTOPLEX.jpg') }}" class="h-full mx-6 inline-block" alt="">
                <img src="{{ asset('img/suzuki.svg') }}" class="h-full mx-6 inline-block" alt="">

                <!-- Deuxième série identique (pour l’effet infini) -->
                <img src="{{ asset('img/ESPACEK.jpg') }}" class="h-full mx-6 inline-block" alt="">
                <img src="{{ asset('img/honda.svg') }}" class="h-full mx-6 inline-block" alt="">
                <img src="{{ asset('img/maxess.png') }}" class="h-full mx-6 inline-block" alt="">
                <img src="{{ asset('img/MOTOPLEX.jpg') }}" class="h-full mx-6 inline-block" alt="">
                <img src="{{ asset('img/suzuki.svg') }}" class="h-full mx-6 inline-block" alt="">
            </div>
        </section>

        <section class="flex flex-col w-full h-full px-10 py-16 bg-gray-800 text-white">
            <h2 class="text-3xl font-bold mb-10 text-center">Nos Produits</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($produits as $produit)
                    <!-- Carte produit -->
                    <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden flex flex-col">
                        <img src="{{ asset('img/produit1.jpg') }}" alt="Produit 1" class="h-48 w-full object-cover">
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-semibold mb-2">{{ $produit->name }}</h3>
                            <p class="text-sm text-gray-400 mb-1">{{ $produit->ref }}</p>
                            <p class="text-lg font-bold text-red-500 mb-4">{{ $produit->price }}</p>
                            <button class="mt-auto px-4 py-2 bg-red-600 rounded-lg hover:bg-red-700 transition">
                                En savoir plus
                            </button>
                        </div>
                    </div>

                @empty
                    <div class="flex text-center items-center justify-center w-full"></div>
                    <div class="flex text-center items-center justify-center w-full">
                        <p>Pas de produits Disponible sur le site web </p>
                    </div>
                    <div class="flex text-center items-center justify-center w-full"></div>
                @endforelse
            </div>
        </section>

        <section class="flex flex-col lg:flex-row w-full h-auto bg-gray-800 text-white px-10 py-16 gap-10">
            <!-- Bloc gauche : Carte -->
            <div class="w-full  h-96 rounded-xl overflow-hidden shadow-lg">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2614.703803659302!2d2.116883876772681!3d49.054255171359536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e65f85b6c9ddd7%3A0x16017c0e046b395f!2sMaxxess%20Horizon%20Moto!5e0!3m2!1sfr!2sfr!4v1764864000635!5m2!1sfr!2sfr"
                    width="600"
                    height="450"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

            <!-- Bloc droit : Infos & Réseaux -->
            <div class="flex flex-col w-full  justify-center items-start gap-6">
                <h2 class="text-3xl font-bold">Nous retrouver</h2>
                <p class="text-gray-300">Venez nous voir directement en magasin à Saint-Ouen-l’Aumône.</p>
                <p class="text-red-600">Rue :  11 rue d'epluches (95310) </p>
                <p class="text-gray-300">5 min a pied de la gare d'Epluches </p>



                <div class="flex gap-4 mt-4">
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/" target="_blank"
                       class="px-4 py-2 bg-blue-600 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M22 12..."/></svg>
                        Facebook
                    </a>
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/" target="_blank"
                       class="px-4 py-2 bg-pink-600 rounded-lg hover:bg-pink-700 transition flex items-center gap-2">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2.2..."/></svg>
                        Instagram
                    </a>

                </div>
            </div>
        </section>

    </div>

    @include('components.footer')

@endsection
