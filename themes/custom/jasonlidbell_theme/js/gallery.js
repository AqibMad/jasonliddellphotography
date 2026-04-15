(function ($, Drupal) {
  'use strict';

  Drupal.behaviors.galleryInteractions = {
    attach: function (context, settings) {
      // Additional gallery interactions can be added here
      // For now, CSS handles most of the gallery functionality
      
      // Example: Lightbox integration or image lazy loading could go here
      console.log('Gallery interactions loaded');
    }
  };

})(jQuery, Drupal);
