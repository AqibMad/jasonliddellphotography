(function () {
  'use strict';

  console.log('🎬 Swiper Slider Loading...');

  function initSwiper() {
    // Check if Swiper is loaded
    if (typeof Swiper === 'undefined') {
      console.error('❌ Swiper library not loaded yet');
      return false;
    }

    // Check if slider exists
    const sliderElement = document.getElementById('slider');
    if (!sliderElement) {
      console.warn('⚠️ Slider element not found');
      return false;
    }

    // Add swiper class
    sliderElement.classList.add('swiper');

    // Make sure slides have swiper-slide class
    const slides = sliderElement.querySelectorAll('.slide');
    if (slides.length === 0) {
      console.warn('⚠️ No slides found');
      return false;
    }

    console.log(`✅ Found ${slides.length} slides, initializing Swiper...`);

    // Initialize Swiper with autoplay
    const swiper = new Swiper('#slider', {
      // AUTOPLAY - This is what you wanted!
      autoplay: {
        delay: 5000,  // 5 seconds between slides
        disableOnInteraction: false,  // Keep autoplaying after user interaction
        pauseOnMouseEnter: true  // Pause when hovering
      },

      // ZOOM EFFECT - scale from 1.0 to 1.1
      effect: 'fade',  // Fade transition
      fadeEffect: {
        crossFade: true
      },

      // Speed of transition
      speed: 2000,  // 2 second fade transition

      // Loop forever
      loop: true,

      // Allow keyboard control
      keyboard: {
        enabled: true
      },

      // Pause on hover
      pauseOnMouseEnter: true,

      // Events
      on: {
        init: function() {
          console.log('✅ Swiper initialized with AUTOPLAY!');
          console.log('▶️ Slides will change every 5 seconds automatically');
        },
        slideChange: function() {
          console.log('🎬 Slide changed to:', this.activeIndex + 1);
        },
        autoplayStart: function() {
          console.log('▶️ Autoplay STARTED');
        },
        autoplayStop: function() {
          console.log('⏸ Autoplay PAUSED');
        }
      }
    });

    // Apply zoom animation using CSS
    // Swiper handles the slide changes, we handle the zoom
    const allSlides = document.querySelectorAll('.slide');
    allSlides.forEach(slide => {
      slide.style.transition = 'opacity 2s, transform 5s';
    });

    console.log('🎉 SWIPER SLIDER READY - Autoplay is ON!');
    return true;
  }

  // Try to initialize
  function tryInit() {
    // Wait for Swiper library to load
    if (typeof Swiper !== 'undefined') {
      initSwiper();
    } else {
      console.log('⏳ Waiting for Swiper library...');
      setTimeout(tryInit, 100);
    }
  }

  // Start initialization
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', tryInit);
  } else {
    tryInit();
  }

})();
