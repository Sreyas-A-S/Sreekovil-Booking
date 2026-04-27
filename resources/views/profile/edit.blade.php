@extends('layouts.app')

@section('header', 'My Profile')

@section('content')
    <div class="max-w-4xl mx-auto space-y-10 pb-20">
        <!-- Profile Information Card -->
        <div
            class="bg-white rounded-[2rem] shadow-xl shadow-maroon-900/5 border border-maroon-900/5 overflow-hidden ring-1 ring-black/5">
            <div class="bg-gradient-to-r from-maroon-900 to-maroon-800 p-8 text-white relative overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10 pointer-events-none"
                    style="background-image: radial-gradient(circle at 2px 2px, #e7c033 1px, transparent 0); background-size: 24px 24px;">
                </div>

                <div class="relative z-10 flex items-center gap-6">
                    <div
                        class="w-20 h-20 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center border border-white/20 shadow-inner">
                        <i data-lucide="user" class="w-10 h-10 text-saffron-400"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold font-display uppercase tracking-widest">Personal Details</h3>
                        <p class="text-maroon-200 text-sm mt-1">Manage your administrator account information and contact
                            details.</p>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <form method="POST" action="{{ route('admin.profile.update') }}" class="space-y-8">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Name -->
                        <div class="space-y-2">
                            <label for="name" class="text-sm font-bold text-slate-700 flex items-center gap-2">
                                <i data-lucide="user-pen" class="w-4 h-4 text-slate-400"></i>
                                Name
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                class="w-full px-5 py-3.5 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-saffron-100 focus:border-saffron-400 transition-all outline-none"
                                placeholder="Your full name">
                            @error('name') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <!-- Email -->
                        <div class="space-y-2">
                            <label for="email" class="text-sm font-bold text-slate-700 flex items-center gap-2">
                                <i data-lucide="mail" class="w-4 h-4 text-slate-400"></i>
                                Email Address
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                                class="w-full px-5 py-3.5 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-saffron-100 focus:border-saffron-400 transition-all outline-none"
                                placeholder="name@example.com">
                            @error('email') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <!-- Phone (New Field) -->
                        <div class="space-y-2">
                            <label for="phone" class="text-sm font-bold text-slate-700 flex items-center gap-2">
                                <i data-lucide="phone" class="w-4 h-4 text-slate-400"></i>
                                Contact Phone
                            </label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                                class="w-full px-5 py-3.5 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-saffron-100 focus:border-saffron-400 transition-all outline-none"
                                placeholder="+91 98765 43210">
                            @error('phone') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit"
                            class="bg-gradient-to-r from-saffron-500 to-saffron-600 hover:from-saffron-600 hover:to-saffron-700 text-white px-10 py-3.5 rounded-2xl font-bold transition-all shadow-lg shadow-saffron-500/20 active:scale-95 flex items-center gap-3">
                            <i data-lucide="save" class="w-5 h-5"></i>
                            Save Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Security Card (Update Password) -->
        <div
            class="bg-white rounded-[2rem] shadow-xl shadow-maroon-900/5 border border-maroon-900/5 overflow-hidden ring-1 ring-black/5">
            <div class="bg-gradient-to-r from-slate-900 to-slate-800 p-8 text-white relative overflow-hidden">
                <div
                    class="absolute inset-x-0 bottom-0 h-px bg-gradient-to-r from-transparent via-gold-500/50 to-transparent">
                </div>

                <div class="relative z-10 flex items-center gap-6">
                    <div
                        class="w-20 h-20 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center border border-white/20 shadow-inner">
                        <i data-lucide="shield-check" class="w-10 h-10 text-gold-400"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold font-display uppercase tracking-widest">Security Settings</h3>
                        <p class="text-slate-300 text-sm mt-1">Keep your account secure by regularly updating your access
                            credential.</p>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <form method="POST" action="{{ route('admin.profile.password.update') }}" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="space-y-8">
                        <div class="space-y-2 max-w-md">
                            <label for="current_password" class="text-sm font-bold text-slate-700 flex items-center gap-2">
                                <i data-lucide="lock-keyhole" class="w-4 h-4 text-slate-400"></i>
                                Current Password
                            </label>
                            <input type="password" name="current_password" id="current_password" required
                                class="w-full px-5 py-3.5 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-slate-100 focus:border-slate-400 transition-all outline-none">
                            @error('current_password') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 border-t border-slate-100 pt-8">
                            <div class="space-y-2">
                                <label for="password" class="text-sm font-bold text-slate-700 flex items-center gap-2">
                                    <i data-lucide="key-round" class="w-4 h-4 text-slate-400"></i>
                                    New Password
                                </label>
                                <input type="password" name="password" id="password" required
                                    class="w-full px-5 py-3.5 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-slate-100 focus:border-slate-400 transition-all outline-none">
                                @error('password') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="password_confirmation"
                                    class="text-sm font-bold text-slate-700 flex items-center gap-2">
                                    <i data-lucide="shield-check" class="w-4 h-4 text-slate-400"></i>
                                    Confirm New Password
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                    class="w-full px-5 py-3.5 rounded-2xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-slate-100 focus:border-slate-400 transition-all outline-none">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit"
                            class="bg-slate-800 hover:bg-slate-900 text-white px-10 py-3.5 rounded-2xl font-bold transition-all shadow-lg active:scale-95 flex items-center gap-3">
                            <i data-lucide="key" class="w-5 h-5"></i>
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection