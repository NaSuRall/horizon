@extends('layouts.dashboardLayout')

@section("content")
    <section class="flex flex-col w-full h-full p-3 ">
        <div class="flex flex-row justify-between p-2">
            <h2 class="text-lg text-gray-400">Activités</h2>
        </div>

        <div class="flex flex-col w-full h-full bg-gray-700 rounded-lg p-6 gap-4">

            <!-- Barre de recherche -->
            <form action="" class="flex flex-row gap-2">
                <div class="relative w-full max-w-md">
                    <input type="text" placeholder="Rechercher une activité..."
                           class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none bg-white">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"></i>
                </div>
                <button type="submit" class="px-2 py-1 text-sm bg-white rounded-lg">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>

            <!-- Tableau des activités -->
            <div class="overflow-x-auto rounded-lg max-h-full">
                <table class="w-full text-base">
                    <thead>
                    <tr>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">Type</th>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">Action</th>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">Utilisateur</th>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">Date</th>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($activities as $activity)
                        <tr class="bg-gray-800 text-white">
                            <td class="p-3 text-center">{{ ucfirst($activity->type) }}</td>
                            <td class="p-3 text-center">{{ $activity->action }}</td>
                            <td class="p-3 text-center">
                                {{ $activity->user->name ?? 'Système' }}
                            </td>
                            <td class="p-3 text-center">
                                {{ $activity->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="p-3 text-center">{{ $activity->description }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $activities->links() }}
            </div>
        </div>
    </section>
@endsection
