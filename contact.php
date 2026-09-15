<?php include('partials-frontend/menu.php'); ?>

<section class="py-16 bg-stone-50 min-h-[70vh] flex items-center justify-center">
    <div class="container mx-auto px-4 max-w-xl">
        <div class="bg-white shadow-xl rounded-2xl p-8 sm:p-10 border border-stone-200/70 text-center">
            <span class="text-xs font-extrabold uppercase tracking-widest text-orange-600 bg-orange-100 px-3 py-1 rounded-full mb-3 inline-block">Get In Touch</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-stone-900 tracking-tight mb-3">Contact Us</h1>
            <p class="text-stone-500 font-medium mb-8">Have questions, feedback, or need order support? Feel free to reach out to us anytime.</p>

            <div class="space-y-4 mb-8">
                <div class="p-4 bg-stone-50 rounded-xl border border-stone-200/60 flex items-center gap-4 text-left">
                    <div class="w-10 h-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-stone-400 font-semibold uppercase">Email Us</p>
                        <a href="mailto:md.saadman.fuad@gmail.com" class="text-stone-900 font-bold hover:text-orange-600 transition">
                            md.saadman.fuad@gmail.com
                        </a>
                    </div>
                </div>

                <div class="p-4 bg-stone-50 rounded-xl border border-stone-200/60 flex items-center gap-4 text-left">
                    <div class="w-10 h-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-stone-400 font-semibold uppercase">Location</p>
                        <p class="text-stone-900 font-bold">Dhaka, Bangladesh</p>
                    </div>
                </div>
            </div>

            <a href="<?php echo SITEURL; ?>" class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-bold px-7 py-3 rounded-xl shadow-md transition transform hover:scale-[1.02]">
                <span>Return to Home</span>
            </a>
        </div>
    </div>
</section>

<?php include('partials-frontend/footer.php'); ?>


