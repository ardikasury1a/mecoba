<section id="contact" class="relative py-24 lg:py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div x-data="{ visible: false }" x-intersect.once="visible = true" :class="visible ? 'animate-fade-in-up' : 'opacity-0'" class="text-center mb-16 space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium uppercase tracking-widest text-green-400 bg-green-500/10 border border-green-500/20">{{ __('Contact') }}</div>
            <h2 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-bold text-white">{{ __('Get In') }} <span class="gradient-text">{{ __('Touch') }}</span></h2>
            <p class="text-slate-400 max-w-2xl mx-auto text-lg">{{ __('Have a project in mind? Let\'s talk about it.') }}</p>
        </div>

        <div class="max-w-2xl mx-auto">
            @if($sent)
                <div x-data="{ visible: false }" x-init="visible = true" :class="visible ? 'animate-scale-in' : 'opacity-0'"
                     class="glass rounded-3xl p-12 text-center space-y-4">
                    <div class="w-20 h-20 mx-auto rounded-full bg-green-500/10 flex items-center justify-center">
                        <svg class="w-10 h-10 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <h3 class="text-2xl font-heading font-bold text-white">{{ __('Message Sent!') }}</h3>
                    <p class="text-slate-400">{{ __('Thank you for reaching out. I\'ll get back to you soon.') }}</p>
                    <button wire:click="$set('sent', false)" class="mt-4 px-6 py-3 rounded-xl glass text-slate-300 hover:text-white hover:bg-white/10 transition-all">
                        {{ __('Send Another Message') }}
                    </button>
                </div>
            @else
                <form wire:submit="submit" class="glass rounded-3xl p-8 sm:p-10 space-y-6">
                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-400 mb-2">{{ __('Name') }}</label>
                            <input wire:model="name" type="text" id="name" placeholder="{{ __('Your name') }}"
                                   class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white placeholder-slate-600 focus:outline-none focus:border-primary-500/50 focus:ring-1 focus:ring-primary-500/25 transition-all">
                            @error('name') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-400 mb-2">{{ __('Email') }}</label>
                            <input wire:model="email" type="email" id="email" placeholder="{{ __('your@email.com') }}"
                                   class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white placeholder-slate-600 focus:outline-none focus:border-primary-500/50 focus:ring-1 focus:ring-primary-500/25 transition-all">
                            @error('email') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <label for="subject" class="block text-sm font-medium text-slate-400 mb-2">{{ __('Subject') }}</label>
                        <input wire:model="subject" type="text" id="subject" placeholder="{{ __('What is this about?') }}"
                               class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white placeholder-slate-600 focus:outline-none focus:border-primary-500/50 focus:ring-1 focus:ring-primary-500/25 transition-all">
                        @error('subject') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-slate-400 mb-2">{{ __('Message') }}</label>
                        <textarea wire:model="message" id="message" rows="5" placeholder="{{ __('Tell me about your project...') }}"
                                  class="w-full px-4 py-3 rounded-xl bg-dark-800/50 border border-white/10 text-white placeholder-slate-600 focus:outline-none focus:border-primary-500/50 focus:ring-1 focus:ring-primary-500/25 transition-all resize-none"></textarea>
                        @error('message') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit"
                            class="w-full py-4 rounded-xl bg-gradient-to-r from-primary-500 to-violet-500 font-semibold text-white hover:shadow-lg hover:shadow-primary-500/25 hover:scale-[1.02] transition-all duration-300 flex items-center justify-center gap-2"
                            wire:loading.attr="disabled" wire:loading.class="opacity-75">
                        <span wire:loading.remove>{{ __('Send Message') }} →</span>
                        <span wire:loading>{{ __('Sending...') }}</span>
                    </button>
                </form>
            @endif
        </div>
    </div>
</section>
