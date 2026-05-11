<div class="min-h-screen flex items-center justify-center bg-[#050507] relative overflow-hidden font-sans">
    {{-- Background Effects --}}
    <div class="absolute inset-0">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-accent-500/5 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-emerald-500/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-br from-accent-500/3 to-emerald-500/3 rounded-full blur-3xl"></div>
    </div>

    {{-- Grid Pattern --}}
    <div class="absolute inset-0 opacity-[0.015]" style="background-image: linear-gradient(rgba(255,255,255,0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 50px 50px;"></div>

    {{-- Login Card --}}
    <div class="relative z-10 w-full max-w-md mx-4">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-accent-500 to-emerald-600 p-[2px] mb-4">
                <div class="w-full h-full rounded-[14px] bg-[#0a0d14] flex items-center justify-center">
                    <span class="text-2xl font-black text-accent-500">TF</span>
                </div>
            </div>
            <h1 class="text-2xl font-black uppercase tracking-tight text-white">Trading <span class="text-accent-500">For Living</span></h1>
            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-[0.3em] mt-2">Secure Access Portal</p>
        </div>

        {{-- Form Card --}}
        <div class="p-8 rounded-[2rem] bg-[#0a0d14]/80 border border-white/5 backdrop-blur-xl relative overflow-hidden">
            {{-- Glow effect --}}
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-40 h-[1px] bg-gradient-to-r from-transparent via-accent-500/50 to-transparent"></div>

            {{-- Error Message --}}
            @if($errorMessage)
            <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 flex items-center gap-3">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="text-xs font-bold text-red-400">{{ $errorMessage }}</span>
            </div>
            @endif

            <form wire:submit.prevent="login" class="space-y-5">
                {{-- Email --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Email Address</label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                        </div>
                        <input type="email" wire:model="email" placeholder="your@email.com" id="login-email"
                            class="w-full bg-black/40 border border-white/5 rounded-xl pl-11 pr-4 py-3 text-sm text-white placeholder-slate-600 focus:border-accent-500 focus:ring-1 focus:ring-accent-500/20 transition-all outline-none">
                    </div>
                    @error('email') <span class="text-[10px] font-bold text-red-400 ml-1">{{ $message }}</span> @enderror
                </div>

                {{-- Password --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest ml-1">Password</label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <input type="password" wire:model="password" placeholder="••••••••" id="login-password"
                            class="w-full bg-black/40 border border-white/5 rounded-xl pl-11 pr-4 py-3 text-sm text-white placeholder-slate-600 focus:border-accent-500 focus:ring-1 focus:ring-accent-500/20 transition-all outline-none">
                    </div>
                    @error('password') <span class="text-[10px] font-bold text-red-400 ml-1">{{ $message }}</span> @enderror
                </div>

                {{-- Submit --}}
                <button type="submit" id="login-submit"
                    class="w-full py-3.5 bg-gradient-to-r from-accent-500 to-emerald-500 text-dark-950 rounded-xl text-[11px] font-black uppercase tracking-[0.2em] hover:from-accent-400 hover:to-emerald-400 transition-all shadow-lg shadow-accent-500/20 hover:shadow-accent-500/40 relative overflow-hidden group">
                    <span class="relative z-10 flex items-center justify-center gap-2" wire:loading.remove wire:target="login">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                        Sign In
                    </span>
                    <span class="relative z-10 flex items-center justify-center gap-2" wire:loading wire:target="login">
                        <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/></svg>
                        Authenticating...
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                </button>
            </form>

            {{-- Footer --}}
            <div class="mt-6 pt-6 border-t border-white/5 text-center">
                <p class="text-[9px] font-bold text-slate-600 uppercase tracking-[0.2em]">Protected Trading Environment</p>
            </div>
        </div>

        {{-- Bottom Text --}}
        <p class="text-center mt-6 text-[9px] font-bold text-slate-700 uppercase tracking-widest">&copy; {{ date('Y') }} Trading For Living</p>
    </div>

    <style>
        .bg-dashboard {
            background: radial-gradient(circle at top right, #0f172a, #05070a);
        }
    </style>
</div>
