(function ($, Drupal, window) {
  'use strict';

  // Make toggleMenu global for inline onclick - works on ALL pages
  window.toggleMenu = function() {
    const sidebar = document.getElementById('sidebar');
    if (sidebar) {
      sidebar.classList.toggle('active');
    }
  };

  Drupal.behaviors.sidebarToggle = {
    attach: function (context, settings) {
      const sidebar = document.getElementById('sidebar');
      const sidebarHeader = document.querySelector('.sidebar-header');

      if (!sidebar || !sidebarHeader) return;

      // Make logo clickable with cursor pointer
      sidebarHeader.style.cursor = 'pointer';
    }
  };

})(jQuery, Drupal, window);
