@extends('layouts.dashboardLayout')

@section('content')
    <div class="flex flex-col w-full max-h-full">
        <div class="px-6 py-3">
            <h2 class="text-3xl text-white ">Bonjour {{ auth()->user()->name }} 👋</h2>
        </div>

        <section class="grid grid-cols-5 grid-rows-5 gap-4 w-full h-[90%]  p-6">
            <div class="col-span-2 row-span-2 bg-gray-700 rounded-lg  overflow-hidden">
                <div class="flex flex-row w-full justify-between items-center border-b pb-2 p-2">
                    <h2 class="flex text-xl items-center justify-center text-white"> Marques</h2>
                    <i class="fa-solid fa-arrow-up-right-from-square text-gray-500 text-lg hover:text-gray-300 transition-all duration-100 hover:translate-x-0.5 hover:-translate-y-1"></i>
                </div>
                <div class="relative p-6 h-full overflow-hidden">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2 gap-6 overflow-hidden">
                        @foreach($marques as $marque)
                            <div class="bg-gray-700 text-white rounded-lg p-4 shadow hover:shadow-lg transition overflow-hidden">
                                <h3 class="font-semibold text-lg mb-2">{{ $marque->name }}</h3>
                                <p class="text-gray-300">{{ $marque->description }}</p>
                            </div>
                        @endforeach
                    </div>
                    <!-- Dégradé flou -->
                    <div class="pointer-events-none absolute bottom-0 left-0 w-full h-25 bg-gradient-to-t from-gray-900 to-transparent"></div>
                </div>


            </div>
            <div class="col-span-2 row-span-2 col-start-3 bg-gray-700 rounded-lg"></div>
            <div class="row-span-6 col-start-5 bg-gray-700 rounded-lg"></div>
            <div class="col-span-2 row-span-4 row-start-3 bg-gray-700 rounded-lg"></div>
            <div class="col-span-2 row-span-4 col-start-3 row-start-3 bg-gray-700 rounded-lg"></div>
        </section>
    </div>
@endsection
