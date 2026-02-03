{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#050608] text-[#EDEDEC] flex flex-col">

    {{-- HEADER --}}
    <header class="w-full border-b border-[#262626]">
        <div class="lg:max-w-4xl max-w-[335px] mx-auto pt-6 pb-4 text-sm">
            @if (Route::has('login'))
                <nav class="flex items-center justify-between gap-4">
                    <div class="text-xs text-[#9b9b9b]">
                        <span class="font-semibold text-[#EDEDEC]">FocusLists</span>
                        <span class="ml-2">Gestor de listas y grupos de tareas</span>
                    </div>

                    @auth
                        <a
                            href="{{ url('/grupos') }}"
                            class="inline-block px-5 py-1.5 border border-[#343434] hover:border-[#5a5a5a] text-[#EDEDEC] bg-[#111217] hover:bg-[#181920] rounded-sm text-sm leading-normal transition"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="inline-block px-5 py-1.5 text-[#EDEDEC] border border-transparent hover:border-[#343434] hover:bg-[#111217] rounded-sm text-sm leading-normal transition"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="inline-block px-5 py-1.5 border border-[#343434] hover:border-[#5a5a5a] text-[#EDEDEC] bg-[#111217] hover:bg-[#181920] rounded-sm text-sm leading-normal transition"
                            >
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </header>

    {{-- CONTENIDO PRINCIPAL --}}
    <main class="flex-1 flex items-center">
        <div class="w-full lg:max-w-4xl max-w-[335px] mx-auto">
            <section class="mb-10 mt-8">
                <h1 class="text-3xl lg:text-4xl font-semibold mb-4">
                    Organiza tus tareas por grupos y listas
                </h1>
                <p class="text-sm text-[#b4b4b4] max-w-xl mb-3">
                    Crea múltiples grupos y dentro de ellos varias listas de tareas para organizar tu día a día
                    de forma clara y flexible.
                </p>
                <p class="text-sm text-[#b4b4b4] max-w-xl">
                    Estamos desarrollando un temporizador tipo Pomodoro integrado con tus listas de tareas,
                    actualmente en fase de producción, para ayudarte a mantener el foco mientras trabajas.
                </p>
            </section>

            <section class="grid gap-4 md:grid-cols-3">
                <article class="bg-[#111217] border border-[#343434] rounded-md p-4 hover:border-[#5a5a5a] transition">
                    <h2 class="text-base font-medium mb-2">Grupos de tareas</h2>
                    <p class="text-xs text-[#b4b4b4]">
                        Crea diferentes grupos (trabajo, estudios, proyectos personales) y organiza tus todolists dentro de cada uno.
                    </p>
                </article>

                <article class="bg-[#111217] border border-[#343434] rounded-md p-4 hover:border-[#5a5a5a] transition">
                    <h2 class="text-base font-medium mb-2">Múltiples todolists</h2>
                    <p class="text-xs text-[#b4b4b4]">
                        Añade tantas listas como necesites en cada grupo, marca tareas como completadas y mantén el control de tu progreso.
                    </p>
                </article>

                <article class="bg-[#111217] border border-[#343434] rounded-md p-4 hover:border-[#5a5a5a] transition">
                    <h2 class="text-base font-medium mb-2">Pomodoro en desarrollo</h2>
                    <p class="text-xs text-[#b4b4b4]">
                        Pronto podrás usar un temporizador Pomodoro conectado a tus tareas; la funcionalidad ya está en desarrollo y entrando en producción.
                    </p>
                </article>
            </section>
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="w-full py-6 mt-8 border-t border-[#262626]">
        <div class="w-full lg:max-w-4xl max-w-[335px] mx-auto text-xs text-[#747474] flex justify-between">
            <span>&copy; {{ date('Y') }} BaohDev</span>
            <span>Hecho con Laravel & Tailwind</span>
        </div>
    </footer>

</body>
</html>
