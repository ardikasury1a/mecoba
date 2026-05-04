<section id="skills" class="relative py-24 lg:py-32 bg-dark-950/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div x-data="{ visible: false }" x-intersect.once="visible = true"
             :class="visible ? 'animate-fade-in-up' : 'opacity-0'"
             class="text-center mb-16 space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium uppercase tracking-widest text-accent-400 bg-accent-500/10 border border-accent-500/20">
                {{ __('Skills') }}
            </div>
            <h2 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-bold text-white">
                {{ __('My') }} <span class="gradient-text">{{ __('Tech Stack') }}</span>
            </h2>
            <p class="text-slate-400 max-w-2xl mx-auto text-lg">{{ __('Technologies and tools I use to bring ideas to life') }}</p>
        </div>

        <div class="space-y-12">
            @foreach($categories as $category)
                <div x-data="{ visible: false }" x-intersect.once="visible = true"
                     :class="visible ? 'animate-fade-in-up' : 'opacity-0'">
                    <h3 class="text-lg font-heading font-semibold text-white mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg flex items-center justify-center text-sm">
                            @if($category === 'Frontend') 🎨
                            @elseif($category === 'Backend') ⚙️
                            @elseif($category === 'DevOps') 🚀
                            @elseif($category === 'Design') 🖌️
                            @else 💡
                            @endif
                        </span>
                        {{ $category }}
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($skills->where('category', $category) as $index => $skill)
                            <div x-data="{ visible: false, width: 0 }"
                                 x-intersect.once="visible = true; setTimeout(() => width = {{ $skill->level }}, 300)"
                                 :class="visible ? 'animate-scale-in' : 'opacity-0'"
                                 style="animation-delay: {{ $index * 100 }}ms"
                                 class="glass rounded-2xl p-5 hover:bg-white/5 transition-all duration-300 glow-hover group cursor-default">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-3">
                                        <span class="text-xl">
                                            @switch($skill->icon)
                                                @case('laravel') 🔺 @break
                                                @case('php') 🐘 @break
                                                @case('javascript') ⚡ @break
                                                @case('tailwind') 🌊 @break
                                                @case('vue') 💚 @break
                                                @case('alpine') 🏔️ @break
                                                @case('livewire') ⚡ @break
                                                @case('docker') 🐳 @break
                                                @case('git') 📦 @break
                                                @case('figma') 🎨 @break
                                                @case('database') 🗄️ @break
                                                @case('api') 🔗 @break
                                                @default 💻
                                            @endswitch
                                        </span>
                                        <span class="font-semibold text-white">{{ $skill->name }}</span>
                                    </div>
                                    <span class="text-sm font-mono text-primary-400">{{ $skill->level }}%</span>
                                </div>
                                <div class="h-2 bg-dark-800 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full bg-gradient-to-r from-primary-500 to-violet-500 progress-bar"
                                         :style="'width: ' + width + '%'"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
