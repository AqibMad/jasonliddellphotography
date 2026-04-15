/**
 * @file
 * Testimonials Slider JavaScript (Drupal behavior)
 * - Autoplay enabled
 * - No dependency on view pager
 * - Only targets direct children `.testimonial-slide`
 */
(function ($, Drupal, once) {
  'use strict';

  function initSlider(sliderEl) {
    const $slider = $(sliderEl);
    const $slides = $slider.children('.testimonial-slide');
    const total = $slides.length;

    if (!total) return;

    // Ensure only one active slide at start
    $slides.removeClass('active').hide();
    let index = 0;
    $slides.eq(index).addClass('active').show();

    // Update counter if present
    const $counter = $slider.find('.testimonial-counter');
    const $current = $counter.find('.current');
    const $total = $counter.find('.total');
    if ($total.length) $total.text(total);
    if ($current.length) $current.text(index + 1);

    function show(i) {
      if (total < 2) return;
      const next = (i + total) % total;
      $slides.eq(index).removeClass('active').stop(true, true).fadeOut(250);
      index = next;
      $slides.eq(index).addClass('active').stop(true, true).fadeIn(350);
      if ($current.length) $current.text(index + 1);
    }

    // Wire buttons if they exist (optional)
    const $prev = $slider.children('button.testimonial-nav--prev');
    const $next = $slider.children('button.testimonial-nav--next');

    if ($prev.length) $prev.on('click', function (e) { e.preventDefault(); show(index - 1); });
    if ($next.length) $next.on('click', function (e) { e.preventDefault(); show(index + 1); });

    // Autoplay
    const autoplayMs = parseInt($slider.attr('data-autoplay-ms') || '7000', 10);
    let timer = null;

    function start() {
      if (total < 2) return;
      if (timer) return;
      timer = setInterval(() => show(index + 1), autoplayMs);
      $slider.data('ts-timer', timer);
    }

    function stop() {
      if (!timer) return;
      clearInterval(timer);
      timer = null;
      $slider.removeData('ts-timer');
    }

    // Pause on hover/focus for accessibility
    $slider.on('mouseenter focusin', stop);
    $slider.on('mouseleave focusout', start);

    start();
  }

  Drupal.behaviors.testimonialsSlider = {
    attach: function (context) {
      once('testimonials-slider', '.testimonials-slider', context).forEach(initSlider);
    }
  };

})(jQuery, Drupal, once);
