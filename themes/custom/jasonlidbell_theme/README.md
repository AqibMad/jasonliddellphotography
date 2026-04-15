# Jason Lidbell Photography - Drupal Theme

A custom Drupal theme for Jason Lidbell Photography portfolio website, featuring elegant image sliders, responsive galleries, and a sophisticated sidebar navigation.

## Features

- **Responsive Design**: Mobile-first approach with elegant mobile navigation
- **Image Slider**: Beautiful full-screen image slider with zoom effects for homepage and category pages
- **Gallery System**: Grid-based gallery layout with hover effects
- **Collapsible Sidebar**: Animated sidebar navigation with expandable menu
- **Modern UI**: Clean, professional design focused on showcasing photography
- **Touch-Friendly**: Optimized for touch devices and mobile browsing

## Requirements

- Drupal 10.x or Drupal 11.x
- PHP 8.1 or higher
- Modern web browser with JavaScript enabled

## Installation

### 1. Install the Theme

```bash
# Navigate to your Drupal themes directory
cd /path/to/your/drupal/web/themes/custom/

# Copy the theme folder
cp -r jasonlidbell_theme /path/to/your/drupal/web/themes/custom/

# Or use Git (if theme is in a repository)
git clone <repository-url> jasonlidbell_theme
```

### 2. Enable the Theme

**Via Drupal Admin UI:**
1. Go to `Appearance` (`/admin/appearance`)
2. Find "Jason Lidbell Photography" theme
3. Click "Install and set as default"

**Via Drush:**
```bash
drush theme:enable jasonlidbell_theme
drush config:set system.theme default jasonlidbell_theme
drush cr
```

### 3. Clear Cache

```bash
drush cr
# Or via admin UI: Configuration > Development > Performance > Clear all caches
```

## Configuration

### Content Types Setup

#### 1. Gallery Content Type

Create a content type for gallery pages:

```
Machine name: gallery
Fields:
  - Title (default)
  - Body (default, optional)
  - field_gallery_images (Entity Reference: Media, unlimited)
```

**Steps to create:**
1. Go to `Structure > Content types > Add content type`
2. Name: "Gallery"
3. Add field: "Gallery Images"
   - Type: Entity Reference
   - Reference type: Media
   - Allowed number of values: Unlimited

#### 2. Slider Page Content Type

Create a content type for category pages with sliders:

```
Machine name: slider_page
Fields:
  - Title (default)
  - field_slider_images (Entity Reference: Media, 5 values)
```

**Steps to create:**
1. Go to `Structure > Content types > Add content type`
2. Name: "Slider Page"
3. Add field: "Slider Images"
   - Type: Entity Reference
   - Reference type: Media
   - Allowed number of values: 5

### Menu Configuration

#### Create Main Navigation Menu

1. Go to `Structure > Menus > Main navigation`
2. Add menu items for each photography category:
   - Home
   - Aerial/Landscapes
   - Dance
   - Pregnancy
   - Boudoir
   - Pole & Aerials
   - 4WD's
   - Fine Art Nudes
   - Product Photography
   - Food Photography
   - Pin-Up
   - Weddings
   - Clients
   - Buy Prints
   - Discreet Service
   - Testimonials
   - About Me / Contact
   - Blog

3. Assign menu to "Sidebar Navigation" region:
   - Go to `Structure > Block layout`
   - Place "Main navigation" menu in "Sidebar First" region

### Front Page Setup

1. Create a node (any content type)
2. Go to `Configuration > System > Basic site information`
3. Set "Default front page" to the node path (e.g., `/node/1`)
4. The front page will automatically use the `page--front.html.twig` template with slider

### Image Management

#### Media Configuration

1. Ensure Media module is enabled
2. Go to `Structure > Media types`
3. Ensure "Image" media type exists
4. Field: `field_media_image` (Image field)

#### Upload Images

1. Go to `Content > Media > Add media > Image`
2. Upload images for sliders and galleries
3. Reference these media items in your content

### Slider Images

#### For Homepage Slider:

Edit the `page--front.html.twig` file to add your slider images:

```twig
<div class="slide active zooming" style="background-image: url('/sites/default/files/your-image-1.jpg');"></div>
<div class="slide" style="background-image: url('/sites/default/files/your-image-2.jpg');"></div>
<!-- Add more slides -->
```

Or implement via custom module to load from content.

#### For Category Pages:

Create a "Slider Page" content type node and add 5 images to the `field_slider_images` field.

## Theme Structure

```
jasonlidbell_theme/
├── css/
│   ├── base.css          # Global styles
│   ├── sidebar.css       # Sidebar navigation styles
│   ├── slider.css        # Image slider styles
│   └── gallery.css       # Gallery and content page styles
├── js/
│   ├── sidebar.js        # Sidebar toggle functionality
│   ├── slider.js         # Slider functionality
│   └── gallery.js        # Gallery interactions
├── images/
│   └── logo.png          # Theme logo
├── templates/
│   ├── page.html.twig                      # Base page template
│   ├── page--front.html.twig               # Front page with slider
│   ├── page--slider.html.twig              # Category slider pages
│   ├── region--sidebar-first.html.twig     # Sidebar region
│   ├── node--gallery.html.twig             # Gallery node template
│   └── node--page.html.twig                # Content page template
├── jasonlidbell_theme.info.yml     # Theme configuration
├── jasonlidbell_theme.libraries.yml # CSS/JS libraries
├── jasonlidbell_theme.theme        # Theme preprocessing
└── README.md                       # This file
```

## Customization

### Changing Colors

Edit the CSS files in the `css/` directory:

- Primary color: `rgba(75, 150, 200, 1)` - Used for links and hover states
- Background: `#000` (black)
- Text: `#fff` (white)

### Modifying Sidebar

Edit `templates/region--sidebar-first.html.twig` to change:
- Logo ornaments
- Menu title
- Sidebar structure

### Adjusting Slider Timing

Edit `js/slider.js`, line with `setInterval`:

```javascript
setInterval(nextSlide, 8000); // Change 8000 to desired milliseconds
```

### Gallery Grid

Edit `css/gallery.css`, `.gallery-grid` section:

```css
grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
/* Change 350px to adjust minimum column width */
```

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Troubleshooting

### Styles Not Loading

1. Clear Drupal cache: `drush cr`
2. Check file permissions on CSS/JS files
3. Verify library definitions in `.libraries.yml`

### Sidebar Not Appearing

1. Check that menu is assigned to "Sidebar First" region
2. Verify region is defined in `.info.yml`
3. Clear cache

### Slider Not Working

1. Ensure jQuery is loaded (Drupal core provides it)
2. Check browser console for JavaScript errors
3. Verify slider images are properly loaded

### Images Not Displaying

1. Check file paths in content
2. Verify media entities exist
3. Check file permissions in `/sites/default/files/`

## Development

### Local Development

```bash
# Watch for CSS changes (if using preprocessor)
# Compile SCSS or make CSS edits directly

# Clear cache after changes
drush cr

# Export configuration
drush config:export
```

### Adding New Templates

1. Create `.html.twig` file in `templates/` directory
2. Follow Drupal naming conventions
3. Clear cache to recognize new template

### Adding New Regions

1. Edit `jasonlidbell_theme.info.yml`
2. Add region definition
3. Clear cache
4. Place blocks in new region via Block Layout

## Performance Optimization

### Image Optimization

1. Use WebP format for images where possible
2. Enable Drupal's Image Styles for responsive images
3. Configure lazy loading for gallery images

### Caching

1. Enable CSS/JS aggregation: `Configuration > Performance`
2. Configure page cache settings
3. Use CDN for static assets if available

## Credits

**Design & Development**: Custom theme for Jason Lidbell Photography
**Framework**: Drupal CMS
**Fonts**: Georgia, Brush Script MT, Arial

## License

Proprietary - All rights reserved to Jason Lidbell Photography

## Support

For theme support or customization requests, contact the theme developer.

## Changelog

### Version 1.0.0
- Initial release
- Full responsive design
- Image slider functionality
- Gallery grid layout
- Collapsible sidebar navigation
- Mobile optimization
