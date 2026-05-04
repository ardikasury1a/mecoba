<section id="testimonials" class="relative py-24 lg:py-32 bg-dark-950/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div x-data="{ visible: false }" x-intersect.once="visible = true" :class="visible ? 'animate-fade-in-up' : 'opacity-0'" class="text-center mb-16 space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium uppercase tracking-widest text-amber-400 bg-amber-500/10 border border-amber-500/20">{{ __('Testimonials') }}</div>
            <h2 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-bold text-white">{{ __('What') }} <span class="gradient-text">{{ __('People Say') }}</span></h2>
        </div>

        <div x-data="{ active: 0, testimonials: {{ $testimonials->count() }} }" class="relative max-w-4xl mx-auto">
            <div class="overflow-hidden rounded-3xl">
                @foreach($testimonials as $index => $testimonial)
                <div x-show="active === {{ $index }}"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 translate-x-8"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 -translate-x-8"
                     class="glass rounded-3xl p-8 sm:p-12">
                    <div class="text-5xl text-primary-500/30 font-serif mb-6">"</div>
                    <blockquote class="text-lg sm:text-xl text-slate-300 leading-relaxed mb-8">{{ $testimonial->localized_content }}</blockquote>
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-primary-500 to-violet-500 flex items-center justify-center text-white font-bold text-lg">
                            {{ substr($testimonial->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="font-heading font-bold text-white">{{ $testimonial->name }}</div>
                            <div class="text-sm text-slate-400">{{ $testimonial->position }} {{ $testimonial->company ? '@ ' . $testimonial->company : '' }}</div>
                        </div>
                        <div class="ml-auto text-amber-400">
                            @for($i = 0; $i < $testimonial->rating; $i++) ⭐ @endfor
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Navigation --}}
            <div class="flex items-center justify-center gap-4 mt-8">
                <button @click="active = active > 0 ? active - 1 : testimonials - 1" class="w-10 h-10 rounded-full glass flex items-center justify-center text-slate-400 hover:text-white hover:bg-white/10 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <div class="flex gap-2">
                    @foreach($testimonials as $index => $t)
                    <button @click="active = {{ $index }}" :class="active === {{ $index }} ? 'bg-primary-500 w-8' : 'bg-slate-700 w-2'" class="h-2 rounded-full transition-all duration-300"></button>
                    @endforeach
                </div>
                <button @click="active = active < testimonials - 1 ? active + 1 : 0" class="w-10 h-10 rounded-full glass flex items-center justify-center text-slate-400 hover:text-white hover:bg-white/10 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </div>
</section>
