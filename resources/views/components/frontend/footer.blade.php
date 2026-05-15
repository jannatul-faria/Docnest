<!-- Footer -->
<footer class="bg-white border-t border-slate-100 pt-20 pb-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            <div class="col-span-1 md:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center mb-6">
                    @if(get_setting('logo'))
                        <img src="{{ asset('storage/' . get_setting('logo')) }}" alt="{{ get_setting('site_name', 'DocNest') }}" class="h-8 w-auto">
                    @else
                        <div class="h-8 w-8 bg-primary rounded-lg flex items-center justify-center shadow-md">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <span class="ml-2 text-xl font-black text-heading">{{ get_setting('site_name', 'DocNest') }}</span>
                    @endif
                </a>
                <p class="text-slate-500 text-sm leading-relaxed mb-6">
                    Empowering patients to find the best healthcare providers with ease and confidence.
                </p>
                <div class="flex space-x-4">
                    @if(get_setting('social_facebook'))
                        <a href="{{ get_setting('social_facebook') }}" target="_blank" class="h-10 w-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-primary hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.324v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                        </a>
                    @endif
                    @if(get_setting('social_twitter'))
                        <a href="{{ get_setting('social_twitter') }}" target="_blank" class="h-10 w-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-primary hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                    @endif
                    @if(get_setting('social_linkedin'))
                        <a href="{{ get_setting('social_linkedin') }}" target="_blank" class="h-10 w-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-primary hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                    @endif
                    @if(get_setting('social_instagram'))
                        <a href="{{ get_setting('social_instagram') }}" target="_blank" class="h-10 w-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-primary hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    @endif
                </div>
            </div>

            <div>
                <h4 class="text-sm font-black text-heading uppercase tracking-widest mb-6">Top Specialties</h4>
                <ul class="space-y-4">
                    @foreach(\App\Models\Department::where('status', 1)->take(5)->get() as $dept)
                        <li><a href="{{ route('home') }}?department={{ $dept->slug }}" class="text-slate-500 hover:text-primary text-sm font-medium transition-colors">{{ $dept->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="text-sm font-black text-heading uppercase tracking-widest mb-6">Support</h4>
                <ul class="space-y-4">
                    <li><a href="#" class="text-slate-500 hover:text-primary text-sm font-medium transition-colors">Help Center</a></li>
                    <li><a href="#" class="text-slate-500 hover:text-primary text-sm font-medium transition-colors">Terms of Service</a></li>
                    <li><a href="#" class="text-slate-500 hover:text-primary text-sm font-medium transition-colors">Privacy Policy</a></li>
                    <li><a href="#" class="text-slate-500 hover:text-primary text-sm font-medium transition-colors">Contact Us</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-sm font-black text-heading uppercase tracking-widest mb-6">Download App</h4>
                <p class="text-slate-500 text-sm mb-6">Access healthcare on the go. Available soon on all platforms.</p>
                <div class="flex flex-col space-y-3">
                    <div class="h-10 w-32 bg-slate-900 rounded-lg flex items-center justify-center text-white text-[10px] space-x-2">
                         <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.523 15.341c-.551 0-1 .449-1 1 0 .552.449 1 1 1 .552 0 1-.448 1-1 0-.551-.448-1-1-1zm-11.046 0c-.551 0-1 .449-1 1 0 .552.449 1 1 1 .552 0 1-.448 1-1 0-.551-.448-1-1-1zm14.477-4.102c-.313-.427-.751-.734-1.258-.887l-.463-.138c-.377-.113-.679-.408-.809-.789l-.164-.486c-.235-.694-.85-1.168-1.554-1.168-.184 0-.363.031-.532.091l-.101.037c-.365.133-.77.104-1.112-.08l-.442-.238c-.643-.347-1.423-.347-2.066 0l-.442.238c-.342.184-.747.213-1.112.08l-.101-.037c-.169-.06-.348-.091-.532-.091-.704 0-1.319.474-1.554 1.168l-.164.486c-.13.381-.432.676-.809.789l-.463.138c-.507.153-.945.46-1.258.887l-.286.388c-.232.316-.312.715-.221 1.1l.123.518c.094.394.043.806-.145 1.16l-.234.44c-.337.635-.337 1.396 0 2.031l.234.44c.188.354.239.766.145 1.16l-.123.518c-.091.385-.011.784.221 1.1l.286.388c.313.427.751.734 1.258.887l.463.138c.377.113.679.408.809.789l.164.486c.235.694.85 1.168 1.554 1.168.184 0 .363-.031.532-.091l.101-.037c.365-.133.77-.104 1.112.08l.442.238c.322.173.693.261 1.033.261s.711-.088 1.033-.261l.442-.238c.342-.184.747-.213 1.112-.08l.101.037c.169.06.348.091.532.091.704 0 1.319-.474 1.554-1.168l.164-.486c.13-.381.432-.676.809-.789l.463-.138c.507-.153.945-.46 1.258-.887l.286-.388c.232-.316.312-.715.221-1.1l-.123-.518c-.094-.394-.043-.806.145-1.16l.234-.44c.337-.635.337-1.396 0-2.031l-.234-.44c-.188-.354-.239-.766-.145-1.16l.123-.518c.091-.385.011-.784-.221-1.1l-.286-.388zm-2.023 6.659c-.551 0-1-.449-1-1 0-.552.449-1 1-1 .552 0 1 .448 1-1 0-.551-.448-1-1-1zm-6.046 0c-.551 0-1-.449-1-1 0-.552.449-1 1-1 .552 0 1 .448 1-1 0-.551-.448-1-1-1z"/></svg>
                         <span>App Store</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="border-t border-slate-50 pt-10 flex flex-col md:flex-row justify-between items-center">
            <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">{{ get_setting('footer_text', '© ' . date('Y') . ' Docnest. All rights reserved.') }}</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <span class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Built with Love for Healthcare</span>
            </div>
        </div>
    </div>
</footer>
