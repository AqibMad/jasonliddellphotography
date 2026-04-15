(function () {
  'use strict';

  function initSlider() {
    const slider = document.getElementById('slider');
    if (!slider) return;

    const slides = slider.querySelectorAll('.slide');
    if (slides.length === 0) return;

    let currentSlide = 0;
    let slideInterval;

    function showSlide(index) {
      // Simple: remove active from all, add to one
      slides.forEach(slide => slide.classList.remove('active'));
      slides[index].classList.add('active');
      currentSlide = index;
    }

    function nextSlide() {
      let next = (currentSlide + 1) % slides.length;
      showSlide(next);
    }

    function startSlider() {
      slideInterval = setInterval(nextSlide, 6000); // 6 seconds
    }

    function stopSlider() {
      clearInterval(slideInterval);
    }

    // Pause on hover
    slider.addEventListener('mouseenter', stopSlider);
    slider.addEventListener('mouseleave', startSlider);

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
      if (e.key === 'ArrowLeft') {
        stopSlider();
        let prev = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(prev);
        setTimeout(startSlider, 2000);
      } else if (e.key === 'ArrowRight') {
        stopSlider();
        nextSlide();
        setTimeout(startSlider, 2000);
      }
    });

    // Initialize
    showSlide(0);
    startSlider();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSlider);
  } else {
    initSlider();
  }

})();
