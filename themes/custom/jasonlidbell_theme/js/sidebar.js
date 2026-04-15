// Global toggle function
function toggleMenu() {
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('mobileOverlay');
  const mobileToggle = document.querySelector('.mobile-menu-toggle');
  
  if (sidebar) {
    sidebar.classList.toggle('active');
  }
  
  if (overlay) {
    overlay.classList.toggle('active');
  }
  
  if (mobileToggle) {
    mobileToggle.classList.toggle('active');
  }
}

// Initialize mobile menu and overlay functionality
document.addEventListener('DOMContentLoaded', function() {
  const overlay = document.getElementById('mobileOverlay');
  const sidebar = document.getElementById('sidebar');
  
  // Create mobile menu toggle button if on mobile
  if (window.innerWidth <= 768) {
    createMobileMenuButton();
  }
  
  // Close sidebar when clicking overlay
  if (overlay && sidebar) {
    overlay.addEventListener('click', function() {
      closeMobileSidebar();
    });
  }
  
  // Close sidebar when clicking menu links on mobile
  if (window.innerWidth <= 768) {
    const menuLinks = document.querySelectorAll('.nav-menu a');
    menuLinks.forEach(link => {
      link.addEventListener('click', function() {
        closeMobileSidebar();
      });
    });
  }
  
  // Recreate mobile button on window resize
  let resizeTimer;
  window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function() {
      if (window.innerWidth <= 768) {
        if (!document.querySelector('.mobile-menu-toggle')) {
          createMobileMenuButton();
        }
      } else {
        const mobileBtn = document.querySelector('.mobile-menu-toggle');
        if (mobileBtn) {
          mobileBtn.remove();
        }
      }
    }, 250);
  });
});

// Create mobile menu button
function createMobileMenuButton() {
  // Check if button already exists
  if (document.querySelector('.mobile-menu-toggle')) {
    return;
  }
  
  const button = document.createElement('div');
  button.className = 'mobile-menu-toggle';
  button.innerHTML = '<div class="hamburger-icon"></div>';
  button.onclick = toggleMenu;
  
  document.body.appendChild(button);
}

// Close mobile sidebar
function closeMobileSidebar() {
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('mobileOverlay');
  const mobileToggle = document.querySelector('.mobile-menu-toggle');
  
  if (sidebar) {
    sidebar.classList.remove('active');
  }
  
  if (overlay) {
    overlay.classList.remove('active');
  }
  
  if (mobileToggle) {
    mobileToggle.classList.remove('active');
  }
}
