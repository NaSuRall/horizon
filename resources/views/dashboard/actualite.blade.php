@extends('layouts.dashboardLayout')

@section("content")
    <section class="flex flex-col w-full h-full p-3 ">
        <div class="flex flex-row justify-between p-2">
            <h2 class="text-lg text-gray-400">Actualités</h2>
            <button
                onclick="document.getElementById('modal-actualite').classList.remove('hidden')"
                class="flex items-center gap-3 justify-center px-3 py-2 bg-green-300 outline-none border-none rounded-lg"
            >
                <i class="fa-solid fa-plus"></i> Créer une actualité
            </button>
        </div>

        <div class="flex flex-col w-full h-full bg-gray-700 rounded-lg p-6 gap-4">

            <!-- Barre de recherche -->
            <form action="" class="flex flex-row gap-2">
                <div class="relative w-full max-w-md">
                    <input type="text" placeholder="Rechercher une actualité..."
                           class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none bg-white">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"></i>
                </div>
                <button type="submit" class="px-2 py-1 text-sm bg-white rounded-lg">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>

            <!-- Tableau des actualités -->
            <div class="overflow-x-auto rounded-lg max-h-full">
                <table class="w-full text-base">
                    <thead>
                    <tr>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">Titre</th>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">Date création</th>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($actualites as $actu)
                        <tr class="bg-gray-800 text-white">
                            <td class="p-3 text-center">{{ $actu->titre }}</td>
                            <td class="p-3 text-center">{{ $actu->created_at->format('d/m/Y H:i') }}</td>
                            <td class="flex flex-row items-center justify-center p-3 text-center gap-2">
                                <!-- Bouton Edit -->
                                <button onclick="document.getElementById('modal-{{ $actu->id }}').classList.remove('hidden')"
                                        class="text-sm bg-blue-500 p-2 rounded-lg">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>

                                <!-- Modal Edit -->
                                <div id="modal-{{ $actu->id }}" class="hidden fixed inset-0 bg-black/40 flex text-black items-center justify-center z-50">
                                    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
                                        <button
                                            onclick="document.getElementById('modal-{{ $actu->id }}').classList.add('hidden')"
                                            class="absolute top-3 right-3 text-gray-600 hover:text-black">
                                            <i class="fa-solid fa-x"></i>
                                        </button>
                                        <h2 class="text-xl font-semibold mb-4">Modifier l’actualité</h2>
                                        <form action="{{ route('actualites.update', $actu->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                            @csrf
                                            @method('PUT')
                                            <input type="text" name="titre" value="{{ $actu->titre }}" class="w-full border p-2 rounded-lg"/>
                                            <textarea name="contenu" class="w-full border p-2 rounded-lg">{{ $actu->contenu }}</textarea>
                                            <input type="file" name="image" class="w-full border p-2 rounded-lg"/>
                                            <button type="submit" class="w-full bg-gray-900 text-white py-2 rounded-lg hover:bg-gray-800">
                                                Modifier
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Bouton Delete -->
                                <a href="{{ route('actualites.delete', $actu->id) }}"
                                   class="text-sm bg-red-600 text-black p-2 rounded-lg">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $actualites->links() }}
            </div>

            <!-- Modal create Actualité -->
            <!-- Modal create Actualité -->
            <div id="modal-actualite" class="hidden fixed inset-0 bg-black/40 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
                    <button
                        onclick="document.getElementById('modal-actualite').classList.add('hidden')"
                        class="absolute top-3 right-3 text-gray-600 hover:text-black">
                        <i class="fa-solid fa-x"></i>
                    </button>
                    <h2 class="text-xl font-semibold mb-4">Créer une actualité</h2>

                    <form action="{{ route('actualites.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        <!-- Champ titre -->
                        <div>
                            <input type="text" name="titre" placeholder="Titre de l’actualité"
                                   value="{{ old('titre') }}"
                                   class="w-full border p-2 rounded-lg @error('titre') border-red-500 @enderror"/>
                            @error('titre')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Champ contenu (textarea plus grand + limite 500 caractères) -->
                        <div>
                <textarea name="contenu" placeholder="Contenu de l’actualité (max 500 caractères)"
                          rows="6" maxlength="500"
                          class="w-full border p-2 rounded-lg @error('contenu') border-red-500 @enderror">{{ old('contenu') }}</textarea>
                            @error('contenu')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">500 caractères maximum</p>
                        </div>

                        <!-- Champ image -->
                        <div>
                            <input type="file" id="image" name="image"
                                   class="w-full border p-2 rounded-lg @error('image') border-red-500 @enderror"/>
                            @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bouton submit -->
                        <button type="submit" class="w-full bg-gray-900 text-white py-2 rounded-lg hover:bg-gray-800">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
