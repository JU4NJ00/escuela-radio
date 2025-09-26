{{-- Carrusel con imagenes --}}
<style>
    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .float-animation {
        animation: float 6s ease-in-out infinite;
    }

    .shine-effect::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transform: translateX(-100%) rotate(45deg);
    }

    .shine-effect:hover::before {
        animation: shine 1.5s;
    }

    @keyframes shine {
        from {
            transform: translateX(-100%) rotate(45deg);
        }

        to {
            transform: translateX(200%) rotate(45deg);
        }
    }

    .scroll-container {
        scroll-snap-type: y mandatory;
        -webkit-overflow-scrolling: touch;
    }

    .scroll-section {
        scroll-snap-align: start;
        scroll-snap-stop: always;
    }
</style>

<!-- Main scroll container -->
<div class="scroll-container h-screen overflow-y-auto overflow-x-hidden mb-2 mt-2">

    <!-- Section 1 -->
    <section class="scroll-section relative h-auto min-h-[80vh] md:min-h-screen flex flex-col md:flex-row">

        <!-- Right image -->
        <div class="w-full md:w-1/2 relative overflow-hidden group shine-effect h-64 md:h-auto">
            <img src="{{ asset('upload/escuela_frontal.jpeg') }}" alt="Frontal Escuela"
                class="absolute inset-0 w-full h-full object-cover transition-all duration-1000 group-hover:scale-110" />
            <div class="absolute inset-0 bg-gradient-to-l from-neutral-950/70 to-neutral-950/50"></div>
        </div>
        <!-- Left text -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-6 md:p-8 bg-neutral-900">
            <div class="max-w-lg float-animation text-center md:text-left">
                <span class="text-green-500 tracking-wider text-sm font-mono">01 / COMUNIDAD</span>
                <h2
                    class="mt-4 text-3xl sm:text-4xl md:text-5xl font-bold bg-gradient-to-r from-white to-green-400 bg-clip-text text-transparent">
                    Un Espacio de Todos
                </h2>
                <p class="mt-4 sm:mt-6 text-neutral-400 text-base sm:text-lg leading-relaxed">
                    La escuela y su radio no son solo un lugar de aprendizaje, sino un espacio
                    de participación activa de alumnos, docentes y familias.
                </p>
            </div>
        </div>
    </section>

    <!-- Section 2 -->
    <section class="scroll-section relative h-auto min-h-[80vh] md:min-h-screen flex flex-col md:flex-row">

        <!-- Right text -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-6 md:p-8 bg-neutral-900 order-2 md:order-1">
            <div class="max-w-lg float-animation text-center md:text-left">
                <span class="text-green-500 tracking-wider text-sm font-mono">02 / NATURALEZA</span>
                <h2
                    class="mt-4 text-3xl sm:text-4xl md:text-5xl font-bold bg-gradient-to-r from-white to-green-400 bg-clip-text text-transparent">
                    El Patio
                </h2>
                <p class="mt-4 sm:mt-6 text-neutral-400 text-base sm:text-lg leading-relaxed">
                    Nuestros patios rodeados de naturaleza brindan sombra, juegos y espacios
                    de encuentro para los estudiantes.
                </p>
            </div>
        </div>
        <!-- Left image -->
        <div class="w-full md:w-1/2 relative overflow-hidden group shine-effect h-64 md:h-auto order-1 md:order-2">
            <img src="{{ asset('upload/vertical.jpeg') }}" alt="Árbol patio"
                class="absolute inset-0 w-full h-full object-cover transition-all duration-1000 group-hover:scale-110" />
            <div class="absolute inset-0 bg-gradient-to-l from-neutral-950/70 to-neutral-950/50"></div>
        </div>
    </section>

    <!-- Section 3 -->
    <section class="scroll-section relative h-auto min-h-[80vh] md:min-h-screen flex flex-col md:flex-row">

        <!-- Left image -->
        <div class="w-full md:w-1/2 relative overflow-hidden group shine-effect h-64 md:h-auto">
            <img src="{{ asset('upload/estudio_mesa.jpeg') }}" alt="Atardecer en la escuela"
                class="absolute inset-0 w-full h-full object-cover transition-all duration-1000 group-hover:scale-110" />
            <div class="absolute inset-0 bg-gradient-to-r from-neutral-950/70 to-neutral-950/50"></div>
        </div>
        <!-- Right text -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-6 md:p-8 bg-neutral-950">
            <div class="max-w-lg float-animation text-center md:text-left">
                <span class="text-green-500 tracking-wider text-sm font-mono">03 / IDENTIDAD</span>
                <h2
                    class="mt-4 text-3xl sm:text-4xl md:text-5xl font-bold bg-gradient-to-r from-white to-green-400 bg-clip-text text-transparent">
                    La Radio Escolar
                </h2>
                <p class="mt-4 sm:mt-6 text-neutral-400 text-base sm:text-lg leading-relaxed">
                    FM 94.1 “El Lucero” acompaña a la comunidad con información, música y proyectos,
                    siendo parte esencial de nuestra identidad educativa.
                </p>
            </div>
        </div>
    </section>

    <!-- Section 4 -->
    <section class="scroll-section relative h-auto min-h-[80vh] md:min-h-screen flex flex-col md:flex-row">

        <!-- Left image -->
        <div class="w-full md:w-1/2 relative overflow-hidden group shine-effect h-64 md:h-auto">
            <img src="{{ asset('upload/frontal.jpeg') }}" alt="Entrada Escuela"
                class="absolute inset-0 w-full h-full object-cover transition-all duration-1000 group-hover:scale-110" />
            <div class="absolute inset-0 bg-gradient-to-r from-neutral-950/70 to-neutral-950/50"></div>
        </div>
        <!-- Right text -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-6 md:p-8 bg-neutral-950">
            <div class="max-w-lg float-animation text-center md:text-left">
                <span class="text-green-500 tracking-wider text-sm font-mono">04 / ESCUELA</span>
                <h2
                    class="mt-4 text-3xl sm:text-4xl md:text-5xl font-bold bg-gradient-to-r from-white to-green-400 bg-clip-text text-transparent">
                    Nuestra Escuela
                </h2>
                <p class="mt-4 sm:mt-6 text-neutral-400 text-base sm:text-lg leading-relaxed">
                    La Escuela N.º 952 “Domingo F. Sarmiento” es el corazón de la comunidad,
                    donde la educación se combina con la cultura y la radio escolar.
                </p>
            </div>
        </div>
    </section>


</div>

<script>
    const container = document.querySelector('.scroll-container');
    const sections = document.querySelectorAll('.scroll-section');
    const dots = document.querySelectorAll('.dot');

    function scrollToSection(index) {
        sections[index].scrollIntoView({
            behavior: 'smooth'
        });
        updateDots(index);
    }

    function updateDots(index) {
        dots.forEach((dot, i) => {
            dot.className = `dot w-2 sm:w-3 h-2 sm:h-3 rounded-full transition-all duration-300 ${
                i === index ? 'bg-green-500 scale-150' : 'bg-white/20 hover:bg-white hover:scale-150'
            }`;
        });
    }

    container.addEventListener('scroll', () => {
        const index = Math.round(container.scrollTop / window.innerHeight);
        updateDots(index);
    });

    updateDots(0);
</script>
