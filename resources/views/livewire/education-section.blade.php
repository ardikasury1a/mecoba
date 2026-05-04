<section id="education" class="relative py-24 lg:py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div x-data="{ visible: false }" x-intersect.once="visible = true" :class="visible ? 'animate-fade-in-up' : 'opacity-0'" class="text-center mb-16 space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium uppercase tracking-widest text-violet-400 bg-violet-500/10 border border-violet-500/20">{{ __('Education') }}</div>
            <h2 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-bold text-white">{{ __('My') }} <span class="gradient-text">{{ __('Education') }}</span></h2>
        </div>

        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($educations as $index => $edu)
            <div x-data="{ visible: false }" x-intersect.once="visible = true" :class="visible ? 'animate-fade-in-up' : 'opacity-0'" style="animation-delay: {{ $index * 200 }}ms"
                 class="glass rounded-2xl p-6 hover:bg-white/5 transition-all duration-300 glow-hover group">
                <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-violet-500/20 to-primary-500/20 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <span class="text-2xl flex items-center justify-center">
                            @if(str_contains(strtolower($edu->field_of_study ?? ''), 'sertifikasi') || str_contains(strtolower($edu->degree ?? ''), 'brevet'))
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-blue-500">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                </svg>
                            @else
                                🎓
                            @endif
                        </span>
                    </div>
                    <div class="flex-1 space-y-2">
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="text-xs font-mono px-3 py-1 rounded-full bg-violet-500/10 text-violet-400 border border-violet-500/20">{{ $edu->period }}</span>
                        </div>
                        <h3 class="text-xl font-heading font-bold text-white">{{ $edu->institution }}</h3>
                        <p class="text-primary-400 font-medium">{{ $edu->localized_degree }}
                            @if($edu->localized_field_of_study) — {{ $edu->localized_field_of_study }}@endif
                        </p>
                        @if($edu->localized_description)
                        <p class="text-slate-400 text-sm leading-relaxed mt-2">{!! $edu->localized_description !!}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
