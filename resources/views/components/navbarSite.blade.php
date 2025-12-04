<nav class="flex flex-row w-full h-[80px] bg-gray-900
    justify-between fixed z-200 ">

    <div class="flex flex-row w-full items-center justify-center">
        <img src="{{ asset("img/horizonmoto.png") }}" class="w-36" alt="">
    </div>

    <div class="flex flex-row gap-5 items-center w-full text-white">
        <a href="{{ route('accueil') }}" class="text-sm hover:text-red-600 transition-all">Accueil</a>
        <a href="{{ route('site.about') }}" class="text-sm hover:text-red-600 transition-all">Présentation</a>
        <a href="{{ route('site.show.produits') }}" class="text-sm hover:text-red-600 transition-all">Produits</a>
        <a href="" class="text-sm hover:text-red-600 transition-all">Article</a>
        <a href="" class="text-sm hover:text-red-600 transition-all">Visite 3d</a>
        <a href="{{ route('site.contact') }}" class="text-sm hover:text-red-600 transition-all">Contact</a>
    </div>

    <div class="flex w-[90%] items-center justify-center text-white">
        <span class="text-sm hover:scale-125 transition-all">06 40 53 58 27</span>
    </div>

</nav>
