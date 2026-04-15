(function () {
  'use strict';

  console.log('═══════════════════════════════════════');
  console.log('🎬 SLIDER SCRIPT LOADED - VERSION 3.0');
  console.log('═══════════════════════════════════════');

  let slider = null;
  let slides = null;
  let currentSlide = 0;
  let autoplayInterval = null;
  let sliderInitialized = false;

  // Check if we're on a page with a slider
  function isSliderPage() {
    return document.getElementById('slider') !== null;
  }

  // Show sidebar with slide-in animation
  function showSidebar() {
    const sidebar = document.querySelector('.sidebar');
    if (sidebar) {
      sidebar.classList.add('sidebar-show');
      console.log('✨✨✨ SIDEBAR SLIDING IN FROM LEFT NOW! ✨✨✨');
    }
  }

  // Simple autoplay function - NO PAUSE ON HOVER
  function startAutoplay() {
    if (autoplayInterval) {
      clearInterval(autoplayInterval);
    }

    if (document.hidden) {
      return;
    }

    autoplayInterval = setInterval(function() {
      if (!document.hidden && slides) {
        // Move to next slide
        const oldSlide = currentSlide;
        currentSlide = (currentSlide + 1) % slides.length;
        
        // Update active class
        slides.forEach(function(slide, index) {
          if (index === currentSlide) {
            slide.classList.add('active');
          } else {
            slide.classList.remove('active');
          }
        });
        
        console.log('▶ Slide changed from', oldSlide + 1, 'to', currentSlide + 1, 'of', slides.length);
        
        // Show sidebar when moving from first slide to second slide
        if (oldSlide === 0 && currentSlide === 1) {
          console.log('🎯 FIRST SLIDE CHANGE DETECTED (1 → 2)');
          showSidebar();
        }
      }
    }, 5000); // 5 seconds

    console.log('✅ Autoplay STARTED (continuous, no hover pause)');
  }

  function stopAutoplay() {
    if (autoplayInterval) {
      clearInterval(autoplayInterval);
      autoplayInterval = null;
      console.log('⏸ Autoplay stopped');
    }
  }

  function initSlider() {
    if (sliderInitialized) {
      return true;
    }

    slider = document.getElementById('slider');
    if (!slider) {
      console.warn('⚠️ #slider element not found');
      return false;
    }

    slides = slider.querySelectorAll('.slide');
    if (!slides || slides.length === 0) {
      console.warn('⚠️ No .slide elements found');
      return false;
    }

    console.log('✅ Slider found:', slides.length, 'slides');
    sliderInitialized = true;

    // ═══════════════════════════════════════════════════════════
    // CRITICAL: Setup first slide ZOOM animation
    // This MUST work for first slide to zoom from 100% to 110%
    // ═══════════════════════════════════════════════════════════
    console.log('');
    console.log('🔧 🔧 🔧 SETTING UP FIRST SLIDE ZOOM 🔧 🔧 🔧');
    console.log('');
    
    // Step 1: Remove active from ALL slides (including first)
    // This resets first slide to scale(1.0)
    slides.forEach(function(slide) {
      slide.classList.remove('active');
    });
    console.log('   ✓ Step 1: All slides deactivated');
    console.log('   ℹ First slide is now at scale(1.0) - 100%');
    
    // Step 2: Force browser reflow MULTIPLE TIMES
    // This ensures browser fully processes the deactivation
    const reflow1 = slider.offsetHeight;
    const reflow2 = slider.offsetWidth;
    const reflow3 = window.getComputedStyle(slides[0]).transform;
    console.log('   ✓ Step 2: Browser reflow forced (transform:', reflow3, ')');
    
    // Step 3: Wait 200ms to ensure CSS has fully reset
    // Then activate first slide to trigger zoom transition
    setTimeout(function() {
      slides[0].classList.add('active');
      console.log('   ✓ Step 3: First slide RE-ACTIVATED!');
      console.log('');
      console.log('   ✅ ✅ ✅ ZOOM ANIMATION NOW STARTING! ✅ ✅ ✅');
      console.log('   ✅ ✅ ✅ FIRST SLIDE SHOULD BE ZOOMING NOW! ✅ ✅ ✅');
      console.log('');
      console.log('   ℹ First slide will zoom from 100% to 110% over 5 seconds');
      console.log('   👁 WATCH THE IMAGE - it MUST slowly grow larger');
      console.log('   👁 If image NOT growing, check CSS file loaded');
      console.log('');
      
      // Verify after 1 second that zoom is happening
      setTimeout(function() {
        const currentTransform = window.getComputedStyle(slides[0]).transform;
        console.log('   🔍 After 1 second, transform is:', currentTransform);
        if (currentTransform.includes('1.1') || currentTransform.includes('matrix')) {
          console.log('   ✅ ZOOM IS WORKING! Transform changing!');
        } else {
          console.error('   ❌ ZOOM NOT WORKING! Transform not changing!');
          console.error('   ❌ Check if slider.css is loaded properly');
        }
      }, 1000);
    }, 200); // Increased to 200ms for better reliability

    // Tab visibility
    document.addEventListener('visibilitychange', function() {
      if (document.hidden) {
        stopAutoplay();
        console.log('👁 Tab hidden - autoplay paused');
      } else {
        setTimeout(startAutoplay, 100);
        console.log('👁 Tab visible - autoplay resumed');
      }
    });

    // Start autoplay
    setTimeout(function() {
      startAutoplay();
      console.log('═══════════════════════════════════════');
      console.log('🎉 SLIDER FULLY INITIALIZED');
      console.log('   ✓ First slide zooming');
      console.log('   ✓ Autoplay running');
      console.log('   ✓ Slides change every 5 seconds');
      console.log('   ℹ Sidebar will appear when slide changes (1 → 2)');
      console.log('═══════════════════════════════════════');
    }, 150);

    // Failsafe restart
    setInterval(function() {
      if (!autoplayInterval && !document.hidden && slides) {
        console.warn('⚠️ FAILSAFE: Autoplay stopped unexpectedly, restarting...');
        startAutoplay();
      }
    }, 6000);

    return true;
  }

  // Initialize sidebar behavior
  function initSidebar() {
    const sidebar = document.querySelector('.sidebar');
    if (!sidebar) {
      console.warn('⚠️ Sidebar not found');
      return;
    }

    if (isSliderPage()) {
      // On slider pages: Keep hidden, will show on slide change
      sidebar.classList.add('sidebar-hidden');
      console.log('📍 Slider page detected - sidebar will wait for slide change');
    } else {
      // On regular pages: Show immediately with animation
      setTimeout(function() {
        sidebar.classList.add('sidebar-show');
        console.log('📍 Regular page detected - sidebar showing immediately');
      }, 200);
    }
  }

  // Try initialization
  function tryInit() {
    if (sliderInitialized) {
      return;
    }

    const hasSlider = isSliderPage();
    console.log('🔍 Checking page type:', hasSlider ? 'SLIDER PAGE' : 'REGULAR PAGE');

    if (hasSlider) {
      if (initSlider()) {
        console.log('✓ Slider initialization successful');
      }
    }
    
    initSidebar();
  }

  // Method 1: Immediate
  tryInit();

  // Method 2: DOMContentLoaded
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', tryInit);
  }

  // Method 3: Load event
  window.addEventListener('load', tryInit);

  // Method 4: Polling backup
  let attempts = 0;
  let pollInterval = setInterval(function() {
    attempts++;
    const hasSlider = isSliderPage();
    
    if ((hasSlider && sliderInitialized) || attempts > 20) {
      clearInterval(pollInterval);
      if (!sliderInitialized && hasSlider && attempts > 20) {
        console.error('❌ FAILED to initialize slider after 20 attempts');
      }
      return;
    }
    
    if (!sliderInitialized) {
      tryInit();
    }
  }, 500);

})();
