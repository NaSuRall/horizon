<footer class="bg-gray-900 text-gray-300 px-10 py-12 mt-10">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Bloc 1 : Logo / Présentation -->
        <div>
            <img class="w-30 mb-4" src="{{ asset('img/horizonmoto.png') }}" alt="">
            <h3 class="text-xl font-bold text-white mb-4">Horizon Moto</h3>
            <p class="text-sm">
                Rendez-nous visite à Saint-Ouen-l'Aumône et découvrez un lieu 100% dédié aux motards.
            </p>
        </div>

        <!-- Bloc 2 : Liens rapides -->
        <div>
            <h3 class="text-xl font-bold text-white mb-4">Liens utiles</h3>
            <ul class="space-y-2">
                <li><a href="{{ route('accueil') }}" class="hover:text-red-500 transition text-sm">Accueil</a></li>
                <li><a href="{{ route('site.about') }}" class="hover:text-red-500 transition text-sm">Présentation</a></li>
                <li><a href="{{ route('site.show.produits') }}" class="hover:text-red-500 transition text-sm">Produits</a></li>
                <li><a href="{{ route('actualites.show') }}" class="hover:text-red-500 transition text-sm">Actualités</a></li>
                <li><a href="{{ route('site.contact') }}" class="hover:text-red-500 transition text-sm">Contact</a></li>
                <li><a href="{{ route('site.mentions') }}" class="hover:text-red-500 transition text-sm">Mentions Légales</a></li>
                <li><a href="{{ route('site.politique') }}" class="hover:text-red-500 transition text-sm">Politiques Confidentialité</a></li>
                <li><a href="" class=" text-gray-600 transition text-sm">Visite 3d</a></li>
            </ul>
        </div>


        <!-- Bloc 3 : Marques partenaires -->
        <div>
            <h3 class="text-xl font-bold text-white mb-4">Marques partenaires</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="https://www.horizonrc.fr/" target="_blank" class="hover:text-red-500">Horizon Racing Cergy (95) </a></li>
                <li><a href="https://moto.suzuki.fr/" target="_blank" class="hover:text-red-500">Suzuki</a></li>
                <li><a href="https://www.ktm.com/fr-fr.html" target="_blank" class="hover:text-red-500">KTM</a></li>
                <li><a href="https://www.motoplex-piaggio.com/" target="_blank" class="hover:text-red-500">Motoplex</a></li>
                <li><a href="https://www.espacek.com/" target="_blank" class="hover:text-red-500">Espace K (Kawasaki)</a></li>
                <li><a href="https://www.maxxess.fr/" target="_blank" class="hover:text-red-500">Maxxess</a></li>
            </ul>
        </div>


        <!-- Bloc 3 : Réseaux sociaux -->
        <div>
            <h3 class="text-xl font-bold text-white mb-4">Suivez-nous</h3>
            <div class="flex gap-4">
                <a href="{{ env('FACKBOOK_LINK') }}" target="_blank"
                   class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-600 hover:bg-blue-700 transition">
                    <i class="fa-brands fa-facebook"></i>
                </a>
                <a href="{{ env('INSTA_LINK') }}" target="_blank"
                   class="w-10 h-10 flex items-center justify-center rounded-full bg-red-600 hover:bg-red-700 transition">
                    <i class="fa-brands fa-instagram text-white"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Ligne du bas -->
    <div class="border-t border-gray-700 mt-10 pt-6 text-center text-sm text-gray-500">
        © {{ date('Y') }} Horizon Moto - Tous droits réservés
    </div>
</footer>
