@extends('layouts.app')

@section('content')
    @include("components.navbarSite")

    <div class="max-w-7xl mx-auto px-6 py-10 mt-20  min-h-screen">

        <!-- Titre de section -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-white">Actualités Horizon Moto</h1>
            <p class="text-gray-600 mt-2">Découvrez les dernières nouvelles et événements de notre magasin</p>
        </div>

        <!-- Grille des actualités -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($actualites as $actu)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col hover:shadow-xl transition-shadow duration-300">
                    <!-- Image -->
                    @if($actu->image)
                        <img src="{{ asset('storage/'.$actu->image) }}" alt="{{ $actu->titre }}" class="h-48 w-full object-cover">
                    @else
                        <div class="h-48 w-full bg-gray-300 flex items-center justify-center text-gray-600">
                            <i class="fa-solid fa-newspaper text-4xl"></i>
                        </div>
                    @endif

                    <!-- Contenu -->
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $actu->titre }}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $actu->contenu }}</p>

                        <div class="mt-auto flex justify-between items-center text-sm text-gray-500">
                            <span>{{ $actu->created_at->format('d/m/Y') }}</span>
                            <button
                                onclick="document.getElementById('modal-{{ $actu->id }}').classList.remove('hidden')"
                                class="text-indigo-600 hover:text-indigo-800 font-medium">
                                Plus d'infos →
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div id="modal-{{ $actu->id }}" class="hidden fixed inset-0 bg-black/60 flex items-center justify-center z-50">
                    <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full p-6 relative">
                        <!-- Bouton fermer -->
                        <button
                            onclick="document.getElementById('modal-{{ $actu->id }}').classList.add('hidden')"
                            class="absolute top-3 right-3 text-gray-600 hover:text-black">
                            <i class="fa-solid fa-x"></i>
                        </button>

                        <!-- Image -->
                        @if($actu->image)
                            <img src="{{ asset('storage/'.$actu->image) }}" alt="{{ $actu->titre }}" class="w-full h-64 object-cover rounded mb-4">
                        @endif

                        <!-- Contenu complet -->
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $actu->titre }}</h2>
                        <p class="text-gray-700 leading-relaxed mb-6">{{ $actu->contenu }}</p>
                        <p class="text-sm text-gray-500">Publié le {{ $actu->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-10 flex justify-center">
            {{ $actualites->links() }}
        </div>
    </div>

    @include("components.footer")
@endsection
