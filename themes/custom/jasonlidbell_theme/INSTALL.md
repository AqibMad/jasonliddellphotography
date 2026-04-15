# Installation Guide - Jason Lidbell Photography Drupal Theme

This guide will walk you through the complete installation and setup process for the Jason Lidbell Photography Drupal theme.

## Prerequisites

Before you begin, ensure you have:

- A working Drupal 10.x or 11.x installation
- Admin access to your Drupal site
- FTP/SFTP access or SSH access to your server
- Basic understanding of Drupal administration

## Step 1: Upload the Theme

### Option A: Via FTP/SFTP

1. Download the theme folder `jasonlidbell_theme`
2. Connect to your server via FTP/SFTP
3. Navigate to `/path/to/drupal/web/themes/custom/`
   - If `custom` folder doesn't exist, create it
4. Upload the entire `jasonlidbell_theme` folder

### Option B: Via SSH/Command Line

```bash
# Navigate to your Drupal themes directory
cd /path/to/drupal/web/themes/custom/

# Upload or copy the theme
# If using Git:
git clone <repository-url> jasonlidbell_theme

# Or if copying from local:
cp -r /path/to/jasonlidbell_theme ./
```

## Step 2: Set Permissions

Ensure the theme files have correct permissions:

```bash
cd /path/to/drupal/web/themes/custom/jasonlidbell_theme
chmod -R 755 .
chown -R www-data:www-data .
```

## Step 3: Enable the Theme

### Via Drupal Admin Interface

1. Log in to your Drupal admin panel
2. Go to **Appearance** (`/admin/appearance`)
3. Find "Jason Lidbell Photography" in the list of themes
4. Click **Install and set as default**

### Via Drush (Recommended)

```bash
# Enable the theme
drush theme:enable jasonlidbell_theme

# Set as default theme
drush config:set system.theme default jasonlidbell_theme

# Clear cache
drush cache:rebuild
```

## Step 4: Configure Regions and Blocks

### Set Up Regions

1. Go to **Structure > Block layout** (`/admin/structure/block`)
2. You should see these regions:
   - Header
   - Sidebar Navigation
   - Main Content
   - Footer

### Place Main Menu in Sidebar

1. In Block layout, find "Main navigation" menu
2. Click **Place block** next to "Sidebar Navigation" region
3. Configure the block:
   - Menu levels: All levels
   - Initial menu level: 1
4. Save the block

## Step 5: Create Content Types

### Create Gallery Content Type

1. Go to **Structure > Content types** (`/admin/structure/types`)
2. Click **Add content type**
3. Configure:
   - **Name**: Gallery
   - **Machine name**: gallery
   - **Description**: Photography gallery pages
4. Click **Save and manage fields**
5. Add field for images:
   - Click **Add field**
   - Field type: **Reference > Media**
   - Label: **Gallery Images**
   - Machine name: `field_gallery_images`
   - Allowed number of values: **Unlimited**
   - Save field settings
6. Configure the field:
   - Media type: **Image**
   - Required: Check this box
   - Save settings

### Create Slider Page Content Type

1. Go to **Structure > Content types** (`/admin/structure/types`)
2. Click **Add content type**
3. Configure:
   - **Name**: Slider Page
   - **Machine name**: slider_page
   - **Description**: Category pages with image sliders
4. Click **Save and manage fields**
5. Add field for slider images:
   - Click **Add field**
   - Field type: **Reference > Media**
   - Label: **Slider Images**
   - Machine name: `field_slider_images`
   - Allowed number of values: **Limited - 5**
   - Save field settings
6. Configure the field:
   - Media type: **Image**
   - Required: Check this box
   - Save settings

## Step 6: Create Menu Structure

1. Go to **Structure > Menus > Main navigation** (`/admin/structure/menu/manage/main`)
2. Add the following menu items (in order):

   | Menu Link Title      | Link                    | Weight |
   |---------------------|-------------------------|--------|
   | Home                | `<front>`               | 0      |
   | Aerial/Landscapes   | `/aerial-landscapes`    | 1      |
   | Dance               | `/dance`                | 2      |
   | Pregnancy           | `/pregnancy`            | 3      |
   | Boudoir             | `/boudoir`              | 4      |
   | Pole & Aerials      | `/pole-aerials`         | 5      |
   | 4WD's               | `/4wds`                 | 6      |
   | Fine Art Nudes      | `/fine-art-nudes`       | 7      |
   | Product Photography | `/product-photography`  | 8      |
   | Food Photography    | `/food-photography`     | 9      |
   | Pin-Up              | `/pin-up`               | 10     |
   | Weddings            | `/weddings`             | 11     |
   | Clients             | `/clients`              | 12     |
   | Buy Prints          | `/buy-prints`           | 13     |
   | Discreet Service    | `/discreet-service`     | 14     |
   | Testimonials        | `/testimonials`         | 15     |
   | About Me / Contact  | `/contact`              | 16     |
   | Blog                | `/blog`                 | 17     |

3. For each menu item:
   - Click **Add link**
   - Enter the title and path
   - Save

## Step 7: Configure Media Settings

1. Ensure Media module is enabled:
   - Go to **Extend** (`/admin/modules`)
   - Check **Media** and **Media Library**
   - Click **Install**

2. Go to **Structure > Media types** (`/admin/structure/media`)
3. Ensure "Image" media type exists
4. Configure image styles:
   - Go to **Configuration > Media > Image styles** (`/admin/config/media/image-styles`)
   - Ensure you have styles for:
     - Large (1920x1080 or larger)
     - Gallery (800x600)
     - Thumbnail (400x300)

## Step 8: Create Content

### Create Homepage

1. Go to **Content > Add content**
2. Choose any content type (or create a custom "Homepage" type)
3. Add a title: "Jason Lidbell Photography"
4. Save the node
5. Note the node ID (e.g., node/1)
6. Go to **Configuration > System > Basic site information** (`/admin/config/system/site-information`)
7. Set **Default front page** to `/node/1` (or your node ID)
8. Save configuration

### Create Gallery Pages

For each photography category:

1. Go to **Content > Add content > Gallery**
2. Add title (e.g., "Aerial Landscapes")
3. Upload images to **Gallery Images** field
4. Configure URL alias: `/aerial-landscapes`
5. Save

### Create Slider Pages

For category pages with sliders:

1. Go to **Content > Add content > Slider Page**
2. Add title (e.g., "Dance Photography")
3. Upload 5 images to **Slider Images** field
4. Configure URL alias to match menu link
5. Save

## Step 9: Upload and Configure Images

### Upload Logo

1. Replace `/themes/custom/jasonlidbell_theme/images/logo.png` with your actual logo
2. Recommended size: 230px wide (height auto)

### Upload Photography Images

1. Go to **Content > Media > Add media > Image**
2. Upload high-quality images:
   - Recommended: 1920px width for sliders
   - Recommended: 1200px width for galleries
3. Add descriptive alt text for accessibility
4. Save each media item

### Configure Image Quality

1. Go to **Configuration > Media > Image toolkit** (`/admin/config/media/image-toolkit`)
2. Set JPEG quality to 85-90 for best balance
3. Save configuration

## Step 10: Configure Performance

### Enable Aggregation

1. Go to **Configuration > Development > Performance** (`/admin/config/development/performance`)
2. Check:
   - **Aggregate CSS files**
   - **Aggregate JavaScript files**
3. Set cache maximum age (e.g., 1 hour)
4. Click **Save configuration**

### Configure Caching

1. In Performance settings:
   - Page cache maximum age: **15 min** or higher
   - Click **Save configuration**

## Step 11: Test the Theme

### Test Checklist

- [ ] Homepage displays with slider
- [ ] Sidebar menu appears and is clickable
- [ ] Menu expands/collapses on homepage
- [ ] Gallery pages display image grids
- [ ] Slider pages show image carousel
- [ ] Mobile menu works correctly
- [ ] All links in navigation work
- [ ] Images load correctly
- [ ] Hover effects work on gallery items
- [ ] Page transitions are smooth

### Browser Testing

Test in:
- Chrome (desktop and mobile)
- Firefox
- Safari (desktop and iOS)
- Edge

## Step 12: Final Configuration

### Set Site Name and Slogan

1. Go to **Configuration > System > Basic site information**
2. Set **Site name**: "Jason Lidbell Photography"
3. Set **Slogan**: Your tagline
4. Save configuration

### Configure URL Aliases

1. Enable Pathauto module (optional but recommended):
   ```bash
   composer require drupal/pathauto
   drush en pathauto
   ```
2. Configure patterns at **Configuration > Search and metadata > URL aliases > Patterns**

### Backup Your Configuration

```bash
drush config:export
```

## Troubleshooting

### Theme Not Appearing

```bash
# Clear all caches
drush cache:rebuild

# Verify theme files exist
ls -la /path/to/drupal/web/themes/custom/jasonlidbell_theme/

# Check Drupal logs
drush watchdog:show
```

### Styles Not Loading

1. Clear Drupal cache
2. Check file permissions
3. Verify CSS files exist in `/css/` directory
4. Check browser console for 404 errors
5. Ensure aggregation is enabled

### JavaScript Not Working

1. Check browser console for errors
2. Ensure jQuery is loading (Drupal core provides it)
3. Clear cache: `drush cache:rebuild`
4. Check JS file paths in `.libraries.yml`

### Images Not Displaying

1. Check file permissions in `/sites/default/files/`
2. Verify media entities exist
3. Check image field configuration
4. Ensure correct image paths in content

### Menu Not Showing in Sidebar

1. Verify menu block is placed in "Sidebar Navigation" region
2. Check menu visibility settings
3. Ensure menu has items
4. Clear cache

## Post-Installation

### SEO Configuration

1. Install and configure:
   - Metatag module
   - XML Sitemap module
   - Redirect module

### Performance Optimization

1. Install and configure:
   - Advanced CSS/JS Aggregation
   - Image Optimize (or ImageAPI Optimize)
   - Lazy Load module

### Security

1. Set up HTTPS
2. Configure file permissions properly
3. Keep Drupal core and modules updated
4. Set up regular backups

## Getting Help

If you encounter issues:

1. Check Drupal logs: **Reports > Recent log messages**
2. Review theme README.md file
3. Clear cache: `drush cache:rebuild`
4. Check file permissions
5. Review browser console for errors

## Next Steps

After installation:

1. Create content for all menu items
2. Upload your photography portfolio
3. Configure contact forms
4. Set up Google Analytics (optional)
5. Configure backup system
6. Set up development workflow

Congratulations! Your Jason Lidbell Photography theme is now installed and ready to use.
