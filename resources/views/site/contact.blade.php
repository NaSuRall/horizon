@extends('layouts.app')

@section('content')
    @include("components.navbarSite")

    <section class="py-24 px-6 bg-gray-900 text-white font-poppins">
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold uppercase">
                <span class="text-red-500">Horizon Moto</span>
            </h2>
            <p class="mt-4 text-lg text-gray-300">
                Une question, un renseignement ou une demande spécifique ? Notre équipe est là pour vous aider.
            </p>
        </div>

        <!-- Container -->
        <div class="flex flex-wrap gap-8 max-w-6xl mx-auto">
            <!-- Infos -->
            <div class="flex-1 min-w-[300px] bg-gray-800 p-6 rounded-lg shadow-lg">
                <h3 class="text-red-500 text-xl font-semibold mb-4">Nos coordonnées</h3>
                <ul class="space-y-3">
                    <li class="flex items-center gap-3">
                        <i class="fa-solid fa-location-dot text-white text-lg"></i>
                        11 Rue d'Epluches, 95310 Saint-Ouen-l’Aumône
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fa-solid fa-phone text-white text-lg"></i>
                        01 39 09 96 16
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fa-solid fa-envelope text-white text-lg"></i>
                        renaud@maxxess.paris
                    </li>
                    <li class="flex items-center gap-3">
                        <p class="text-sm sm:text-base">
                            Lundi - Vendredi: 9h30 - 12h30 / 14h00 - 19h00 <br>
                            Samedi: 10h00 - 12h30 / 14h00 - 18h30 <br>
                            Dimanche: <span class="text-red-500">Fermé</span>
                        </p>
                    </li>
                </ul>

                <!-- Réseaux sociaux -->
                <div class="flex gap-4 mt-6">
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-red-500 hover:bg-red-600 transition transform hover:scale-110">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                </div>
            </div>

            <!-- Formulaire -->
            <div class="flex-1 min-w-[350px] bg-gray-800 p-6 rounded-lg shadow-lg">

                @if(session('success'))
                    <div class="alert alert-success text-green-200 bg-green-600 p-3 rounded-xl">
                        {{ session('success') }}
                    </div>
                @endif

                <h3 class="text-red-500 text-xl font-semibold mb-4">Envoyez-nous un message</h3>

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <input type="text" name="name" placeholder="Votre nom" value="{{ old('name') }}"
                               class="w-full p-3 rounded-lg border border-gray-300 bg-white text-black focus:border-red-500 focus:ring focus:ring-red-200" required>
                    </div>

                    <div>
                        <input type="email" name="email" placeholder="Votre email" value="{{ old('email') }}"
                               class="w-full p-3 rounded-lg border border-gray-300 bg-white text-black focus:border-red-500 focus:ring focus:ring-red-200" required>
                    </div>

                    <div>
                        <input type="text" name="phone" placeholder="Votre téléphone" value="{{ old('phone') }}"
                               class="w-full p-3 rounded-lg border border-gray-300 bg-white text-black focus:border-red-500 focus:ring focus:ring-red-200">
                    </div>

                    <div>
                        <input type="text" name="subject" placeholder="Sujet" value="{{ old('subject') }}"
                               class="w-full p-3 rounded-lg border border-gray-300 bg-white text-black focus:border-red-500 focus:ring focus:ring-red-200">
                    </div>

                    <div>
                    <textarea name="message" placeholder="Votre message..." rows="6" required
                              class="w-full p-3 rounded-lg border border-gray-300 bg-white text-black focus:border-red-500 focus:ring focus:ring-red-200">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit"
                            class="w-full bg-red-500 text-white font-semibold py-3 rounded-lg hover:bg-red-600 transition transform hover:scale-105">
                        Envoyer le message
                    </button>

                    <p class="text-gray-400 text-sm mt-3">
                        Les informations collectées via ce formulaire sont envoyées par e‑mail pour répondre à votre demande.
                    </p>
                </form>
            </div>
        </div>

        <!-- Carte Google -->
        <div class="mt-12 flex justify-center">
            <iframe
                src="https://www.google.com/maps?q=Saint-Ouen-l'Aumône%20Horizon%20Moto&output=embed"
                allowfullscreen=""
                loading="lazy"
                class="w-full md:w-3/4 h-96 rounded-lg shadow-lg border-0">
            </iframe>
        </div>
    </section>

    @include("components.footer")

@endsection
