<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $siteName }} — Em construção</title>
        <meta name="description" content="{{ $siteName }} está em construção. Volte em breve.">

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="flex min-h-screen flex-col bg-[#FDFDFC] text-[#1b1b18] antialiased dark:bg-[#0a0a0a] dark:text-[#EDEDEC]">
        <header class="mx-auto flex w-full max-w-5xl items-center justify-between px-6 py-6 lg:px-8">
            <span class="flex items-center gap-3 text-lg font-semibold">
                <span class="flex size-9 items-center justify-center rounded-lg bg-amber-500 text-base font-bold text-white">
                    {{ Str::substr($siteName, 0, 1) }}
                </span>
                {{ $siteName }}
            </span>

            <span class="rounded-full border border-amber-500/30 bg-amber-500/10 px-3 py-1 text-xs font-medium text-amber-700 dark:text-amber-400">
                Em construção
            </span>
        </header>

        <main class="mx-auto flex w-full max-w-5xl grow flex-col justify-center gap-16 px-6 py-12 lg:px-8">
            <section class="flex max-w-2xl flex-col gap-6">
                <h1 class="text-4xl font-semibold tracking-tight sm:text-5xl">
                    Bem-vindo à <span class="text-amber-600 dark:text-amber-400">{{ $siteName }}</span>.
                </h1>

                <p class="text-lg text-[#706f6c] dark:text-[#A1A09A]">
                    Estamos em construção. Nossa equipe está trabalhando para entregar uma experiência completa,
                    rápida e segura para você.
                </p>

                <p class="text-lg font-medium">Volte em breve.</p>

                <div class="flex flex-col gap-2">
                    <div class="flex justify-between text-sm text-[#706f6c] dark:text-[#A1A09A]">
                        <span>Progresso do projeto</span>
                        <span>72%</span>
                    </div>
                    <div class="h-2 w-full overflow-hidden rounded-full bg-[#e3e3e0] dark:bg-[#3E3E3A]">
                        <div class="h-full w-[72%] rounded-full bg-amber-500"></div>
                    </div>
                </div>
            </section>

            <section class="grid gap-6 sm:grid-cols-3">
                @foreach ([
                    ['title' => 'Novo site', 'text' => 'Um visual renovado, pensado para funcionar bem em qualquer dispositivo.'],
                    ['title' => 'Atendimento digital', 'text' => 'Canais de contato mais ágeis para responder você com rapidez.'],
                    ['title' => 'Segurança em primeiro lugar', 'text' => 'Infraestrutura moderna, com seus dados protegidos de ponta a ponta.'],
                ] as $feature)
                    <div class="flex flex-col gap-2 rounded-xl border border-[#e3e3e0] bg-white p-6 dark:border-[#3E3E3A] dark:bg-[#161615]">
                        <h2 class="font-semibold">{{ $feature['title'] }}</h2>
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">{{ $feature['text'] }}</p>
                    </div>
                @endforeach
            </section>

            <section class="grid grid-cols-3 gap-6 border-y border-[#e3e3e0] py-8 text-center dark:border-[#3E3E3A]">
                <div class="flex flex-col gap-1">
                    <span class="text-2xl font-semibold">+1.200</span>
                    <span class="text-sm text-[#706f6c] dark:text-[#A1A09A]">xícaras de café</span>
                </div>
                <div class="flex flex-col gap-1">
                    <span class="text-2xl font-semibold">38</span>
                    <span class="text-sm text-[#706f6c] dark:text-[#A1A09A]">funcionalidades planejadas</span>
                </div>
                <div class="flex flex-col gap-1">
                    <span class="text-2xl font-semibold">100%</span>
                    <span class="text-sm text-[#706f6c] dark:text-[#A1A09A]">dedicação</span>
                </div>
            </section>
        </main>

        <footer class="mx-auto w-full max-w-5xl px-6 py-6 text-sm text-[#706f6c] lg:px-8 dark:text-[#A1A09A]">
            &copy; {{ now()->year }} {{ $siteName }} · {{ $domain }}. Todos os direitos reservados.
        </footer>
    </body>
</html>
