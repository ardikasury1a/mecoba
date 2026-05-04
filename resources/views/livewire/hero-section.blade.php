<div id="hero" class="relative min-h-screen flex items-center justify-center overflow-hidden bg-grid-pattern">
    {{-- Background Decorations --}}
    <div class="absolute inset-0 noise-overlay"></div>
    <div class="absolute top-1/4 -left-32 w-96 h-96 bg-primary-500/10 rounded-full blur-3xl animate-pulse-glow"></div>
    <div class="absolute bottom-1/4 -right-32 w-96 h-96 bg-violet-500/10 rounded-full blur-3xl animate-pulse-glow" style="animation-delay: 1.5s"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-accent-500/5 rounded-full blur-3xl"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center space-y-8">
            {{-- Greeting Badge --}}
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass border border-white/10 text-sm text-slate-400 animate-fade-in-up">
                <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                {{ __('Available for freelance work') }}
            </div>

            {{-- Main Heading --}}
            <div class="space-y-4 animate-fade-in-up delay-200" style="opacity: 0;">
                <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-extrabold tracking-tight">
                    <span class="text-white">{{ __('Hi, I\'m') }}</span>
                    <br>
                    <span class="gradient-text">{{ $profile->localized_name ?? 'Ardika Surya Permadani' }}</span>
                </h1>
            </div>

            {{-- Tagline --}}
            <p class="text-xl sm:text-2xl text-slate-400 font-light max-w-2xl mx-auto animate-fade-in-up delay-400" style="opacity: 0;">
                {{ $profile->localized_tagline ?? 'Professional Trader & Financial Analyst' }}
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in-up delay-600" style="opacity: 0;">
                <a href="#contact"
                   class="group relative px-10 py-4 bg-gradient-to-r from-primary-500 to-violet-500 rounded-xl font-semibold text-white overflow-hidden transition-all duration-300 hover:shadow-lg hover:shadow-primary-500/25 hover:scale-105">
                    <span class="relative z-10 flex items-center gap-2">
                        {{ __('Get In Touch') }}
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </span>
                </a>
                <a href="#about"
                   class="px-10 py-4 rounded-xl font-semibold text-slate-300 glass hover:bg-white/10 transition-all duration-300 hover:scale-105 border border-white/10">
                    {{ __('Learn More') }}
                </a>
            </div>

            {{-- Social Contacts --}}
            <div class="flex items-center justify-center gap-6 sm:gap-12 pt-12 animate-fade-in-up delay-800" style="opacity: 0;">
                <a href="#" target="_blank" class="group flex flex-col items-center gap-3 transition-all duration-300 hover:scale-110">
                    <div class="w-14 h-14 flex items-center justify-center rounded-2xl glass group-hover:bg-primary-500/10 group-hover:border-primary-500/50 transition-all duration-300">
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-primary-400 transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </div>
                    <span class="text-xs font-semibold tracking-wider text-slate-500 uppercase group-hover:text-primary-400">Instagram</span>
                </a>
                <div class="w-px h-10 bg-white/10"></div>
                <a href="#" target="_blank" class="group flex flex-col items-center gap-3 transition-all duration-300 hover:scale-110">
                    <div class="w-14 h-14 flex items-center justify-center rounded-2xl glass group-hover:bg-primary-500/10 group-hover:border-primary-500/50 transition-all duration-300">
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-primary-400 transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </div>
                    <span class="text-xs font-semibold tracking-wider text-slate-500 uppercase group-hover:text-primary-400">LinkedIn</span>
                </a>
                <div class="w-px h-10 bg-white/10"></div>
                <a href="#" target="_blank" class="group flex flex-col items-center gap-3 transition-all duration-300 hover:scale-110">
                    <div class="w-14 h-14 flex items-center justify-center rounded-2xl glass group-hover:bg-primary-500/10 group-hover:border-primary-500/50 transition-all duration-300">
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-primary-400 transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.438 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.438-9.89 9.886-.001 2.225.586 4.391 1.697 6.315l-1.01 3.691 3.793-.997zm11.364-7.939c-.3-.149-1.772-.875-2.046-.975-.274-.1-.474-.149-.674.15-.2.299-.774.975-.948 1.174-.175.2-.349.225-.649.075-.3-.15-1.266-.467-2.411-1.488-.891-.794-1.492-1.775-1.667-2.074-.175-.299-.019-.461.13-.609.135-.133.3-.349.45-.523.15-.174.2-.299.3-.499.1-.2.05-.374-.025-.524-.075-.15-.674-1.622-.924-2.221-.244-.588-.493-.508-.674-.518-.175-.008-.374-.01-.574-.01-.2 0-.524.075-.798.374-.274.299-1.048 1.024-1.048 2.497 0 1.472 1.073 2.893 1.223 3.093.15.2 2.112 3.226 5.115 4.526.714.309 1.272.494 1.707.633.717.227 1.369.195 1.884.118.574-.085 1.772-.724 2.022-1.423.25-.699.25-1.298.175-1.423-.075-.125-.275-.199-.575-.349z"/></svg>
                    </div>
                    <span class="text-xs font-semibold tracking-wider text-slate-500 uppercase group-hover:text-primary-400">WhatsApp</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Scroll Indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
        <a href="#about" class="text-slate-600 hover:text-slate-400 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
        </a>
    </div>
</div>
