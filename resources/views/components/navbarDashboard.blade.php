<aside class="flex flex-col w-full h-full p-4 bg-gray-800 text-white items-center">
    <div class="flex flex-col w-full h-full justify-between items-center gap-5">
        <div class="flex flex-col border-b w-full items-center">
            <img src="{{ asset('img/horizonmoto.png') }}" alt="" class="w-40 h-full pb-5">
        </div>
        <div class="flex flex-col text-sm w-full h-full gap-3 items-center">
            <div class="flex flex-row items-start justify-start">
                <p class="text-gray-400 text-sm">Liens Admin </p>
            </div>
            <a href="{{ route('dashboard') }}"
               class="flex items-center justify-start gap-2 px-3 py-2 rounded-xl w-full
          {{ request()->routeIs('dashboard') ? 'bg-red-600 text-white' : '' }}">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>

            <a href=""
               class="flex items-center justify-start gap-2 px-3 py-2 rounded-xl w-full
          {{ request()->routeIs('produits.*') ? 'bg-red-600 text-white' : '' }}">
                <i class="fa-solid fa-basket-shopping"></i> Produits
            </a>

            <a href="{{ route('categories.index') }}"
               class="flex items-center justify-start gap-2 px-3 py-2 rounded-xl w-full
          {{ request()->routeIs('categories.*') ? 'bg-red-600 text-white' : '' }}">
                <i class="fa-solid fa-list"></i> Categories
            </a>

            <a href=""
               class="flex items-center justify-start gap-2 px-3 py-2 rounded-xl w-full
          {{ request()->routeIs('users.*') ? 'bg-red-600 text-white' : '' }}">
                <i class="fa-solid fa-users"></i> Utilisateurs
            </a>

            <a href="{{ route('marques.index') }}"
               class="flex items-center justify-start gap-2 px-3 py-2 rounded-xl w-full
          {{ request()->routeIs('marques.*') ? 'bg-red-600 text-white' : '' }}">
                <i class="fa-solid fa-tag"></i> Marques
            </a>

        </div>
    </div>
    <div class="flex border-t w-full items-center text-sm  justify-center p-2">
        <a href="">Retour Au site</a>
    </div>
</aside>
