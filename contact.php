<?php include('partials-frontend/menu.php'); ?>

<!-- Contact Hero Banner Starts Here -->
<section class="relative bg-stone-900 text-white overflow-hidden py-16 sm:py-24 bg-cover bg-center"
         style="background-image: linear-gradient(180deg, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.65) 50%, rgba(0,0,0,0.85) 100%), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1600&q=80'), url('images/bg.jpg');">
  <div class="container mx-auto px-4 text-center max-w-4xl relative z-10">
    <span class="inline-block bg-orange-600/90 backdrop-blur-md text-white text-xs font-extrabold px-4 py-1.5 rounded-full mb-4 uppercase tracking-widest border border-orange-400/40 shadow-lg">
      GET IN TOUCH 📞
    </span>
    <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight mb-4 text-white drop-shadow-md">
      We'd Love To Hear From You
    </h1>
    <p class="text-stone-200 text-base sm:text-xl font-medium max-w-2xl mx-auto drop-shadow-sm leading-relaxed">
      Have questions, order feedback, or partnership inquiries? Our team is always here to assist.
    </p>
  </div>
</section>
<!-- Contact Hero Banner Ends Here -->

<section class="py-16 bg-stone-50 min-h-[60vh] flex items-center justify-center">
    <div class="container mx-auto px-4 max-w-xl">
        <div class="bg-white shadow-xl rounded-3xl p-8 sm:p-10 border border-stone-200/70 text-center">
            <span class="text-xs font-extrabold uppercase tracking-widest text-orange-600 bg-orange-100 px-3.5 py-1.5 rounded-full mb-3 inline-block">Direct Support</span>
            <h2 class="text-3xl font-extrabold text-stone-900 tracking-tight mb-3">Contact Details</h2>
            <p class="text-stone-500 font-medium mb-8 text-sm">Reach out to us directly through any of the channels below.</p>

            <div class="space-y-4 mb-8">
                <div class="p-4 bg-stone-50 rounded-2xl border border-stone-200/60 flex items-center gap-4 text-left hover:border-orange-200 transition">
                    <div class="w-11 h-11 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center flex-shrink-0 shadow-xs">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-stone-400 font-bold uppercase tracking-wider">Email Support</p>
                        <a href="mailto:md.saadman.fuad@gmail.com" class="text-stone-900 font-extrabold hover:text-orange-600 transition">
                            md.saadman.fuad@gmail.com
                        </a>
                    </div>
                </div>

                <div class="p-4 bg-stone-50 rounded-2xl border border-stone-200/60 flex items-center gap-4 text-left hover:border-orange-200 transition">
                    <div class="w-11 h-11 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center flex-shrink-0 shadow-xs">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-stone-400 font-bold uppercase tracking-wider">Kitchen Location</p>
                        <p class="text-stone-900 font-extrabold">Dhaka, Bangladesh</p>
                    </div>
                </div>
            </div>

            <a href="<?php echo SITEURL; ?>" class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-amber-500 hover:from-orange-600 hover:to-amber-600 text-white font-extrabold px-8 py-3.5 rounded-xl shadow-md hover:shadow-lg transition transform hover:scale-[1.02] active:scale-95">
                <span>Return to Home</span>
            </a>
        </div>
    </div>
</section>

<?php include('partials-frontend/footer.php'); ?>
