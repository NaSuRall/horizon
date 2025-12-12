@extends("layouts.app")

@section("content")

    @include("components.navbarSite")

    <div class="flex flex-col w-full h-full pt-10">
        <!-- Responsive layout -->
        <section class="flex flex-col md:flex-row w-full h-full p-4 md:p-10 gap-4">

            <!-- Sidebar -->
            <aside class="w-full md:w-1/4 bg-gray-800 text-white rounded-lg p-4 space-y-6 max-h-[90vh] overflow-y-auto">
                <form method="GET" action="{{ route('site.show.produits') }}" class="flex flex-col gap-6">
                    <h2 class="text-lg font-semibold">Filtres</h2>

                    <!-- Recherche -->
                    <div>
                        <label for="search" class="block text-sm mb-1">Rechercher</label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                               placeholder="Nom du produit..."
                               class="w-full border p-2 rounded-lg text-black bg-white"/>
                    </div>

                    <!-- Prix -->
                    <div>
                        <h3 class="text-sm font-semibold mb-2">Prix</h3>
                        <div class="flex gap-2">
                            <input type="number" id="price_min" name="price_min" value="{{ request('price_min') }}"
                                   placeholder="Min" class="w-1/2 border p-2 rounded-lg text-black bg-white"/>
                            <input type="number" id="price_max" name="price_max" value="{{ request('price_max') }}"
                                   placeholder="Max" class="w-1/2 border p-2 rounded-lg text-black bg-white"/>
                        </div>
                    </div>

                    <!-- Marques -->
                    <div>
                        <h3 class="text-sm font-semibold mb-2">Marques</h3>
                        <div class="space-y-1 max-h-32 overflow-y-auto">
                            @foreach($marques as $marque)
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="marques[]" value="{{ $marque->id }}"
                                           @checked(in_array($marque->id, request('marques', [])))
                                           class="form-checkbox h-4 w-4 text-blue-600">
                                    <span>{{ $marque->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Catégories -->
                    <div>
                        <h3 class="text-sm font-semibold mb-2">Catégories</h3>
                        <div class="space-y-1 max-h-40 overflow-y-auto">
                            @foreach($categories as $cat)
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="categories[]" value="{{ $cat->id }}"
                                           @checked(in_array($cat->id, request('categories', [])))
                                           class="form-checkbox h-4 w-4 text-blue-600">
                                    <span>{{ $cat->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Bouton appliquer -->
                    <button type="submit" class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600">
                        Appliquer les filtres
                    </button>
                </form>
            </aside>
            <!-- Produits -->
            <main class="flex-1 bg-gray-700 rounded-lg p-4 md:p-6 overflow-y-auto">
                <p class="text-sm text-red-500 mb-2">⚠️ Attention : Les produits ne sont pas tous affichés directement sur le site. Veuillez vous rendre en magasin ou nous contacter pour en savoir plus sur votre demande.</p>
                <h2 class="text-lg text-gray-200 mb-4">Produits disponibles</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($produits as $produit)
                        <div class="bg-gray-800 text-white rounded-lg shadow p-4 flex flex-col cursor-pointer"
                             onclick="document.getElementById('image-modal-{{ $produit->id }}').classList.remove('hidden')">

                            <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->name }}"
                                 class="w-full h-full object-cover rounded mb-3">

                            <h3 class="text-lg font-semibold">{{ $produit->name }}</h3>
                            <p class="mt-2 font-bold text-red-500">{{ $produit->price }} €</p>
                            <p class="text-sm">Marque : {{ $produit->marque->name ?? '-' }}</p>
                            <div class="flex flex-wrap gap-1 mt-2">
                                @foreach($produit->categories as $cat)
                                    <span class="bg-gray-600 px-2 py-1 rounded text-xs">{{ $cat->name }}</span>
                                @endforeach
                            </div>
                        </div>

                        <!-- Modal image -->
                        <div id="image-modal-{{ $produit->id }}"
                             class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-50"
                             onclick="this.classList.add('hidden')">

                            <div class="relative bg-white rounded-lg shadow-lg max-w-4xl w-full p-6 flex gap-6"
                                 onclick="event.stopPropagation()">

                                <!-- Bouton fermer -->
                                <button onclick="document.getElementById('image-modal-{{ $produit->id }}').classList.add('hidden')"
                                        class="absolute top-3 right-3 text-gray-600 hover:text-black text-2xl">
                                    <i class="fa-solid fa-x"></i>
                                </button>

                                <!-- Colonne gauche : images -->
                                <div class="flex-1 flex flex-col gap-4">
                                    @foreach($produit->images ?? [$produit->image] as $img)
                                        <img src="{{ asset('storage/' . $img) }}" alt="{{ $produit->name }}"
                                             class="w-full h-full object-cover rounded-lg shadow">
                                    @endforeach
                                </div>

                                <!-- Colonne droite : infos produit -->
                                <div class="flex-1 flex flex-col justify-center">
                                    <h2 class="text-2xl font-bold mb-2">{{ $produit->name }}</h2>
                                    <p class="text-red-600 text-xl font-semibold mb-4">{{ $produit->price }} €</p>
                                    <p class="text-gray-700 mb-4">{{ $produit->description }}</p>
                                    <p class="text-sm text-gray-500 mb-2">Marque : {{ $produit->marque->name ?? '-' }}</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($produit->categories as $cat)
                                            <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded text-xs">{{ $cat->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $produits->links() }}
                </div>
            </main>
        </section>
    </div>

    @include('components.footer')
@endsection
