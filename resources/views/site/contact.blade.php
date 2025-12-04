@extends('layouts.app')

@section('content')
    @include("components.navbarSite")
    <section class="flex flex-col lg:flex-row w-full h-auto bg-gray-900 text-white px-10 py-16 gap-10 pt-40">
        <!-- Image à gauche -->
        <div class="w-full lg:w-1/2 flex items-center justify-center">
            <img src="{{ asset('img/horizonmoto.png') }}" alt="Contact Horizon Moto" class="rounded-xl shadow-lg object-cover w-full h-96">
        </div>

        <!-- Formulaire à droite -->
        <div class="w-full lg:w-1/2 bg-gray-800 rounded-xl shadow-lg p-8">
            <h2 class="text-3xl font-bold mb-6">Nous contacter</h2>
            <form action="" method="POST" class="flex flex-col gap-4">
                @csrf
                <!-- Nom -->
                <div>
                    <label for="name" class="block text-sm mb-2">Nom</label>
                    <input type="text" id="name" name="name"
                           class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-red-500"
                           required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm mb-2">Email</label>
                    <input type="email" id="email" name="email"
                           class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-red-500"
                           required>
                </div>

                <!-- Message -->
                <div>
                    <label for="message" class="block text-sm mb-2">Message</label>
                    <textarea id="message" name="message" rows="5"
                              class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-red-500"
                              required></textarea>
                </div>

                <!-- Bouton -->
                <button type="submit"
                        class="px-6 py-3 bg-red-600 rounded-lg hover:bg-red-700 transition font-semibold">
                    Envoyer
                </button>
            </form>
        </div>
    </section>
    @include("components.footer")

@endsection
