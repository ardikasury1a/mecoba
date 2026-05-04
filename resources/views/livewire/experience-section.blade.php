<section id="experience" class="relative py-24 lg:py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div x-data="{ visible: false }" x-intersect.once="visible = true" :class="visible ? 'animate-fade-in-up' : 'opacity-0'" class="text-center mb-16 space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium uppercase tracking-widest text-primary-400 bg-primary-500/10 border border-primary-500/20">
                {{ __('Experience') }}
            </div>
            <h2 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-bold text-white">{{ __('Work') }} <span class="gradient-text">{{ __('Experience') }}</span></h2>
        </div>

        <div class="relative max-w-3xl mx-auto">
            <div class="absolute left-8 top-0 bottom-0 w-px bg-gradient-to-b from-primary-500/50 via-violet-500/30 to-transparent"></div>

            @foreach($experiences as $index => $exp)
            <div x-data="{ visible: false }" x-intersect.once="visible = true" :class="visible ? 'animate-slide-in-left' : 'opacity-0'" style="animation-delay: {{ $index * 200 }}ms" class="relative pl-20 pb-12 last:pb-0">
                <div class="absolute left-5 top-1 w-7 h-7 rounded-full {{ $exp->is_current ? 'bg-gradient-to-br from-primary-500 to-violet-500 animate-pulse-glow' : 'bg-dark-700 border-2 border-primary-500/50' }} flex items-center justify-center">
                    @if($exp->is_current)<div class="w-2 h-2 bg-white rounded-full"></div>@endif
                </div>
                <div class="glass rounded-2xl p-6 hover:bg-white/5 transition-all glow-hover">
                    <div class="flex flex-wrap items-center gap-3 mb-3">
                        <span class="text-xs font-mono px-3 py-1 rounded-full bg-primary-500/10 text-primary-400 border border-primary-500/20">{{ $exp->period }}</span>
                        @if($exp->is_current)<span class="text-xs px-2 py-0.5 rounded-full bg-green-500/10 text-green-400 border border-green-500/20">{{ __('Current') }}</span>@endif
                    </div>
                    <h3 class="text-xl font-heading font-bold text-white">{{ $exp->localized_position }}</h3>
                    <p class="text-primary-400 font-medium mt-1">{{ $exp->company }}</p>
                    @if($exp->localized_description)<div class="text-slate-400 mt-3 leading-relaxed">{!! $exp->localized_description !!}</div>@endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
