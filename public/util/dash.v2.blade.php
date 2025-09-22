<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Escolar Rural</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .hero-pattern {
            background-color: #f0fdf4;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2386efac' fill-opacity='0.2'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .btn-primary {
            background: linear-gradient(to right, #22c55e, #16a34a);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #16a34a, #15803d);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(34, 197, 94, 0.4);
        }

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .carousel-item {
            transition: transform 0.6s ease-in-out;
        }

        .text-lime-600 {
            color: #65a30d;
        }

        .bg-lime-100 {
            background-color: #ecfccb;
        }

        .border-lime-300 {
            border-color: #bef264;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div x-data="{ open: false }" class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-lg sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <i class="fas fa-school text-2xl text-lime-600 mr-2"></i>
                            <span class="text-xl font-bold text-gray-900">Escuela Rural</span>
                        </div>
                        <nav class="hidden md:ml-6 md:flex space-x-4">
                            <a href="#" class="px-3 py-2 text-sm font-medium text-gray-900 hover:text-lime-600">Inicio</a>
                            <a href="#" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-lime-600">Nosotros</a>
                            <a href="#" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-lime-600">Programas</a>
                            <a href="#" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-lime-600">Galería</a>
                            <a href="#" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-lime-600">Contacto</a>
                        </nav>
                    </div>
                    <div class="hidden md:flex items-center">
                        <button class="px-4 py-2 rounded-full text-sm font-semibold text-white btn-primary">
                            Portal Estudiantes
                        </button>
                    </div>
                    <div class="md:hidden flex items-center">
                        <button @click="open = !open" class="text-gray-700 hover:text-lime-600">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div x-show="open" class="md:hidden bg-white border-t border-gray-200">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <a href="#" class="block px-3 py-2 text-base font-medium text-gray-900 hover:text-lime-600">Inicio</a>
                    <a href="#" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-lime-600">Nosotros</a>
                    <a href="#" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-lime-600">Programas</a>
                    <a href="#" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-lime-600">Galería</a>
                    <a href="#" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-lime-600">Contacto</a>
                    <a href="#" class="block px-3 py-2 text-base font-medium text-white btn-primary mt-2 text-center">Portal Estudiantes</a>
                </div>
            </div>
        </header>

        <!-- Contenido Principal -->
        <main class="py-12 hero-pattern">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-16">

                <!-- Sección Principal (Héroe) Mejorada -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden md:flex flex-col lg:flex-row items-center p-8 card-hover">
                    <div class="lg:w-1/2 p-6">
                        <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-lime-100 text-lime-700 mb-4">
                            <i class="fas fa-seedling mr-2"></i> Educación Sostenible
                        </div>
                        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight mb-4">
                            Bienvenidos a Nuestra <span class="text-lime-600">Escuela Rural</span>
                        </h1>
                        <p class="text-lg text-gray-700 leading-relaxed mb-6">
                            Un espacio donde la naturaleza y el aprendizaje se fusionan. En nuestra escuela,
                            creemos en una educación integral que fomenta la curiosidad, el respeto por el
                            entorno y el desarrollo de habilidades para el futuro.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="#" class="inline-flex items-center justify-center px-6 py-3 text-white font-semibold rounded-full btn-primary">
                                <i class="fas fa-book-open mr-2"></i> Conoce más
                            </a>
                            <a href="#" class="inline-flex items-center justify-center px-6 py-3 border border-lime-300 text-lime-600 font-semibold rounded-full hover:bg-lime-50 transition">
                                <i class="fas fa-calendar-alt mr-2"></i> Eventos
                            </a>
                        </div>
                    </div>
                    <div class="lg:w-1/2 mt-6 lg:mt-0 p-6">
                        <div class="relative rounded-2xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                                 alt="Estudiantes en escuela rural" class="w-full h-auto rounded-2xl">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent rounded-2xl"></div>
                            <div class="absolute bottom-4 left-6 text-white">
                                <p class="text-sm">Nuestros estudiantes en actividades al aire libre</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carrusel de Noticias y Eventos -->
                <div x-data="{ currentSlide: 0, slides: 3 }" class="bg-white rounded-2xl shadow-xl p-8 card-hover">
                    <h2 class="text-3xl font-bold text-gray-900 text-center mb-2">Noticias y <span class="text-lime-600">Eventos</span></h2>
                    <p class="text-gray-600 text-center mb-8">Mantente informado sobre las últimas novedades de nuestra escuela</p>

                    <div class="relative overflow-hidden rounded-xl">
                        <div class="flex transition-transform duration-500 ease-in-out"
                             :style="'transform: translateX(-' + currentSlide * 100 + '%)'">
                            <!-- Slide 1 -->
                            <div class="w-full flex-shrink-0">
                                <div class="md:flex items-stretch bg-lime-50 rounded-xl overflow-hidden">
                                    <div class="md:w-1/3">
                                        <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80"
                                             alt="Evento escolar" class="w-full h-full object-cover">
                                    </div>
                                    <div class="md:w-2/3 p-6">
                                        <span class="inline-block px-3 py-1 bg-lime-100 text-lime-700 rounded-full text-sm font-medium mb-4">Evento</span>
                                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Feria de Ciencias 2023</h3>
                                        <p class="text-gray-700 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at mauris vel dolor tempor venenatis. Proin efficitur justo nec finibus malesuada. Nulla facilisi.</p>
                                        <div class="flex items-center text-gray-600">
                                            <i class="far fa-calendar-alt mr-2 text-lime-600"></i>
                                            <span>15 de Noviembre, 2023</span>
                                            <i class="far fa-clock ml-4 mr-2 text-lime-600"></i>
                                            <span>9:00 AM - 2:00 PM</span>
                                        </div>
                                        <a href="#" class="inline-flex items-center mt-4 text-lime-600 font-medium hover:text-lime-700">
                                            Ver detalles <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 2 -->
                            <div class="w-full flex-shrink-0">
                                <div class="md:flex items-stretch bg-lime-50 rounded-xl overflow-hidden">
                                    <div class="md:w-1/3">
                                        <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80"
                                             alt="Noticia escolar" class="w-full h-full object-cover">
                                    </div>
                                    <div class="md:w-2/3 p-6">
                                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium mb-4">Noticia</span>
                                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Nuevo Laboratorio de Computación</h3>
                                        <p class="text-gray-700 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at mauris vel dolor tempor venenatis. Proin efficitur justo nec finibus malesuada. Nulla facilisi.</p>
                                        <div class="flex items-center text-gray-600">
                                            <i class="far fa-calendar-alt mr-2 text-lime-600"></i>
                                            <span>5 de Noviembre, 2023</span>
                                        </div>
                                        <a href="#" class="inline-flex items-center mt-4 text-lime-600 font-medium hover:text-lime-700">
                                            Leer más <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Slide 3 -->
                            <div class="w-full flex-shrink-0">
                                <div class="md:flex items-stretch bg-lime-50 rounded-xl overflow-hidden">
                                    <div class="md:w-1/3">
                                        <img src="https://images.unsplash.com/photo-1460518451285-97b6aa326961?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80"
                                             alt="Logro escolar" class="w-full h-full object-cover">
                                    </div>
                                    <div class="md:w-2/3 p-6">
                                        <span class="inline-block px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-sm font-medium mb-4">Logro</span>
                                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Ganadores del Concurso Regional</h3>
                                        <p class="text-gray-700 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at mauris vel dolor tempor venenatis. Proin efficitur justo nec finibus malesuada. Nulla facilisi.</p>
                                        <div class="flex items-center text-gray-600">
                                            <i class="far fa-calendar-alt mr-2 text-lime-600"></i>
                                            <span>28 de Octubre, 2023</span>
                                        </div>
                                        <a href="#" class="inline-flex items-center mt-4 text-lime-600 font-medium hover:text-lime-700">
                                            Ver galería <i class="fas fa-arrow-right ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Controles del carrusel -->
                        <button @click="currentSlide = (currentSlide - 1 + slides) % slides"
                                class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white/80 text-lime-600 p-2 rounded-full shadow-md hover:bg-white">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button @click="currentSlide = (currentSlide + 1) % slides"
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white/80 text-lime-600 p-2 rounded-full shadow-md hover:bg-white">
                            <i class="fas fa-chevron-right"></i>
                        </button>

                        <!-- Indicadores -->
                        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                            <template x-for="i in slides">
                                <button @click="currentSlide = i - 1"
                                        class="w-3 h-3 rounded-full"
                                        :class="{'bg-lime-600': currentSlide === i - 1, 'bg-gray-300': currentSlide !== i - 1}">
                                </button>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Sección de Misión y Valores Mejorada -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white p-8 rounded-2xl shadow-xl card-hover">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-lime-100 text-lime-600 rounded-2xl mb-6">
                            <i class="fas fa-bullseye text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Nuestra Misión</h3>
                        <p class="text-gray-700 mb-4">
                            Formar a los líderes del mañana con una educación de calidad que valora
                            el trabajo en equipo, la creatividad y la conexión con el medio ambiente.
                        </p>
                        <p class="text-gray-600">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at mauris vel dolor tempor venenatis.
                            Proin efficitur justo nec finibus malesuada. Nulla facilisi. Phasellus vehicula nisi eu nunc aliquam,
                            sit amet convallis nisi tincidunt.
                        </p>
                    </div>
                    <div class="bg-white p-8 rounded-2xl shadow-xl card-hover">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-lime-100 text-lime-600 rounded-2xl mb-6">
                            <i class="fas fa-heart text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Nuestros Valores</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-lime-600 mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Respeto y Convivencia</h4>
                                    <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at mauris vel dolor.</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-lime-600 mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Amor por la Naturaleza</h4>
                                    <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at mauris vel dolor.</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-lime-600 mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Excelencia Académica</h4>
                                    <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at mauris vel dolor.</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-lime-600 mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Solidaridad y Comunidad</h4>
                                    <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at mauris vel dolor.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Carrusel de Galería de Fotos -->
                <div x-data="{ activeCategory: 'todas', categories: ['todas', 'actividades', 'deportes', 'naturaleza'] }" class="bg-white rounded-2xl shadow-xl p-8 card-hover">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900">Galería de <span class="text-lime-600">Fotos</span></h2>
                            <p class="text-gray-600">Momentos especiales de nuestra comunidad educativa</p>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-4 md:mt-0">
                            <template x-for="category in categories">
                                <button
                                    @click="activeCategory = category"
                                    class="px-4 py-2 rounded-full text-sm font-medium transition"
                                    :class="activeCategory === category
                                            ? 'bg-lime-600 text-white'
                                            : 'bg-gray-100 text-gray-700 hover:bg-lime-100 hover:text-lime-700'">
                                    <span x-text="category.charAt(0).toUpperCase() + category.slice(1)"></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <div class="relative group rounded-xl overflow-hidden" data-category="actividades">
                            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80"
                                 alt="Actividad escolar" class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="text-white font-medium">Actividad al aire libre</span>
                            </div>
                        </div>
                        <div class="relative group rounded-xl overflow-hidden" data-category="deportes">
                            <img src="https://images.unsplash.com/photo-1549060279-7e168fce7090?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80"
                                 alt="Deporte escolar" class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="text-white font-medium">Competencia deportiva</span>
                            </div>
                        </div>
                        <div class="relative group rounded-xl overflow-hidden" data-category="naturaleza">
                            <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80"
                                 alt="Naturaleza" class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="text-white font-medium">Exploración natural</span>
                            </div>
                        </div>
                        <div class="relative group rounded-xl overflow-hidden" data-category="actividades">
                            <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80"
                                 alt="Actividad creativa" class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="text-white font-medium">Arte y creatividad</span>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-8">
                        <a href="#" class="inline-flex items-center px-5 py-3 border border-lime-300 text-lime-600 font-medium rounded-full hover:bg-lime-50 transition">
                            Ver galería completa <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Sección de Testimonios con Carrusel -->
                <div x-data="{ testimonialSlide: 0, testimonialSlides: 3 }" class="bg-lime-50 rounded-2xl shadow-xl p-8 card-hover">
                    <h2 class="text-3xl font-bold text-gray-900 text-center mb-2">Lo que dicen <span class="text-lime-600">nuestras familias</span></h2>
                    <p class="text-gray-600 text-center mb-8">Testimonios de nuestra comunidad educativa</p>

                    <div class="relative overflow-hidden rounded-xl">
                        <div class="flex transition-transform duration-500 ease-in-out"
                             :style="'transform: translateX(-' + testimonialSlide * 100 + '%)'">
                            <!-- Testimonio 1 -->
                            <div class="w-full flex-shrink-0 px-4">
                                <div class="bg-white p-8 rounded-2xl shadow-md">
                                    <div class="flex items-center mb-6">
                                        <div class="w-16 h-16 rounded-full overflow-hidden border-4 border-lime-100">
                                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80"
                                                 alt="Padre de familia" class="w-full h-full object-cover">
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="font-bold text-gray-900">Carlos Mendoza</h4>
                                            <p class="text-lime-600">Padre de familia</p>
                                        </div>
                                    </div>
                                    <p class="text-gray-700 italic">
                                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at mauris vel dolor tempor venenatis.
                                        Proin efficitur justo nec finibus malesuada. Nulla facilisi. Phasellus vehicula nisi eu nunc aliquam."
                                    </p>
                                    <div class="flex mt-4">
                                        <i class="fas fa-star text-amber-400"></i>
                                        <i class="fas fa-star text-amber-400"></i>
                                        <i class="fas fa-star text-amber-400"></i>
                                        <i class="fas fa-star text-amber-400"></i>
                                        <i class="fas fa-star text-amber-400"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonio 2 -->
                            <div class="w-full flex-shrink-0 px-4">
                                <div class="bg-white p-8 rounded-2xl shadow-md">
                                    <div class="flex items-center mb-6">
                                        <div class="w-16 h-16 rounded-full overflow-hidden border-4 border-lime-100">
                                            <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80"
                                                 alt="Madre de familia" class="w-full h-full object-cover">
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="font-bold text-gray-900">María González</h4>
                                            <p class="text-lime-600">Madre de familia</p>
                                        </div>
                                    </div>
                                    <p class="text-gray-700 italic">
                                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at mauris vel dolor tempor venenatis.
                                        Proin efficitur justo nec finibus malesuada. Nulla facilisi. Phasellus vehicula nisi eu nunc aliquam."
                                    </p>
                                    <div class="flex mt-4">
                                        <i class="fas fa-star text-amber-400"></i>
                                        <i class="fas fa-star text-amber-400"></i>
                                        <i class="fas fa-star text-amber-400"></i>
                                        <i class="fas fa-star text-amber-400"></i>
                                        <i class="fas fa-star text-amber-400"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonio 3 -->
                            <div class="w-full flex-shrink-0 px-4">
                                <div class="bg-white p-8 rounded-2xl shadow-md">
                                    <div class="flex items-center mb-6">
                                        <div class="w-16 h-16 rounded-full overflow-hidden border-4 border-lime-100">
                                            <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80"
                                                 alt="Estudiante" class="w-full h-full object-cover">
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="font-bold text-gray-900">Ana Rodríguez</h4>
                                            <p class="text-lime-600">Estudiante</p>
                                        </div>
                                    </div>
                                    <p class="text-gray-700 italic">
                                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at mauris vel dolor tempor venenatis.
                                        Proin efficitur justo nec finibus malesuada. Nulla facilisi. Phasellus vehicula nisi eu nunc aliquam."
                                    </p>
                                    <div class="flex mt-4">
                                        <i class="fas fa-star text-amber-400"></i>
                                        <i class="fas fa-star text-amber-400"></i>
                                        <i class="fas fa-star text-amber-400"></i>
                                        <i class="fas fa-star text-amber-400"></i>
                                        <i class="fas fa-star text-amber-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Controles del carrusel -->
                        <button @click="testimonialSlide = (testimonialSlide - 1 + testimonialSlides) % testimonialSlides"
                                class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white/80 text-lime-600 p-2 rounded-full shadow-md hover:bg-white">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button @click="testimonialSlide = (testimonialSlide + 1) % testimonialSlides"
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white/80 text-lime-600 p-2 rounded-full shadow-md hover:bg-white">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Sección de Video Mejorada -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden card-hover">
                    <div class="md:flex items-stretch">
                        <div class="md:w-1/2 p-8">
                            <h2 class="text-3xl font-bold text-gray-900 mb-4">Conoce Nuestra <span class="text-lime-600">Historia</span></h2>
                            <p class="text-gray-700 mb-6">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at mauris vel dolor tempor venenatis.
                                Proin efficitur justo nec finibus malesuada. Nulla facilisi. Phasellus vehicula nisi eu nunc aliquam,
                                sit amet convallis nisi tincidunt.
                            </p>
                            <ul class="space-y-3 mb-6">
                                <li class="flex items-center">
                                    <i class="fas fa-check-circle text-lime-600 mr-3"></i>
                                    <span class="text-gray-700">Más de 20 años educando</span>
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check-circle text-lime-600 mr-3"></i>
                                    <span class="text-gray-700">Programas educativos innovadores</span>
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check-circle text-lime-600 mr-3"></i>
                                    <span class="text-gray-700">Comprometidos con la comunidad</span>
                                </li>
                            </ul>
                            <a href="#" class="inline-flex items-center px-5 py-3 text-white font-medium rounded-full btn-primary">
                                <i class="fas fa-history mr-2"></i> Nuestra trayectoria
                            </a>
                        </div>
                        <div class="md:w-1/2">
                            <div class="relative overflow-hidden w-full aspect-video">
                                <iframe class="absolute top-0 left-0 w-full h-full"
                                    src="https://www.youtube.com/embed/dQw4w9WgXcQ"
                                    title="YouTube video player"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección de Contacto Mejorada -->
                <div class="bg-white rounded-2xl shadow-xl p-8 card-hover">
                    <h2 class="text-3xl font-bold text-gray-900 text-center mb-2">Ubicación y <span class="text-lime-600">Contacto</span></h2>
                    <p class="text-gray-600 text-center mb-8">Estamos para responder todas tus consultas</p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                        <div class="text-center p-6 bg-lime-50 rounded-2xl">
                            <div class="inline-flex items-center justify-center w-14 h-14 bg-lime-100 text-lime-600 rounded-2xl mb-4">
                                <i class="fas fa-map-marker-alt text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Dirección</h3>
                            <p class="text-gray-700">Calle Falsa 123, Pueblo Rural, Provincia de Santa Fe</p>
                        </div>
                        <div class="text-center p-6 bg-lime-50 rounded-2xl">
                            <div class="inline-flex items-center justify-center w-14 h-14 bg-lime-100 text-lime-600 rounded-2xl mb-4">
                                <i class="fas fa-phone-alt text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Teléfono</h3>
                            <p class="text-gray-700">+54 11 1234 5678</p>
                        </div>
                        <div class="text-center p-6 bg-lime-50 rounded-2xl">
                            <div class="inline-flex items-center justify-center w-14 h-14 bg-lime-100 text-lime-600 rounded-2xl mb-4">
                                <i class="fas fa-envelope text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Correo Electrónico</h3>
                            <p class="text-gray-700">contacto@escuelarural.edu.ar</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-2xl">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Envíanos un mensaje</h3>
                        <form class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                                    <input type="text" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-lime-500 focus:border-lime-500">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-lime-500 focus:border-lime-500">
                                </div>
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Mensaje</label>
                                <textarea id="message" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-lime-500 focus:border-lime-500"></textarea>
                            </div>
                            <button type="submit" class="px-6 py-3 text-white font-medium rounded-full btn-primary">
                                Enviar mensaje
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white pt-12 pb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Escuela Rural</h3>
                        <p class="text-gray-400 mb-4">Educación de calidad en un entorno natural para formar a los líderes del mañana.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-lime-400"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-gray-400 hover:text-lime-400"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-gray-400 hover:text-lime-400"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-gray-400 hover:text-lime-400"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Enlaces rápidos</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white">Inicio</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Nosotros</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Programas</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Admisiones</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Contacto</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Programas</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white">Educación Inicial</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Primaria</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Secundaria</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Programas Especiales</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Actividades Extracurriculares</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Contacto</h3>
                        <ul class="space-y-2">
                            <li class="flex items-start">
                                <i class="fas fa-map-marker-alt text-lime-400 mt-1 mr-3"></i>
                                <span class="text-gray-400">Calle Falsa 123, Pueblo Rural, Santa Fe</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-phone-alt text-lime-400 mt-1 mr-3"></i>
                                <span class="text-gray-400">+54 11 1234 5678</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-envelope text-lime-400 mt-1 mr-3"></i>
                                <span class="text-gray-400">contacto@escuelarural.edu.ar</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-800 pt-8 text-center text-gray-400">
                    <p>&copy; 2023 Escuela Rural. Todos los derechos reservados.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
