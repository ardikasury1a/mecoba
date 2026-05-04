<section id="projects" class="relative py-24 lg:py-32 bg-dark-950/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div x-data="{ visible: false }" x-intersect.once="visible = true" :class="visible ? 'animate-fade-in-up' : 'opacity-0'" class="text-center mb-16 space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium uppercase tracking-widest text-accent-400 bg-accent-500/10 border border-accent-500/20">{{ __('Portfolio') }}</div>
            <h2 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-bold text-white">{{ __('Featured') }} <span class="gradient-text">{{ __('Projects') }}</span></h2>
        </div>

        {{-- Filter --}}
        <div class="flex flex-wrap justify-center gap-2 mb-12">
            <button wire:click="setFilter('all')" class="px-5 py-2 rounded-xl text-sm font-medium transition-all duration-300 {{ $activeFilter === 'all' ? 'bg-gradient-to-r from-primary-500 to-violet-500 text-white' : 'glass text-slate-400 hover:text-white hover:bg-white/5' }}">{{ __('All') }}</button>
            @foreach($categories as $cat)
            <button wire:click="setFilter('{{ $cat }}')" class="px-5 py-2 rounded-xl text-sm font-medium transition-all duration-300 {{ $activeFilter === $cat ? 'bg-gradient-to-r from-primary-500 to-violet-500 text-white' : 'glass text-slate-400 hover:text-white hover:bg-white/5' }}">{{ $cat }}</button>
            @endforeach
        </div>

        {{-- Projects Grid --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($projects as $index => $project)
            <div x-data="{ visible: false }" x-intersect.once="visible = true" :class="visible ? 'animate-scale-in' : 'opacity-0'" style="animation-delay: {{ $index * 100 }}ms"
                 class="group glass rounded-2xl overflow-hidden hover:bg-white/5 transition-all duration-500 glow-hover">
                {{-- Image --}}
                <div class="relative aspect-video bg-dark-700 overflow-hidden">
                    @if($project->image)
                        <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-dark-700 to-dark-800">
                            <span class="text-4xl">{{ $project->is_featured ? '⭐' : '💻' }}</span>
                        </div>
                    @endif
                    @if($project->is_featured)
                    <div class="absolute top-3 right-3 px-2 py-1 rounded-lg bg-amber-500/20 text-amber-400 text-xs font-medium backdrop-blur-sm border border-amber-500/20">⭐ Featured</div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-dark-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-4">
                        <div class="flex gap-2">
                            @if($project->live_url)<a href="{{ $project->live_url }}" target="_blank" class="px-3 py-1.5 rounded-lg bg-white/10 backdrop-blur-sm text-sm text-white hover:bg-white/20 transition">🔗 Demo</a>@endif
                            @if($project->github_url)<a href="{{ $project->github_url }}" target="_blank" class="px-3 py-1.5 rounded-lg bg-white/10 backdrop-blur-sm text-sm text-white hover:bg-white/20 transition">📂 Code</a>@endif
                        </div>
                    </div>
                </div>
                {{-- Content --}}
                <div class="p-6 space-y-3">
                    <div class="flex items-center justify-between">
                        <h3 class="font-heading font-bold text-lg text-white group-hover:gradient-text transition-all">{{ $project->localized_title }}</h3>
                        <span class="text-xs px-2 py-0.5 rounded-full bg-primary-500/10 text-primary-400">{{ $project->category }}</span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed line-clamp-2">{!! Str::limit(strip_tags($project->localized_description), 120) !!}</p>
                    @if($project->tech_stack)
                    <div class="flex flex-wrap gap-1.5 pt-2">
                        @foreach($project->tech_stack as $tech)
                        <span class="text-xs px-2 py-1 rounded-md bg-dark-800 text-slate-500 font-mono">{{ $tech }}</span>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
