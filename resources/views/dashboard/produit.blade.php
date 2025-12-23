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

                        <!-- Modal Modifier Produit -->
                        <div id="modal-{{ $produit->id }}" class="hidden fixed inset-0 bg-black/40 flex text-black items-center justify-center z-50">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative max-h-[90vh] overflow-y-auto">

                                <button
                                    onclick="document.getElementById('modal-{{ $produit->id }}').classList.add('hidden')"
                                    class="absolute top-3 right-3 text-gray-600 hover:text-black">
                                    <i class="fa-solid fa-x"></i>
                                </button>

                                <h2 class="text-xl font-semibold mb-4">Modifier le produit</h2>

                                <form action="{{ route('produits.update', $produit->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="categories_force" value="1">

                                    <!-- Nom -->
                                    <input type="text" name="name" value="{{ $produit->name }}" class="w-full border p-2 rounded-lg"/>

                                    <!-- Description -->
                                    <textarea name="description" class="w-full border p-2 rounded-lg">{{ $produit->description }}</textarea>

                                    <!-- Référence -->
                                    <input type="text" name="ref" value="{{ $produit->ref }}" class="w-full border p-2 rounded-lg"/>

                                    <!-- Prix -->
                                    <input type="number" step="0.01" name="price" value="{{ $produit->price }}" class="w-full border p-2 rounded-lg"/>

                                    <!-- Image -->
                                    <input type="file" name="image" class="w-full border p-2 rounded-lg"/>

                                    <!-- Marque -->
                                    <select name="marque_id" class="w-full border p-2 rounded-lg">
                                        @foreach($marques as $marque)
                                            <option value="{{ $marque->id }}" @selected($produit->marque_id == $marque->id)>{{ $marque->name }}</option>
                                        @endforeach
                                    </select>

                                    <!-- Catégories -->
                                    <label class="block text-sm font-medium text-gray-700">Catégories</label>

                                    <div class="flex flex-col gap-2 max-h-40 overflow-y-auto border rounded-lg p-2">
                                        @foreach($categories->where('parent_id', null) as $cat)
                                            <div>
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox"
                                                           class="category-checkbox-{{ $produit->id }} h-4 w-4 text-blue-600"
                                                           data-id="{{ $cat->id }}"
                                                           name="categories[]"
                                                           value="{{ $cat->id }}"
                                                        @checked($produit->categories->contains($cat->id))>
                                                    <span class="ml-2 font-semibold">{{ $cat->name }}</span>
                                                </label>
                                                <div id="subcats-{{ $produit->id }}-{{ $cat->id }}" class="ml-6 mt-2 hidden flex flex-col gap-1"></div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <button type="submit" class="w-full bg-gray-900 text-white py-2 rounded-lg hover:bg-gray-800">
                                        Modifier
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4 ">
                {{ $produits->links() }}
            </div>

            <!-- Modal Create Produit -->
            <div id="modal-produit" class="hidden fixed inset-0 bg-black/40 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative max-h-[90vh] overflow-y-auto">

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

                        <!-- Catégories -->
                        <label class="block text-sm font-medium text-gray-700">Catégories</label>
                        <div class="flex flex-col gap-2 max-h-40 overflow-y-auto border rounded-lg p-2">
                            @foreach($categories->where('parent_id', null) as $cat)
                                <div>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox"
                                               class="category-checkbox h-4 w-4 text-blue-600"
                                               data-id="{{ $cat->id }}"
                                               name="categories[]"
                                               value="{{ $cat->id }}">
                                        <span class="ml-2 font-semibold">{{ $cat->name }}</span>
                                    </label>
                                    <div id="subcats-{{ $cat->id }}" class="ml-6 mt-2 hidden flex flex-col gap-1"></div>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="w-full bg-gray-900 text-white py-2 rounded-lg hover:bg-gray-800">
                            Créer
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </section>

    <script>
        const subcategoriesByParent = @json($categories->groupBy('parent_id'));
        const preselected = @json($produits->mapWithKeys(fn($p) => [$p->id => $p->categories->pluck('id')]));

        // Fonction générique pour gérer les sous-catégories
        function handleSubcategories(checkbox, containerId, productId = null) {
            const container = document.getElementById(containerId);
            if (!checkbox.checked) return container.innerHTML = container.classList.add('hidden');

            const parentId = checkbox.dataset.id;
            const subs = subcategoriesByParent[parentId] || [];
            container.innerHTML = subs.length ? subs.map(sub => `
        <label class="inline-flex items-center">
            <input type="checkbox"
                   name="categories[]"
                   value="${sub.id}"
                   class="form-checkbox h-4 w-4 text-blue-600"
                   ${productId && preselected[productId]?.includes(sub.id) ? 'checked' : ''}>
            <span class="ml-2">${sub.name}</span>
        </label>
    `).join('') : '<p class="text-gray-400 text-sm">Aucune sous-catégorie</p>';
            container.classList.remove('hidden');
        }

        // Pour le formulaire de création
        document.querySelectorAll('.category-checkbox').forEach(cb => {
            cb.addEventListener('change', () => handleSubcategories(cb, 'subcats-' + cb.dataset.id));
        });

        // Pour les modals modification
        @foreach($produits as $p)
        document.querySelectorAll('.category-checkbox-{{ $p->id }}').forEach(cb => {
            const containerId = 'subcats-{{ $p->id }}-' + cb.dataset.id;
            cb.addEventListener('change', () => handleSubcategories(cb, containerId, {{ $p->id }}));
            handleSubcategories(cb, containerId, {{ $p->id }}); // initialisation
        });
        @endforeach

        // Reset des sous-catégories décochées au submit
        document.querySelectorAll('form[action*="produits"]').forEach(form => {
            form.addEventListener('submit', () => {
                form.querySelectorAll('[id^="subcats-"]').forEach(c => {
                    if (c.classList.contains('hidden')) c.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
                });
            });
        });
    </script>

@endsection
