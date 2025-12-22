@extends('layouts.dashboardLayout')

@section("content")

    <section class="flex flex-col w-full h-full p-3 ">

        @if(session('success'))
            <div class="alert alert-success text-green-200 bg-green-600/20 p-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-row justify-between p-2">
            <h2 class="text-lg text-gray-400 ">Categories</h2>

            <div class="flex gap-3">
                <!-- Bouton créer catégorie -->
                <button
                    onclick="document.getElementById('modal-marque').classList.remove('hidden')"
                    class="flex items-center gap-3 justify-center px-3 py-2 bg-green-300 outline-none border-none rounded-lg"
                ><i class="fa-solid fa-plus"></i> Créer une catégorie</button>

                <!-- Bouton créer sous-catégorie -->
                <button
                    onclick="document.getElementById('modal-sous-categorie').classList.remove('hidden')"
                    class="flex items-center gap-3 justify-center px-3 py-2 bg-blue-300 outline-none border-none rounded-lg"
                ><i class="fa-solid fa-plus"></i> Créer une sous-catégorie</button>
            </div>
        </div>
        <div class="flex flex-col w-full h-full bg-gray-700 rounded-lg p-6 gap-4">

            <form action="" class="flex flex-row gap-2">
                <div class="relative w-full max-w-md">
                    <input type="text" placeholder="Rechercher..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none bg-white">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"></i>
                </div>
                <button type="Submit" class="px-2 py-1 text-sm bg-white rounded-lg"><i class="fa-solid fa-paper-plane"></i></button>
            </form>

            <div class="overflow-x-auto rounded-lg max-h-full">
                <table class="w-full text-base ">
                    <thead>
                    <tr>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">Nom</th>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">Date création</th>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $categorie)
                        <tr class="bg-gray-800 text-white">
                            <td class="p-3 text-center flex items-center justify-between gap-2">
                                <div class="flex items-center justify-center gap-2">
                                    @if($categorie->children->count() > 0)
                                        <button
                                            onclick="toggleChildren({{ $categorie->id }})"
                                            class="px-2 py-1 bg-gray-600 rounded hover:bg-gray-500"
                                        >
                                            <i class="fa-solid fa-chevron-down"></i>
                                        </button>
                                    @endif

                                    <span class="flex items-center justify-center text-center">{{ $categorie->name }}</span>
                                </div>
                            </td>

                            <td class="p-3 text-center">{{ $categorie->created_at }}</td>

                            <td class="flex flex-row items-center justify-center p-3 text-center gap-2">
                                <!-- Modifier parent -->
                                <button
                                    onclick="document.getElementById('modal-edit-{{ $categorie->id }}').classList.remove('hidden')"
                                    class="text-sm bg-blue-500 p-2 rounded-lg"
                                >
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>

                                <!-- Supprimer parent -->
                                <a href="{{ route('categories.delete', $categorie->id) }}"
                                   class="text-sm bg-red-600 text-black p-2 rounded-lg">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                        {{-- Sous-catégories dépliables --}}
                        @if($categorie->children->count() > 0)
                            <tr id="children-{{ $categorie->id }}" class="hidden bg-gray-800 text-white">
                                <td colspan="3" class="p-4">
                                    <div class="bg-gray-900 rounded-lg p-4 border border-gray-700">
                                        <h4 class="text-gray-300 font-semibold mb-3 flex items-center gap-2">
                                            <i class="fa-solid fa-sitemap"></i>
                                            Sous-catégories
                                        </h4>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                            @foreach($categorie->children as $child)
                                                <div class="flex items-center justify-between bg-gray-700 p-3 rounded-lg shadow-sm hover:bg-gray-600 transition">

                                                    <div class="flex items-center gap-3">
                                                        <i class="fa-solid fa-tag text-gray-300"></i>
                                                        <span class="font-medium">{{ $child->name }}</span>
                                                    </div>

                                                    <div class="flex gap-2">
                                                        <!-- Modifier enfant -->
                                                        <button
                                                            onclick="document.getElementById('modal-edit-{{ $child->id }}').classList.remove('hidden')"
                                                            class="text-sm bg-blue-500 p-2 rounded-lg hover:bg-blue-400 transition"
                                                        >
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>

                                                        <!-- Supprimer enfant -->
                                                        <a href="{{ route('categories.delete', $child->id) }}"
                                                           class="text-sm bg-red-600 p-2 rounded-lg hover:bg-red-500 transition">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </div>

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginations TailwindCSS -->
            <div class="mt-4 ">
                {{ $categories->links() }}
            </div>

            <!-- Modal create Marque -->
            <div id="modal-marque" class="hidden fixed inset-0 bg-black/40 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
                    <button
                        onclick="document.getElementById('modal-marque').classList.add('hidden')"
                        class="absolute top-3 right-3 text-gray-600 hover:text-black">
                        <i class="fa-solid fa-x"></i>
                    </button>
                    <h2 class="text-xl font-semibold mb-4">Créer une Categorie</h2>
                    <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="text" name="name" placeholder="Nom de la categorie" class="w-full border p-2 rounded-lg"/>
                        <button type="submit" class="w-full bg-gray-900 text-white py-2 rounded-lg hover:bg-gray-800">
                            Submit
                        </button>
                    </form>
                </div>
            </div>

            <!-- Modal create Sous-Categorie -->
            <div id="modal-sous-categorie" class="hidden fixed inset-0 bg-black/40 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
                    <button
                        onclick="document.getElementById('modal-sous-categorie').classList.add('hidden')"
                        class="absolute top-3 right-3 text-gray-600 hover:text-black">
                        <i class="fa-solid fa-x"></i>
                    </button>

                    <h2 class="text-xl font-semibold mb-4">Créer une sous-catégorie</h2>

                    <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <!-- Nom -->
                        <input type="text" name="name" placeholder="Nom de la sous-catégorie"
                               class="w-full border p-2 rounded-lg"/>

                        <!-- Choix de la catégorie parente -->
                        <select name="parent_id" class="w-full border p-2 rounded-lg">
                            <option value="">Sélectionner une catégorie </option>
                            @foreach($categories->where('parent_id', null) as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach

                        </select>

                        <button type="submit" class="w-full bg-gray-900 text-white py-2 rounded-lg hover:bg-gray-800">
                            Créer
                        </button>
                    </form>
                </div>
            </div>

            <!-- Modal Edit Category -->
            <!-- Modal Edit Category -->
            @foreach($allCategories as $cat)
                <div id="modal-edit-{{ $cat->id }}"
                     class="hidden fixed inset-0 bg-black/40 flex text-black items-center justify-center z-50">

                    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
                        <button
                            onclick="document.getElementById('modal-edit-{{ $cat->id }}').classList.add('hidden')"
                            class="absolute top-3 right-3 text-gray-600 hover:text-black">
                            <i class="fa-solid fa-x"></i>
                        </button>

                        <h2 class="text-xl font-semibold mb-4">Modifier la catégorie</h2>

                        <form action="{{ route('categories.update', $cat->id) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <!-- Nom -->
                            <input type="text"
                                   name="name"
                                   value="{{ $cat->name }}"
                                   class="w-full border p-2 rounded-lg"/>


                            <button type="submit"
                                    class="w-full bg-gray-900 text-white py-2 rounded-lg hover:bg-gray-800">
                                Modifier
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
@endsection
<script>
    function toggleChildren(id) {
        const row = document.getElementById('children-' + id);
        row.classList.toggle('hidden');
    }
</script>
