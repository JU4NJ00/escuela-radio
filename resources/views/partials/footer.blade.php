
<footer class="bg-gray-900 text-gray-300 py-12 border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Contenedor principal --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Columna 1: Escuela --}}
            <div>
                <h3 class="text-lg font-bold text-white mb-4 border-b border-gray-700 pb-2">
                    ESCUELA N.º 952
                </h3>
                <p class="text-sm leading-relaxed">
                    "Domingo Faustino Sarmiento"<br>
                    El Lucero, San Cristóbal, Santa Fe
                </p>
                <ul class="mt-4 space-y-2 text-sm">
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Ruta Provincial 38
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.774a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z">
                            </path>
                        </svg>
                        Teléfono: 03408 429973
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                        escuela952.el@gmail.com
                    </li>
                </ul>
            </div>

            {{-- Columna 2: APAER --}}
            <div>
                <h3 class="text-lg font-bold text-white mb-4 border-b border-gray-700 pb-2">
                    APAER
                </h3>
                <p class="text-sm leading-relaxed">
                    Asociación de Padrinos y Alumnos de Escuelas Rurales.
                    Apoya a los maestros para que los alumnos de escuelas rurales terminen su escolaridad obligatoria.
                </p>
                <ul class="mt-4 space-y-2 text-sm">
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.774a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z">
                            </path>
                        </svg>
                        Teléfonos: 4788-5423 / 4788-3009
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                        info@apaer.org.ar
                    </li>
                </ul>
                <div class="flex space-x-4 mt-4 text-sm">
                    <a href="https://www.apaer.org.ar" target="_blank" class="hover:text-white">Web</a>
                    <a href="https://www.apaer.blogspot.com.ar" target="_blank" class="hover:text-white">Blog</a>
                    <a href="https://www.facebook.com/apaeroficial" target="_blank" class="hover:text-white">Facebook</a>
                </div>
            </div>

            {{-- Columna 3: Mapa --}}
            <div>
                <h3 class="text-lg font-bold text-white mb-4 border-b border-gray-700 pb-2">
                    Ubicación
                </h3>
                <div class="w-full h-48 bg-gray-800 rounded-md overflow-hidden border border-gray-700">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d525606.6934448639!2d-61.015372369704835!3d-30.066254586807514!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sESCUELA%20NRO%20952!5e0!3m2!1ses-419!2sar!4v1758567657550!5m2!1ses-419!2sar"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>

        {{-- Línea y copyright --}}
        <div class="mt-10 pt-6 border-t border-gray-700 text-center text-xs sm:text-sm text-gray-400">
            <p>&copy; {{ date('Y') }} Escuela 952 "Domingo Faustino Sarmiento". Todos los derechos reservados.</p>
        </div>
    </div>
</footer>
