@extends('layouts.app')

@section('content')
        @include("components.navbarSite")

    <div class="flex flex-col w-full min-h-screen p-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Actualités du magasin</h2>

        <!-- Liste des actualités -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($actualites as $actu)
                <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col">
                    <!-- Image -->
                    @if($actu->image)
                        <img src="{{ asset('storage/'.$actu->image) }}" alt="{{ $actu->titre }}" class="h-48 w-full object-cover">
                    @else
                        <div class="h-48 w-full bg-gray-300 flex items-center justify-center text-gray-600">
                            <i class="fa-solid fa-newspaper text-4xl"></i>
                        </div>
                    @endif

                    <!-- Contenu -->
                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">{{ $actu->titre }}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $actu->contenu }}</p>

                        <div class="mt-auto flex justify-between items-center text-sm text-gray-500">
                            <span>{{ $actu->created_at->format('d/m/Y') }}</span>
                            <a href="{{ route('actualites.show', $actu->id) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                                Lire plus →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $actualites->links() }}
        </div>
    </div>

    @include('components.footer')
@endsection
