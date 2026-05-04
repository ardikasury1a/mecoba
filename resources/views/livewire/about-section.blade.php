<section id="about" class="relative py-24 lg:py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            {{-- Image Side --}}
            <div x-data="{ visible: false }" x-intersect.once="visible = true"
                 :class="visible ? 'animate-fade-in-up' : 'opacity-0'"
                 class="relative">
                <div class="relative w-full max-w-md mx-auto">
                    {{-- Decorative elements --}}
                    <div class="absolute -inset-4 bg-gradient-to-br from-primary-500/20 to-violet-500/20 rounded-3xl blur-xl"></div>
                    <div class="relative glass rounded-3xl p-2 gradient-border">
                        <div class="aspect-square rounded-2xl bg-gradient-to-br from-dark-700 to-dark-800 overflow-hidden flex items-center justify-center">
                            @if($profile && $profile->avatar)
                                <img src="{{ Storage::url($profile->avatar) }}" alt="{{ $profile->name }}" class="w-full h-full object-cover">
                            @else
                                {{-- Placeholder avatar --}}
                                <div class="text-center space-y-4 p-8">
                                    <div class="w-32 h-32 mx-auto rounded-full bg-gradient-to-br from-primary-500 to-violet-500 flex items-center justify-center">
                                        <span class="text-5xl font-heading font-bold text-white">A</span>
                                    </div>
                                    <p class="text-slate-500 text-sm">{{ __('Profile Photo') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    {{-- Floating badges --}}
                    <div class="absolute -top-4 -right-4 glass rounded-2xl px-4 py-3 animate-float">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                            <span class="text-sm font-medium text-white">{{ __('Available') }}</span>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -left-4 glass rounded-2xl px-4 py-3 animate-float" style="animation-delay: 3s;">
                        <div class="flex items-center gap-2">
                            <span class="text-2xl">🚀</span>
                            <span class="text-sm font-medium text-white">5+ {{ __('Years') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Content Side --}}
            <div x-data="{ visible: false }" x-intersect.once="visible = true"
                 :class="visible ? 'animate-fade-in-up' : 'opacity-0'"
                 class="space-y-6" style="animation-delay: 200ms;">
                {{-- Section Label --}}
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium uppercase tracking-widest text-primary-400 bg-primary-500/10 border border-primary-500/20">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    {{ __('About Me') }}
                </div>

                <h2 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight">
                    {{ __('Focus on performance and') }}
                    <span class="gradient-text">{{ __('market analysis') }}</span>
                </h2>

                <div class="text-slate-400 leading-relaxed space-y-4 text-lg">
                    {!! nl2br(e($profile->localized_bio ?? '')) !!}
                </div>

                {{-- Info Grid --}}
                <div class="grid grid-cols-2 gap-4 pt-4">
                    @if($profile && $profile->email)
                    <div class="glass rounded-xl p-4">
                        <div class="text-xs text-slate-500 uppercase tracking-wider mb-1">Email</div>
                        <div class="text-sm text-white font-medium truncate">{{ $profile->email }}</div>
                    </div>
                    @endif
                    @if($profile && $profile->phone)
                    <div class="glass rounded-xl p-4">
                        <div class="text-xs text-slate-500 uppercase tracking-wider mb-1">{{ __('Phone') }}</div>
                        <div class="text-sm text-white font-medium">{{ $profile->phone }}</div>
                    </div>
                    @endif
                    @if($profile && $profile->address)
                    <div class="glass rounded-xl p-4">
                        <div class="text-xs text-slate-500 uppercase tracking-wider mb-1">{{ __('Location') }}</div>
                        <div class="text-sm text-white font-medium">{{ $profile->address }}</div>
                    </div>
                    @endif
                    <div class="glass rounded-xl p-4">
                        <div class="text-xs text-slate-500 uppercase tracking-wider mb-1">{{ __('Languages') }}</div>
                        <div class="text-sm text-white font-medium">ID, EN</div>
                    </div>
                </div>

                {{-- Social Links --}}
                @if($profile)
                <div class="flex items-center gap-3 pt-4">
                    @if($profile->github_url)
                    <a href="{{ $profile->github_url }}" target="_blank" class="w-10 h-10 rounded-xl glass flex items-center justify-center text-slate-400 hover:text-white hover:bg-white/10 transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                    </a>
                    @endif
                    @if($profile->linkedin_url)
                    <a href="{{ $profile->linkedin_url }}" target="_blank" class="w-10 h-10 rounded-xl glass flex items-center justify-center text-slate-400 hover:text-white hover:bg-white/10 transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    @endif
                    @if($profile->instagram_url)
                    <a href="{{ $profile->instagram_url }}" target="_blank" class="w-10 h-10 rounded-xl glass flex items-center justify-center text-slate-400 hover:text-white hover:bg-white/10 transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
