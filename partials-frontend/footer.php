</main>

<!-- Social Section Starts Here -->
<section class="bg-stone-100/80 border-t border-stone-200/60 py-8 mt-16">
  <div class="container mx-auto px-4 text-center">
    <p class="text-xs uppercase tracking-widest text-stone-400 font-bold mb-4">Connect With Us</p>
    <ul class="flex flex-wrap justify-center gap-5">
      <li>
        <a href="https://www.facebook.com/Saadman.Fuad.1999/" target="_blank" rel="noopener noreferrer"
           class="inline-block p-2.5 bg-white rounded-full shadow-sm hover:shadow-md transition-all duration-300 transform hover:scale-110 border border-stone-200/60">
          <img src="https://img.icons8.com/fluent/50/000000/facebook-new.png" alt="Facebook" class="w-8 h-8" />
        </a>
      </li>
      <li>
        <a href="https://www.instagram.com/saadman_fuad/" target="_blank" rel="noopener noreferrer"
           class="inline-block p-2.5 bg-white rounded-full shadow-sm hover:shadow-md transition-all duration-300 transform hover:scale-110 border border-stone-200/60">
          <img src="https://img.icons8.com/fluent/48/000000/instagram-new.png" alt="Instagram" class="w-8 h-8" />
        </a>
      </li>
      <li>
        <a href="https://www.linkedin.com/in/saadmanfuad/" target="_blank" rel="noopener noreferrer"
           class="inline-block p-2.5 bg-white rounded-full shadow-sm hover:shadow-md transition-all duration-300 transform hover:scale-110 border border-stone-200/60">
          <img src="https://img.icons8.com/fluent/48/000000/linkedin.png" alt="LinkedIn" class="w-8 h-8" />
        </a>
      </li>
      <li>
        <a href="https://www.youtube.com/@MD.SaadmanFuad" target="_blank" rel="noopener noreferrer"
           class="inline-block p-2.5 bg-white rounded-full shadow-sm hover:shadow-md transition-all duration-300 transform hover:scale-110 border border-stone-200/60">
          <img src="https://img.icons8.com/fluent/48/000000/youtube.png" alt="YouTube" class="w-8 h-8" />
        </a>
      </li>
    </ul>
  </div>
</section>
<!-- Social Section Ends Here -->

<!-- Footer Section Starts Here -->
<footer class="bg-stone-900 text-stone-400 py-6 border-t border-stone-800">
  <div class="container mx-auto px-4 text-center">
    <p class="text-sm font-medium">&copy; <?php echo date('Y'); ?> <span class="text-orange-400 font-semibold">Ki Khabo</span>. Crafted with care by Saadman Fuad.</p>
  </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // 1. Mobile Menu Toggle
  const mobileMenuBtn = document.getElementById('mobileMenuBtn');
  const mobileMenu = document.getElementById('mobileMenu');
  if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  }

  // 2. Smooth Top Progress Bar for Internal Navigation
  const progress = document.getElementById('pageProgress');
  document.querySelectorAll('a[href]').forEach(link => {
    link.addEventListener('click', (e) => {
      const target = link.getAttribute('href');
      if (target && !target.startsWith('#') && !target.startsWith('javascript:') && !link.hasAttribute('target')) {
        if (progress) {
          progress.style.opacity = '1';
          progress.style.width = '75%';
        }
      }
    });
  });

  // 3. Scroll Reveal Observer for Cards
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -30px 0px'
  };

  const scrollObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  document.querySelectorAll('.reveal-on-scroll, .animate-slide-up').forEach(el => {
    scrollObserver.observe(el);
  });

  // 4. Smooth Image Fade-in Loader
  document.querySelectorAll('img').forEach(img => {
    img.classList.add('img-smooth');
    if (img.complete) {
      img.classList.add('loaded');
    } else {
      img.addEventListener('load', () => {
        img.classList.add('loaded');
      });
    }
  });
});
</script>
</body>
</html>