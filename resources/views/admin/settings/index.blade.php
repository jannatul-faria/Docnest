<x-admin-layout>
    <x-slot name="header">Site Settings</x-slot>

    <div class="max-w-6xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">System Configuration</h1>
            <p class="text-sm text-slate-500 font-medium">Manage your website identity, appearance, and contact details</p>
        </div>

        <div x-data="{ tab: 'general' }" class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <!-- Tabs Navigation -->
            <div class="flex border-b border-slate-100 bg-slate-50/50 p-1">
                <button @click="tab = 'general'" :class="tab === 'general' ? 'bg-white text-primary shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="flex-1 py-3 px-4 rounded-xl text-sm font-bold transition-all flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    General
                </button>
                <button @click="tab = 'appearance'" :class="tab === 'appearance' ? 'bg-white text-primary shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="flex-1 py-3 px-4 rounded-xl text-sm font-bold transition-all flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.828 2.828a2 2 0 010 2.828l-8.486 8.486L5 21"></path></svg>
                    Appearance
                </button>
                <button @click="tab = 'contact'" :class="tab === 'contact' ? 'bg-white text-primary shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="flex-1 py-3 px-4 rounded-xl text-sm font-bold transition-all flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Contact
                </button>
                <button @click="tab = 'social'" :class="tab === 'social' ? 'bg-white text-primary shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="flex-1 py-3 px-4 rounded-xl text-sm font-bold transition-all flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    Social
                </button>
            </div>

            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                @method('PUT')

                <!-- General Settings -->
                <div x-show="tab === 'general'" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Site Name</label>
                            <input type="text" name="site_name" value="{{ get_setting('site_name', 'Docnest') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary/10 focus:border-primary transition-all font-medium text-slate-700">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Site Title</label>
                            <input type="text" name="site_title" value="{{ get_setting('site_title', 'Docnest - Find Best Doctors') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary/10 focus:border-primary transition-all font-medium text-slate-700">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                        <div class="space-y-4">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest block">Site Logo</label>
                            <div class="flex items-center space-x-4">
                                <div class="h-16 w-16 bg-slate-100 rounded-2xl flex items-center justify-center overflow-hidden border border-slate-200">
                                    @if(get_setting('logo'))
                                        <img src="{{ asset('storage/' . get_setting('logo')) }}" class="h-full w-full object-contain">
                                    @else
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2-2v12a2 2 0 002 2z"></path></svg>
                                    @endif
                                </div>
                                <input type="file" name="logo" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition-all">
                            </div>
                        </div>
                        <div class="space-y-4">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest block">Favicon</label>
                            <div class="flex items-center space-x-4">
                                <div class="h-12 w-12 bg-slate-100 rounded-xl flex items-center justify-center overflow-hidden border border-slate-200">
                                    @if(get_setting('favicon'))
                                        <img src="{{ asset('storage/' . get_setting('favicon')) }}" class="h-8 w-8 object-contain">
                                    @else
                                        <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    @endif
                                </div>
                                <input type="file" name="favicon" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition-all">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2 pt-4">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Footer Copyright Text</label>
                        <textarea name="footer_text" rows="3" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary/10 focus:border-primary transition-all font-medium text-slate-700">{{ get_setting('footer_text', '© 2026 Docnest. All rights reserved.') }}</textarea>
                    </div>
                </div>

                <!-- Appearance Settings -->
                <div x-show="tab === 'appearance'" class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest block">Primary Color</label>
                            <div class="flex items-center space-x-3">
                                <input type="color" name="primary_color" value="{{ get_setting('primary_color', '#008947') }}" class="h-12 w-12 rounded-lg border-0 p-0 overflow-hidden cursor-pointer">
                                <input type="text" value="{{ get_setting('primary_color', '#008947') }}" readonly class="flex-1 px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-500 font-mono">
                            </div>
                            <p class="text-[10px] text-slate-400 font-medium">Used for buttons, links, and primary accents.</p>
                        </div>
                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest block">Heading Color</label>
                            <div class="flex items-center space-x-3">
                                <input type="color" name="heading_color" value="{{ get_setting('heading_color', '#1e293b') }}" class="h-12 w-12 rounded-lg border-0 p-0 overflow-hidden cursor-pointer">
                                <input type="text" value="{{ get_setting('heading_color', '#1e293b') }}" readonly class="flex-1 px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-500 font-mono">
                            </div>
                            <p class="text-[10px] text-slate-400 font-medium">Used for H1, H2, and important titles.</p>
                        </div>
                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest block">Background Color</label>
                            <div class="flex items-center space-x-3">
                                <input type="color" name="bg_color" value="{{ get_setting('bg_color', '#f8fafc') }}" class="h-12 w-12 rounded-lg border-0 p-0 overflow-hidden cursor-pointer">
                                <input type="text" value="{{ get_setting('bg_color', '#f8fafc') }}" readonly class="flex-1 px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm text-slate-500 font-mono">
                            </div>
                            <p class="text-[10px] text-slate-400 font-medium">Site-wide body background color.</p>
                        </div>
                    </div>

                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200">
                        <div class="flex items-start space-x-4">
                            <div class="p-2 bg-amber-100 rounded-lg">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">Preview Hint</h4>
                                <p class="text-xs text-slate-500 mt-1 leading-relaxed">Colors will be applied to the frontend using CSS variables. Some elements might require a hard refresh to reflect changes.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Settings -->
                <div x-show="tab === 'contact'" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Support Email</label>
                            <input type="email" name="contact_email" value="{{ get_setting('contact_email', 'support@docnest.com') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary/10 focus:border-primary transition-all font-medium text-slate-700">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Phone Number</label>
                            <input type="text" name="contact_phone" value="{{ get_setting('contact_phone', '+880 1234 567890') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary/10 focus:border-primary transition-all font-medium text-slate-700">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Office Address</label>
                        <input type="text" name="contact_address" value="{{ get_setting('contact_address', '123 Medical Street, Dhaka, Bangladesh') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary/10 focus:border-primary transition-all font-medium text-slate-700">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Google Maps Embed URL</label>
                        <input type="text" name="google_maps_url" value="{{ get_setting('google_maps_url') }}" placeholder="https://www.google.com/maps/embed?pb=..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary/10 focus:border-primary transition-all font-medium text-slate-700">
                    </div>
                </div>

                <!-- Social Settings -->
                <div x-show="tab === 'social'" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Facebook URL</label>
                            <input type="url" name="social_facebook" value="{{ get_setting('social_facebook') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary/10 focus:border-primary transition-all font-medium text-slate-700">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Twitter URL</label>
                            <input type="url" name="social_twitter" value="{{ get_setting('social_twitter') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary/10 focus:border-primary transition-all font-medium text-slate-700">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest">LinkedIn URL</label>
                            <input type="url" name="social_linkedin" value="{{ get_setting('social_linkedin') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary/10 focus:border-primary transition-all font-medium text-slate-700">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black text-slate-400 uppercase tracking-widest">Instagram URL</label>
                            <input type="url" name="social_instagram" value="{{ get_setting('social_instagram') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary/10 focus:border-primary transition-all font-medium text-slate-700">
                        </div>
                    </div>
                </div>


                <div class="mt-10 pt-6 border-t border-slate-100 flex items-center justify-between">
                    <p class="text-xs text-slate-400 font-medium italic">All changes are saved instantly to the database.</p>
                    <button type="submit" class="inline-flex items-center px-8 py-3 bg-primary text-white rounded-xl text-sm font-black hover:bg-primary/90 transition-all shadow-lg shadow-primary/20 active:scale-95">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Save Configuration
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
