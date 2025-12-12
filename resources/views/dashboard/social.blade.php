@extends("layouts.dashboardLayout")

@section("content")
    <section class="flex flex-col w-full h-full p-3 ">
        <div class="flex flex-row justify-between p-2">
            <h2 class="text-lg text-gray-400 ">Réseaux</h2>
            <button
                onclick="document.getElementById('modal-social').classList.remove('hidden')"
                class="flex items-center gap-3 justify-center px-3 py-2 bg-green-300 outline-none border-none rounded-lg"
            ><i class="fa-solid fa-plus"></i> Créer un réseau</button>
        </div>

        <div class="flex flex-col w-full h-full bg-gray-700 rounded-lg p-6 gap-4">

            <div class="overflow-x-auto rounded-lg max-h-full">
                <table class="w-full text-base ">
                    <thead>
                    <tr>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">Plateforme</th>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">URL</th>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">Date création</th>
                        <th class="p-3 text-center font-semibold bg-gray-900 text-white">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($socials as $social)
                        <tr class="bg-gray-800 text-white">
                            <td class="p-3 text-center">{{ $social->platform }}</td>
                            <td class="p-3 text-center">
                                <a href="{{ $social->url }}" target="_blank" class="text-blue-400 hover:underline">
                                    {{ $social->url }}
                                </a>
                            </td>
                            <td class="p-3 text-center">{{ $social->created_at }}</td>
                            <td class="flex flex-row items-center justify-center p-3 text-center gap-2">

                                <!-- Edit -->
                                <button onclick="document.getElementById('modal-{{ $social->id }}').classList.remove('hidden')"
                                        class="text-sm bg-blue-500 p-2 rounded-lg">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>

                                <!-- Modal Edit -->
                                <div id="modal-{{ $social->id }}" class="hidden fixed inset-0 bg-black/40 flex text-black items-center justify-center z-50">
                                    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
                                        <button
                                            onclick="document.getElementById('modal-{{ $social->id }}').classList.add('hidden')"
                                            class="absolute top-3 right-3 text-gray-600 hover:text-black">
                                            <i class="fa-solid fa-x"></i>
                                        </button>
                                        <h2 class="text-xl font-semibold mb-4">Modifier le réseau</h2>
                                        <form action="{{ route('socials.update', $social->id) }}" method="POST" class="space-y-4">
                                            @csrf
                                            @method('PUT')
                                            <input type="text" name="platform" value="{{ $social->platform }}" class="w-full border p-2 rounded-lg"/>
                                            <input type="text" name="url" value="{{ $social->url }}" class="w-full border p-2 rounded-lg"/>
                                            <button type="submit" class="w-full bg-gray-900 text-white py-2 rounded-lg hover:bg-gray-800">
                                                Modifier
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Delete -->
                                <form action="{{ route('socials.delete', $social->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce réseau ?');">
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
            <div class="mt-4">
                {{ $socials->links() }}
            </div>

            <!-- Modal create Social -->
            <div id="modal-social" class="hidden fixed inset-0 bg-black/40 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
                    <button
                        onclick="document.getElementById('modal-social').classList.add('hidden')"
                        class="absolute top-3 right-3 text-gray-600 hover:text-black">
                        <i class="fa-solid fa-x"></i>
                    </button>
                    <h2 class="text-xl font-semibold mb-4">Créer un Réseau</h2>
                    <form action="{{ route('socials.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="text" name="platform" placeholder="Nom de la plateforme" class="w-full border p-2 rounded-lg"/>
                        <input type="text" name="url" placeholder="URL" class="w-full border p-2 rounded-lg"/>
                        <button type="submit" class="w-full bg-gray-900 text-white py-2 rounded-lg hover:bg-gray-800">
                            Submit
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection
