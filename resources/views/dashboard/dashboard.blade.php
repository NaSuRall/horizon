@extends('layouts.dashboardLayout')

@section('content')
    <div class="flex flex-col w-full max-h-full">
        <div class="px-6 py-3">
            <h2 class="text-3xl text-white">Bonjour {{ auth()->user()->name }} 👋</h2>
        </div>

        <section class="grid grid-cols-6 grid-rows-5 gap-4 w-full h-[90%] p-6">
            <!-- Marques -->
            <div class="col-span-2 row-span-2 bg-gray-700 rounded-lg overflow-hidden">
                <div class="flex flex-row w-full justify-between items-center border-b pb-2 p-2">
                    <h2 class="flex text-xl items-center justify-center text-white">Marques</h2>
                    <i class="fa-solid fa-arrow-up-right-from-square text-gray-500 text-lg hover:text-gray-300 transition-all duration-100"></i>
                </div>
                <div class="relative p-6 h-full overflow-hidden">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2 gap-6">
                        @foreach($marques as $marque)
                            <div class="bg-gray-800 text-white rounded-lg p-4 shadow hover:shadow-lg transition">
                                <h3 class="font-semibold text-lg mb-2">{{ $marque->name }}</h3>
                                <p class="text-gray-300">{{ $marque->description }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="pointer-events-none absolute bottom-0 left-0 w-full h-25 bg-gradient-to-t from-gray-900 to-transparent"></div>
                </div>
            </div>

            <!-- Categories -->
            <div class="col-span-2 row-span-2 col-start-3 bg-gray-700 rounded-lg overflow-hidden">
                <div class="flex flex-row w-full justify-between items-center border-b pb-2 p-2">
                    <h2 class="flex text-xl items-center justify-center text-white">Categories</h2>
                    <i class="fa-solid fa-arrow-up-right-from-square text-gray-500 text-lg hover:text-gray-300 transition-all duration-100"></i>
                </div>
                <div class="relative p-6 h-full overflow-hidden">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2 gap-6">
                        @foreach($categories as $categorie)
                            <div class="bg-gray-800 text-white rounded-lg p-4 shadow hover:shadow-lg transition">
                                <h3 class="font-semibold text-lg mb-2">{{ $categorie->name }}</h3>
                            </div>
                        @endforeach
                    </div>
                    <div class="pointer-events-none absolute bottom-0 left-0 w-full h-25 bg-gradient-to-t from-gray-900 to-transparent"></div>
                </div>
            </div>

            <!-- Utilisateurs -->
            <div class="row-span-6 col-start-5 col-end-7 bg-gray-700 rounded-lg overflow-hidden">
                <div class="flex flex-row w-full justify-between items-center border-b pb-2 p-2">
                    <h2 class="flex text-xl items-center justify-center text-white">Utilisateurs</h2>
                </div>
                <div class="p-6 h-full overflow-y-auto divide-y divide-gray-700">
                    @foreach($users as $user)
                        <div class="flex items-center py-3 hover:bg-gray-800 transition">
                            <!-- Avatar -->
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-red-500 flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <!-- Infos -->
                            <div class="ml-4">
                                <h3 class="font-semibold text-sm text-white">{{ $user->name }}</h3>
                                <p class="text-xs text-gray-400">{{ $user->email }}</p>
                            </div>
                            <!-- Badge -->
                            <span class="ml-auto px-2 py-0.5 text-xs rounded-full bg-green-600 text-white">
                    Actif
                </span>
                        </div>
                    @endforeach
                </div>
            </div>




            <!-- Statistiques Produits -->
            <div class="col-span-4 row-span-4 row-start-3 bg-gray-700 h-full rounded-lg overflow-hidden">
                <div class="flex flex-row w-full justify-between items-center border-b pb-2 p-2">
                    <h2 class="flex text-xl items-center justify-center text-white">Statistiques Produits</h2>
                </div>
                <div class="p-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Doughnut Chart -->
                    <div class="bg-gray-800 rounded-lg p-4 flex flex-col items-center">
                        <h3 class="text-white text-lg mb-3">Produits par catégories</h3>
                        <div class="w-full h-64 flex flex-col items-center justify-center"> <!-- conteneur fixe -->
                            <canvas id="produitsDoughnut" class="w-full h-full"></canvas>
                        </div>
                    </div>

                    <!-- Line Chart -->
                    <div class="bg-gray-800 rounded-lg p-4 flex flex-col items-center">
                        <h3 class="text-white text-lg mb-3">Ajouts récents</h3>
                        <div class="w-full h-64"> <!-- conteneur fixe -->
                            <canvas id="produitsLine" class="w-full h-full"></canvas>
                        </div>
                    </div>
                </div>
            </div>


        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Doughnut Chart
        const ctxDoughnut = document.getElementById('produitsDoughnut').getContext('2d');
        new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: @json($categories->pluck('name')),
                datasets: [{
                    data: @json($categories->map(fn($c) => $c->produits->count())),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ],
                    borderColor: '#1f2937',
                    borderWidth: 2
                }]
            },
            options: {
                plugins: {
                    legend: { labels: { color: '#fff' } }
                }
            }
        });


        // Line Chart (nombre de produits ajoutés par jour)
        const ctxLine = document.getElementById('produitsLine').getContext('2d');
        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: @json($produits->groupBy(fn($p) => $p->created_at->format('d/m'))->keys()),
                datasets: [{
                    label: 'Produits ajoutés',
                    data: @json($produits->groupBy(fn($p) => $p->created_at->format('d/m'))->map->count()->values()),
                    fill: true,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    tension: 0.3,
                    pointBackgroundColor: '#fff'
                }]
            },
            options: {
                scales: {
                    x: { ticks: { color: '#fff' } },
                    y: { ticks: { color: '#fff' }, beginAtZero: true }
                },
                plugins: { legend: { labels: { color: '#fff' } } }
            }
        });
    </script>
@endsection
