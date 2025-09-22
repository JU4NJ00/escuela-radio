<footer class="bg-gray-900 text-gray-300 py-12 border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Contenedor principal del pie de página --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Columna 1: Información de la Escuela --}}
            <div class="mb-6 md:mb-0">
                <h3 class="text-lg font-bold text-white mb-4 border-b border-gray-700 pb-2">
                    ESCUELA NRO 952
                </h3>
                <p class="text-sm">
                    "Domingo Faustino Sarmiento" <br>
                    El Lucero, San Cristóbal, Santa Fe
                </p>
                <div class="mt-4 space-y-2 text-sm">
                    <p class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        RUTA PROVINCIAL 38
                    </p>
                    <p class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.774a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z">
                            </path>
                        </svg>
                        Teléfono: 03408 429973
                    </p>
                    <p class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                        Mail: prim952_aguaragrande@santafe.edu.ar
                    </p>
                </div>
            </div>

            {{-- Columna 2: Información de APAER --}}
            <div class="mb-6 md:mb-0">
                <h3 class="text-lg font-bold text-white mb-4 border-b border-gray-700 pb-2">
                    APAER
                </h3>
                <p class="text-sm leading-relaxed">
                    Asociación de Padrinos y Alumnos de Escuelas Rurales. Apoya a los maestros para que los alumnos de
                    escuelas rurales terminen su escolaridad obligatoria.
                </p>
                <div class="mt-4 space-y-2 text-sm">
                    <p class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.774a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z">
                            </path>
                        </svg>
                        Teléfonos: 4788-5423 / 4788-3009
                    </p>
                    <p class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                        Mail: info@apaer.org.ar
                    </p>
                    <div class="flex space-x-4 mt-2">
                        <a href="https://www.apaer.org.ar" target="_blank"
                            class="hover:text-white transition-colors duration-200">
                            <span class="font-medium">Web</span>
                        </a>
                        <a href="https://www.apaer.blogspot.com.ar" target="_blank"
                            class="hover:text-white transition-colors duration-200">
                            <span class="font-medium">Blog</span>
                        </a>
                        <a href="https://www.facebook.com/apaeroficial" target="_blank"
                            class="hover:text-white transition-colors duration-200">
                            <span class="font-medium">Facebook</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Columna 3: Mapa de la escuela --}}
            <div>
                <h3 class="text-lg font-bold text-white mb-4 border-b border-gray-700 pb-2">
                    Ubicación
                </h3>
                {{-- Aquí va el iframe del mapa. Puedes buscar la ubicación en Google Maps y obtener el código de inserción. --}}
                <div class="w-full h-48 bg-gray-800 rounded-md overflow-hidden border border-gray-700">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d525606.6934448639!2d-61.015372369704835!3d-30.066254586807514!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sESCUELA%20NRO%20952!5e0!3m2!1ses-419!2sar!4v1758567657550!5m2!1ses-419!2sar"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>

        {{-- Línea divisoria y copyright --}}
        <div class="mt-12 pt-8 border-t border-gray-700 text-center text-sm">
            <p>&copy; {{ date('Y') }} Escuela 952 "Domingo Faustino Sarmiento"- Todos los derechos reservados.</p>
        </div>

    </div>
</footer>
