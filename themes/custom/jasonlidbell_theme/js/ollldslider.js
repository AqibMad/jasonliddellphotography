(function ($, Drupal) {
  'use strict';

  Drupal.behaviors.imageSlider = {
    attach: function (context, settings) {
      const slider = document.getElementById('slider');
      
      if (!slider) return;

      const slides = slider.querySelectorAll('.slide');
      const dots = document.querySelectorAll('.dot');
      let currentSlide = 0;
      let slideInterval;

      function showSlide(index) {
        // Remove zooming from all slides first
        slides.forEach(slide => {
          slide.classList.remove('zooming');
        });

        // Fade out current slide (but keep it zoomed!)
        slides[currentSlide].classList.remove('active');
        
        // Update dots
        dots.forEach(dot => {
          dot.classList.remove('active');
        });
        
        // Fade in new slide (already pre-zoomed via CSS)
        slides[index].classList.add('active');
        
        // Start zoom animation after brief delay
        setTimeout(() => {
          slides[index].classList.add('zooming');
        }, 100);
        
        if (dots[index]) {
          dots[index].classList.add('active');
        }
        
        currentSlide = index;
      }

      function nextSlide() {
        let next = (currentSlide + 1) % slides.length;
        showSlide(next);
      }

      function startSlider() {
        slideInterval = setInterval(nextSlide, 8000);
      }

      function stopSlider() {
        clearInterval(slideInterval);
      }

      // Dot navigation
      dots.forEach(dot => {
        dot.addEventListener('click', function() {
          stopSlider();
          showSlide(parseInt(this.dataset.slide));
          startSlider();
        });
      });

      // Keyboard navigation
      document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') {
          stopSlider();
          let prev = (currentSlide - 1 + slides.length) % slides.length;
          showSlide(prev);
          startSlider();
        } else if (e.key === 'ArrowRight') {
          stopSlider();
          nextSlide();
          startSlider();
        }
      });

      // Pause on hover
      slider.addEventListener('mouseenter', stopSlider);
      slider.addEventListener('mouseleave', startSlider);

      // Initialize first slide with zoom
      slides[0].classList.add('zooming');

      // Start the slider
      startSlider();
    }
  };

})(jQuery, Drupal);
