<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $metaDescription ?? 'Professional Portfolio - Full-Stack Developer & UI/UX Designer' }}">
    <meta name="keywords" content="portfolio, developer, full-stack, web development, laravel, ui/ux">
    <meta name="author" content="{{ $metaAuthor ?? 'Ardika Surya Permadani' }}">

    <title>{{ $title ?? 'Portfolio' }} | Ardika Surya Permadani</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <!-- Heroicons CDN for inline SVGs -->
    <style>
        [x-cloak] { display: none !important; }

        /* Custom Design System */
        html { scroll-behavior: smooth; scroll-padding-top: 5rem; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0a0a0f; }
        ::-webkit-scrollbar-thumb { background: #6366f1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #818cf8; }

        .glass { background: rgba(255,255,255,0.03); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.08); }
        .glass-strong { background: rgba(255,255,255,0.06); backdrop-filter: blur(30px); border: 1px solid rgba(255,255,255,0.1); }
        .gradient-text { background: linear-gradient(135deg, #6366f1, #8b5cf6, #06b6d4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .glow { box-shadow: 0 0 20px rgba(99,102,241,0.15), 0 0 60px rgba(99,102,241,0.05); }
        .glow-hover:hover { box-shadow: 0 0 30px rgba(99,102,241,0.25), 0 0 80px rgba(99,102,241,0.1); }

        .gradient-border { position: relative; border: none; }
        .gradient-border::before { content: ''; position: absolute; inset: 0; border-radius: inherit; padding: 1px; background: linear-gradient(135deg, rgba(99,102,241,0.5), rgba(139,92,246,0.3), rgba(6,182,212,0.3)); mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0); mask-composite: exclude; -webkit-mask-composite: xor; pointer-events: none; }

        .bg-grid-pattern { background-image: linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px); background-size: 60px 60px; }

        @keyframes fade-in-up { from { opacity:0; transform:translateY(30px); } to { opacity:1; transform:translateY(0); } }
        @keyframes float { 0%,100% { transform:translateY(0); } 50% { transform:translateY(-10px); } }
        @keyframes pulse-glow { 0%,100% { box-shadow:0 0 20px rgba(99,102,241,0.2); } 50% { box-shadow:0 0 40px rgba(99,102,241,0.4); } }
        @keyframes slide-in-left { from { opacity:0; transform:translateX(-30px); } to { opacity:1; transform:translateX(0); } }
        @keyframes scale-in { from { opacity:0; transform:scale(0.9); } to { opacity:1; transform:scale(1); } }

        .animate-fade-in-up { animation: fade-in-up 0.6s ease-out forwards; }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-pulse-glow { animation: pulse-glow 3s ease-in-out infinite; }
        .animate-slide-in-left { animation: slide-in-left 0.6s ease-out forwards; }
        .animate-scale-in { animation: scale-in 0.5s ease-out forwards; }
        .progress-bar { transition: width 1.5s cubic-bezier(0.4,0,0.2,1); }
        .noise-overlay::after { content:''; position:absolute; inset:0; opacity:0.02; pointer-events:none; }
    </style>

    <!-- Tailwind CSS v4 CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        heading: ['Outfit', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        mono: ['JetBrains Mono', 'ui-monospace', 'monospace'],
                    },
                    colors: {
                        dark: { 950: '#050507', 900: '#0a0a0f', 800: '#111827', 700: '#1a1a2e', 600: '#16213e', 500: '#1e293b' },
                        primary: { 400: '#818cf8', 500: '#6366f1', 600: '#4f46e5' },
                        accent: { 400: '#22d3ee', 500: '#06b6d4' },
                        violet: { 400: '#a78bfa', 500: '#8b5cf6' },
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js Intersect Plugin (loaded before Livewire's Alpine) -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>

    @livewireStyles
</head>
<body class="bg-dark-900 text-slate-200 font-sans antialiased overflow-x-hidden">

    {{-- Navigation --}}
    @unless($hideNav ?? false)
    <nav x-data="{ open: false, scrolled: false }"
         x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
         :class="scrolled ? 'glass-strong shadow-lg shadow-black/20' : 'bg-transparent'"
         class="fixed top-0 left-0 right-0 z-50 transition-all duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                {{-- Logo --}}
                <a href="#hero" class="flex items-center gap-2 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-violet-500 flex items-center justify-center font-heading font-bold text-white text-lg group-hover:scale-110 transition-transform duration-300">
                        A
                    </div>
                    <span class="font-heading font-bold text-lg text-white hidden sm:block">Ardika<span class="gradient-text">Surya</span></span>
                </a>

                {{-- Desktop Navigation --}}
                <div class="hidden lg:flex items-center gap-1">
                    @php
                        $navItems = [
                            ['href' => '#hero', 'label' => __('Beranda')],
                            ['href' => '#about', 'label' => __('Tentang')],
                            ['href' => '#contact', 'label' => __('Kontak')],
                            ['href' => '/admin', 'label' => __('Dashboard Trading')],
                        ];
                    @endphp

                    @foreach($navItems as $item)
                        <a href="{{ $item['href'] }}"
                           class="px-4 py-2 text-sm font-medium text-slate-400 hover:text-white rounded-lg hover:bg-white/5 transition-all duration-300">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>

                {{-- Language Switcher + Mobile Toggle --}}
                <div class="flex items-center gap-3">
                    {{-- Language Switcher --}}
                    <div x-data="{ langOpen: false }" class="relative">
                        <button @click="langOpen = !langOpen"
                                class="flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-slate-400 hover:text-white rounded-lg hover:bg-white/5 transition-all border border-white/10">
                            <span>{{ app()->getLocale() === 'id' ? '🇮🇩 ID' : '🇬🇧 EN' }}</span>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="langOpen" @click.away="langOpen = false" x-cloak
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-32 glass-strong rounded-xl overflow-hidden shadow-xl">
                            <a href="{{ url('/?lang=id') }}" class="block px-4 py-2.5 text-sm text-slate-300 hover:bg-white/10 hover:text-white transition">🇮🇩 Indonesia</a>
                            <a href="{{ url('/?lang=en') }}" class="block px-4 py-2.5 text-sm text-slate-300 hover:bg-white/10 hover:text-white transition">🇬🇧 English</a>
                        </div>
                    </div>

                    {{-- Mobile Toggle --}}
                    <button @click="open = !open" class="lg:hidden p-2 text-slate-400 hover:text-white rounded-lg hover:bg-white/5 transition">
                        <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg x-show="open" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="open" x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="lg:hidden glass-strong border-t border-white/5">
            <div class="px-4 py-4 space-y-1">
                @foreach($navItems as $item)
                    <a href="{{ $item['href'] }}" @click="open = false"
                       class="block px-4 py-3 text-sm font-medium text-slate-400 hover:text-white rounded-lg hover:bg-white/5 transition-all">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>
        </div>
    </nav>

    @endunless

    {{-- Main Content --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Footer --}}
    @unless($hideFooter ?? false)
    <footer class="relative border-t border-white/5 bg-dark-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary-500 to-violet-500 flex items-center justify-center font-heading font-bold text-white text-sm">
                        A
                    </div>
                    <span class="font-heading font-semibold text-white">Ardika<span class="gradient-text">Surya</span></span>
                </div>

                <p class="text-slate-500 text-sm">
                    &copy; {{ date('Y') }} Ardika Surya Permadani. {{ __('All rights reserved.') }}
                </p>

                <div class="flex items-center gap-4">
                    <a href="#" class="text-slate-500 hover:text-primary-400 transition-colors duration-300" aria-label="GitHub">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                    </a>
                    <a href="#" class="text-slate-500 hover:text-primary-400 transition-colors duration-300" aria-label="LinkedIn">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    <a href="#" class="text-slate-500 hover:text-primary-400 transition-colors duration-300" aria-label="Instagram">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    @endunless

    @livewireScripts
</body>
</html>
