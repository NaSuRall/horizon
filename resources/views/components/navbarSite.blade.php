<nav class="flex items-center justify-between w-full h-[80px] bg-gray-900 px-4 fixed top-0 left-0 z-50">
    <!-- Logo -->
    <div class="flex items-center">
        <img src="{{ asset('img/horizonmoto.png') }}" class="w-28 sm:w-36" alt="Horizon Moto">
    </div>

    <!-- Menu desktop -->
    <div class="hidden md:flex gap-6 items-center text-white">
        <a href="{{ route('accueil') }}" class="text-sm hover:text-red-600 transition">Accueil</a>
        <a href="{{ route('site.about') }}" class="text-sm hover:text-red-600 transition">Présentation</a>
        <a href="{{ route('site.show.produits') }}" class="text-sm hover:text-red-600 transition">Produits</a>
        <a href="#" class="text-sm hover:text-red-600 transition">Article</a>
        <a href="#" class="text-sm hover:text-red-600 transition">Visite 3D</a>
        <a href="{{ route('site.contact') }}" class="text-sm hover:text-red-600 transition">Contact</a>
    </div>

    <!-- Téléphone (desktop uniquement) -->
    <div class="hidden md:flex items-center text-white">
        <span class="text-sm hover:scale-110 transition">01 39 09 96 16</span>
    </div>

    <!-- Bouton burger (mobile) -->
    <div class="md:hidden flex items-center">
        <button id="burger-btn" class="text-white focus:outline-none">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path id="burger-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>
</nav>

<!-- Menu mobile avec animation -->
<div id="mobile-menu"
     class="fixed top-[80px] left-0 w-full bg-gray-900 text-white flex flex-col gap-4 px-6 py-6 z-40
            transform -translate-y-full opacity-0 transition-all duration-300 ease-in-out">
    <a href="{{ route('accueil') }}" class="hover:text-red-600">Accueil</a>
    <a href="{{ route('site.about') }}" class="hover:text-red-600">Présentation</a>
    <a href="{{ route('site.show.produits') }}" class="hover:text-red-600">Produits</a>
    <a href="#" class="hover:text-red-600">Article</a>
    <a href="#" class="hover:text-red-600">Visite 3D</a>
    <a href="{{ route('site.contact') }}" class="hover:text-red-600">Contact</a>
    <span class="mt-4 text-sm">📞 01 39 09 96 16</span>
</div>

<script>
    const burgerBtn = document.getElementById('burger-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    let menuOpen = false;

    burgerBtn.addEventListener('click', () => {
        menuOpen = !menuOpen;
        if (menuOpen) {
            mobileMenu.classList.remove('-translate-y-full', 'opacity-0');
            mobileMenu.classList.add('translate-y-0', 'opacity-100');
        } else {
            mobileMenu.classList.remove('translate-y-0', 'opacity-100');
            mobileMenu.classList.add('-translate-y-full', 'opacity-0');
        }
    });
</script>
