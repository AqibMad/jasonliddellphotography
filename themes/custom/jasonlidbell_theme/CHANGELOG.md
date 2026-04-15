# Changelog

All notable changes to the Jason Lidbell Photography Drupal theme will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2025-01-09

### Added
- Initial release of Jason Lidbell Photography theme
- Full responsive design with mobile-first approach
- Homepage with fullscreen image slider
- Animated sidebar navigation with collapsible menu
- Gallery content type with grid layout
- Slider page content type for category pages
- Touch-friendly navigation for mobile devices
- Keyboard navigation support for sliders
- Smooth animations and transitions
- Custom CSS for base, sidebar, slider, and gallery
- JavaScript behaviors for sidebar toggle and slider functionality
- Twig templates for all page types
- Theme preprocessing functions
- Comprehensive README and installation guide
- Logo and branding integration

### Features
- **Sidebar Navigation**: Expandable/collapsible sidebar with animated menu
- **Image Sliders**: Fullscreen sliders with zoom effects and dot navigation
- **Gallery System**: Responsive grid layout with hover effects
- **Mobile Optimization**: Touch-friendly overlay menu for mobile devices
- **Accessibility**: Keyboard navigation and skip links
- **Performance**: Optimized CSS and JavaScript loading

### Templates
- `html.html.twig` - HTML wrapper
- `page.html.twig` - Base page template
- `page--front.html.twig` - Homepage with slider
- `page--slider.html.twig` - Category pages with slider
- `region--sidebar-first.html.twig` - Sidebar region
- `node--gallery.html.twig` - Gallery node display
- `node--page.html.twig` - Content page display
- `field--field-gallery-images.html.twig` - Gallery images field
- `maintenance-page.html.twig` - Maintenance mode page

### Styling
- `base.css` - Global styles and container layout
- `sidebar.css` - Sidebar navigation and animations
- `slider.css` - Image slider and transitions
- `gallery.css` - Gallery grid and content pages

### Scripts
- `sidebar.js` - Sidebar toggle and mobile menu
- `slider.js` - Image slider with keyboard and dot navigation
- `gallery.js` - Gallery interactions placeholder

### Browser Support
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

### Requirements
- Drupal 10.x or 11.x
- PHP 8.1 or higher
- Media module (Drupal core)

## [Unreleased]

### Planned Features
- Lightbox integration for gallery images
- Image lazy loading
- Additional page templates
- Custom block styles
- Advanced slider controls
- Social media integration
- Print styles
- RTL language support
- Dark/light mode toggle
- Advanced animation options

### Known Issues
- None reported

## Notes

For detailed installation instructions, see INSTALL.md
For usage and customization, see README.md
