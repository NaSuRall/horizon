<footer class="bg-gray-900 text-gray-300 px-10 py-12 mt-10">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Bloc 1 : Logo / Présentation -->
        <div>
            <img class="w-50" src="{{ asset('img/horizonmoto.png') }}" alt="">
            <h3 class="text-xl font-bold text-white mb-4">Horizon Moto</h3>
            <p class="text-sm">
                Passion et expertise au service des motards.<br>
                Situé à Saint-Ouen-l’Aumône (95310).
            </p>
        </div>

        <!-- Bloc 2 : Liens rapides -->
        <div>
            <h3 class="text-xl font-bold text-white mb-4">Liens utiles</h3>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-red-500 transition">Accueil</a></li>
                <li><a href="#" class="hover:text-red-500 transition">Produits</a></li>
                <li><a href="#" class="hover:text-red-500 transition">Nous retrouver</a></li>
                <li><a href="#" class="hover:text-red-500 transition">Contact</a></li>
            </ul>
        </div>

        <!-- Bloc 3 : Réseaux sociaux -->
        <div>
            <h3 class="text-xl font-bold text-white mb-4">Suivez-nous</h3>
            <div class="flex gap-4">
                <a href="https://www.facebook.com/" target="_blank"
                   class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-600 hover:bg-blue-700 transition">
                    <svg class="w-5 h-5 fill-current text-white" viewBox="0 0 24 24"><path d="M22 12..."/></svg>
                </a>
                <a href="https://www.instagram.com/" target="_blank"
                   class="w-10 h-10 flex items-center justify-center rounded-full bg-pink-600 hover:bg-pink-700 transition">
                    <svg class="w-5 h-5 fill-current text-white" viewBox="0 0 24 24"><path d="M12 2.2..."/></svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Ligne du bas -->
    <div class="border-t border-gray-700 mt-10 pt-6 text-center text-sm text-gray-500">
        © {{ date('Y') }} Horizon Moto - Tous droits réservés
    </div>
</footer>
