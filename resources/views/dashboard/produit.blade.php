@extends("layouts.dashboardLayout")

@section("content")
    <section class="flex flex-col w-full h-full p-3 ">
        <div class="flex flex-row justify-between p-2">
            <h2 class="text-lg text-gray-400 ">Produits</h2>
            <button
                onclick="document.getElementById('modal-produit').classList.remove('hidden')"
                class="flex items-center gap-3 justify-center px-3 py-2 bg-green-300 outline-none border-none rounded-lg"
            ><i class="fa-solid fa-plus"></i> Crée un produit</button>
        </div>

        <div class="flex flex-col w-full h-full bg-gray-700 rounded-lg p-6 gap-4">

            <!-- Search -->
            <form action="" class="flex flex-row gap-2">
                <div class="relative w-full max-w-md">
                    <input type="text" placeholder="Rechercher..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none bg-white">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"></i>
                </div>
                <button type="Submit" class="px-2 py-1 text-sm bg-white rounded-lg"><i class="fa-solid fa-paper-plane"></i></button>
            </form>

            <!-- Table -->
            <div class="overflow-x-auto rounded-lg max-h-full">
                <table class="w-full text-base ">
                    <thead>
                    <tr>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">Nom</th>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">Description</th>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">Ref</th>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">Prix</th>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">Marque</th>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">Catégories</th>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">Date création</th>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($produits as $produit)
                        <tr class="bg-gray-800 text-white">
                            <td class="p-3 text-center">{{ $produit->name }}</td>
                            <td class="p-3 text-center">{{ $produit->description }}</td>
                            <td class="p-3 text-center">{{ $produit->ref }}</td>
                            <td class="p-3 text-center">{{ $produit->price }} €</td>
                            <td class="p-3 text-center">{{ $produit->marque->name ?? '-' }}</td>
                            <td class="p-3 text-center">
                                @foreach($produit->categories as $cat)
                                    <span class="bg-gray-600 px-2 py-1 rounded">{{ $cat->name }}</span>
                                @endforeach
                            </td>
                            <td class="p-3 text-center">{{ $produit->created_at }}</td>
                            <td class="flex flex-row items-center justify-center p-3 text-center gap-2">
                                <!-- Edit -->
                                <button onclick="document.getElementById('modal-{{ $produit->id }}').classList.remove('hidden')"
                                        class="text-sm bg-blue-500 p-2 rounded-lg">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>

                                <!-- Modal Edit -->
                                <div id="modal-{{ $produit->id }}" class="hidden fixed inset-0 bg-black/40 flex text-black items-center justify-center z-50">
                                    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
                                        <button
                                            onclick="document.getElementById('modal-{{ $produit->id }}').classList.add('hidden')"
                                            class="absolute top-3 right-3 text-gray-600 hover:text-black">
                                            <i class="fa-solid fa-x"></i>
                                        </button>
                                        <h2 class="text-xl font-semibold mb-4">Modifier le produit</h2>
                                        <form action="{{  route('produits.update', $produit->id)  }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                            @csrf
                                            @method('PUT')
                                            <input type="text" name="name" value="{{ $produit->name }}" class="w-full border p-2 rounded-lg"/>
                                            <textarea name="description" class="w-full border p-2 rounded-lg">{{ $produit->description }}</textarea>
                                            <input type="text" name="ref" value="{{ $produit->ref }}" class="w-full border p-2 rounded-lg"/>
                                            <input type="number" step="0.01" name="price" value="{{ $produit->price }}" class="w-full border p-2 rounded-lg"/>
                                            <input type="file" name="image" class="w-full border p-2 rounded-lg"/>
                                            <select name="marque_id" class="w-full border p-2 rounded-lg">
                                                @foreach($marques as $marque)
                                                    <option value="{{ $marque->id }}" @if($produit->marque_id == $marque->id) selected @endif>{{ $marque->name }}</option>
                                                @endforeach
                                            </select>
                                            <select name="categories[]" multiple class="w-full border p-2 rounded-lg">
                                                @foreach($categories as $cat)
                                                    <option value="{{ $cat->id }}" @if($produit->categories->contains($cat->id)) selected @endif>{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="w-full bg-gray-900 text-white py-2 rounded-lg hover:bg-gray-800">
                                                Modifier
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Delete -->
                                <form action="{{ route('produits.delete', $produit->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm bg-red-600 text-black p-2 rounded-lg">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4 ">
                {{ $produits->links() }}
            </div>

            <!-- Modal create Produit -->
            <div id="modal-produit" class="hidden fixed inset-0 bg-black/40 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative
                max-h-[90vh] overflow-y-auto"> <!-- 👈 limite la hauteur et ajoute le scroll -->

                    <!-- Bouton fermer -->
                    <button
                        onclick="document.getElementById('modal-produit').classList.add('hidden')"
                        class="absolute top-3 right-3 text-gray-600 hover:text-black">
                        <i class="fa-solid fa-x"></i>
                    </button>

                    <h2 class="text-xl font-semibold mb-4">Créer un produit</h2>

                    <form action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        <!-- Nom -->
                        <label for="name" class="block text-sm font-medium text-gray-700">Nom du produit</label>
                        <input type="text" id="name" name="name" placeholder="Nom du produit" class="w-full border p-2 rounded-lg"/>

                        <!-- Description -->
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="description" name="description" placeholder="Description" class="w-full border p-2 rounded-lg"></textarea>

                        <!-- Référence -->
                        <label for="ref" class="block text-sm font-medium text-gray-700">Référence</label>
                        <input type="text" id="ref" name="ref" placeholder="Référence" class="w-full border p-2 rounded-lg"/>

                        <!-- Prix -->
                        <label for="price" class="block text-sm font-medium text-gray-700">Prix (€)</label>
                        <input type="number" step="0.01" id="price" name="price" placeholder="Prix" class="w-full border p-2 rounded-lg"/>

                        <!-- Image -->
                        <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" id="image" name="image" class="w-full border p-2 rounded-lg"/>

                        <!-- Marque -->
                        <label for="marque_id" class="block text-sm font-medium text-gray-700">Marque</label>
                        <select id="marque_id" name="marque_id" class="w-full border p-2 rounded-lg">
                            @foreach($marques as $marque)
                                <option value="{{ $marque->id }}">{{ $marque->name }}</option>
                            @endforeach
                        </select>

                        <!-- Catégories (checkboxes) -->
                        <label class="block text-sm font-medium text-gray-700">Catégories</label>
                        <div class="flex flex-col gap-2 max-h-40 overflow-y-auto border rounded-lg p-2">
                            @foreach($categories as $cat)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="categories[]" value="{{ $cat->id }}" class="form-checkbox h-4 w-4 text-blue-600">
                                    <span class="ml-2">{{ $cat->name }}</span>
                                </label>
                            @endforeach
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="w-full bg-gray-900 text-white py-2 rounded-lg hover:bg-gray-800">
                            Créer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
