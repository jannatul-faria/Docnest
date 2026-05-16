<!-- Footer -->
<footer class="bg-[#1c8251] pt-20 pb-10 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-16">
            <div class="col-span-1">
                <a href="{{ route('home') }}" class="flex items-center mb-6">
                    @if(get_setting('logo'))
                        <img src="{{ asset('storage/' . get_setting('logo')) }}"
                            alt="{{ get_setting('site_name', 'DocNest') }}" class="h-8 w-auto">
                    @else
                        <span
                            class="text-3xl font-black tracking-tight text-white">{{ get_setting('site_name', 'DocNest') }}</span>
                    @endif
                </a>
                <p class="text-white/80 text-sm leading-relaxed mb-8 max-w-xs">
                    {{ get_setting('footer_description', 'Experience world-class healthcare with our network of certified specialists. Read reviews, check availability, and build your personalized healthcare network.') }}
                </p>
                <div class="flex space-x-4">
                    @if(get_setting('facebook_url'))
                        <a href="{{ get_setting('facebook_url') }}" target="_blank"
                            class="h-10 w-10 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-[#1c8251] transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.324v-21.35c0-.732-.593-1.325-1.325-1.325z" />
                            </svg>
                        </a>
                    @endif
                    @if(get_setting('twitter_url'))
                        <a href="{{ get_setting('twitter_url') }}" target="_blank"
                            class="h-10 w-10 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-[#1c8251] transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                    @endif
                    @if(get_setting('instagram_url'))
                        <a href="{{ get_setting('instagram_url') }}" target="_blank"
                            class="h-10 w-10 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white hover:text-[#1c8251] transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>

            <div>
                <p class="text-lg font-bold mb-6">Quick Links</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('home') }}" class="text-white/70 hover:text-white transition-colors">Home</a>
                    </li>
                    <li><a href="{{ route('about') }}" class="text-white/70 hover:text-white transition-colors">About
                            Us</a></li>
                    <li><a href="{{ route('doctors.index') }}"
                            class="text-white/70 hover:text-white transition-colors">Doctors</a></li>
                    <li><a href="{{ route('departments.index') }}"
                            class="text-white/70 hover:text-white transition-colors">Departments</a></li>
                </ul>
            </div>

            <div>
                <p class="text-lg font-bold mb-6">Support</h4>
                <ul class="space-y-4">
                    <li><a href="#" class="text-white/70 hover:text-white transition-colors">Contact Us</a></li>
                    <li><a href="#" class="text-white/70 hover:text-white transition-colors">Privacy Policy</a></li>
                    <li><a href="#" class="text-white/70 hover:text-white transition-colors">Terms & Conditions</a></li>
                    <li><a href="#" class="text-white/70 hover:text-white transition-colors">Disclaimer</a></li>
                </ul>
            </div>


        </div>

        <div class="border-t border-white/10 pt-10 text-center">
            <p class="text-white/60 text-sm">All Rights Reserved © {{ get_setting('site_name', 'DocNest') }}
                {{ date('Y') }}
            </p>
        </div>
    </div>
</footer>>