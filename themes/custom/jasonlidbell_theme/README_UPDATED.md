# Jason Liddell Photography Theme - Updated

## What's New in This Version

This updated theme includes improved templates for content pages that provide a clean, professional layout. The broken/unstyled view you were experiencing has been fixed.

### New Templates Added

1. **page--about.html.twig** - For About/About Me pages
2. **page--contact.html.twig** - For Contact pages
3. **page--blog.html.twig** - For Blog pages
4. **page--discreetservice.html.twig** - For Discreet Service page
5. **page--content.html.twig** - Generic content page template (fallback)

### New Styling

- **content-pages.css** - Comprehensive styling for all content pages with:
  - Elegant typography
  - Proper spacing and margins
  - Responsive design
  - Form styling for contact pages
  - Blog-specific styling
  - Professional color scheme matching your brand

## Installation Instructions

### Step 1: Backup Your Current Theme
```bash
# In your Drupal themes directory
cp -r jasonlidbell_theme jasonlidbell_theme_backup
```

### Step 2: Replace Theme Files

1. Upload all files from this updated theme to your existing theme directory
2. Replace when prompted to overwrite existing files

### Step 3: Clear Drupal Cache

**Method A - Through Admin Interface:**
1. Go to **Configuration** → **Development** → **Performance**
2. Click **"Clear all caches"**

**Method B - Using Drush:**
```bash
drush cr
```

### Step 4: Create Your Pages

Now you can create pages in Drupal that will automatically use the clean templates.

## How to Add New Pages

### Adding the Discreet Service Page

1. Go to **Content** → **Add Content** → **Basic Page**
2. Fill in the details:
   - **Title:** "Discreet Service" (or your preferred title)
   - **Body:** Add your content (see content suggestions below)
   - **URL alias:** Under "URL Path Settings", set to `/discreetservice`
3. Click **Save**

### Adding the About Page

1. Go to **Content** → **Add Content** → **Basic Page**
2. Fill in:
   - **Title:** "About Me" or "About"
   - **Body:** Your about content
   - **URL alias:** `/about` or `/about-me`
3. Click **Save**

### Adding the Contact Page

1. Go to **Content** → **Add Content** → **Basic Page**
2. Fill in:
   - **Title:** "Contact"
   - **Body:** Contact information or form
   - **URL alias:** `/contact`
3. Click **Save**

### Adding the Blog Page

1. Go to **Content** → **Add Content** → **Basic Page**
2. Fill in:
   - **Title:** "Blog"
   - **Body:** Blog posts or listing
   - **URL alias:** `/blog`
3. Click **Save**

## Content Suggestions

### For the Discreet Service Page

```html
<h1>Discreet Service</h1>

<p class="lead-text">Professional photography services with complete privacy and confidentiality</p>

<h2>What is Discreet Service?</h2>

<p>Our discreet service is designed for clients who require complete privacy and confidentiality. Whether you're a public figure, professional, or someone who values their privacy, we ensure your photography experience remains completely confidential.</p>

<h2>Services Included</h2>

<ul>
  <li>Private studio sessions</li>
  <li>Non-disclosure agreements</li>
  <li>Secure file delivery</li>
  <li>No social media posting without permission</li>
  <li>Private consultation</li>
</ul>

<h2>How It Works</h2>

<p>Contact us directly to schedule a private consultation. We'll discuss your needs, preferences, and ensure complete confidentiality throughout the process.</p>

<h3>Ready to Book?</h3>

<p>Contact Jason at <a href="mailto:jason@jasonliddellphotography.com">jason@jasonliddellphotography.com</a> or call (XXX) XXX-XXXX</p>
```

### For the About Page

```html
<h1>About Jason Liddell</h1>

<p class="lead-text">Capturing moments that last a lifetime</p>

<h2>My Story</h2>

<p>Photography has been my passion for over [X] years. What started as a hobby has evolved into a full-time career doing what I love most - capturing beautiful moments and creating lasting memories for my clients.</p>

<h2>My Approach</h2>

<p>I believe in creating a comfortable, relaxed environment where natural beauty shines through. Every session is tailored to your unique personality and vision.</p>

<h2>Specializations</h2>

<ul>
  <li>Weddings</li>
  <li>Portraits</li>
  <li>Food Photography</li>
  <li>Fine Art Nudes</li>
  <li>And more...</li>
</ul>
```

### For the Contact Page

```html
<h1>Get In Touch</h1>

<p class="lead-text">Let's create something beautiful together</p>

<h2>Contact Information</h2>

<p><strong>Email:</strong> <a href="mailto:jason@jasonliddellphotography.com">jason@jasonliddellphotography.com</a></p>
<p><strong>Phone:</strong> (XXX) XXX-XXXX</p>
<p><strong>Studio Location:</strong> [Your Address]</p>

<h2>Business Hours</h2>

<p>Monday - Friday: 9:00 AM - 6:00 PM<br>
Saturday: By Appointment<br>
Sunday: Closed</p>

<h2>Send a Message</h2>

<p>Fill out the form below and I'll get back to you within 24 hours.</p>

<!-- If you have a contact form module installed, it will display here -->
```

## Template Matching System

The theme uses Drupal's template naming system to automatically apply the correct template:

- URL `/about` → Uses `page--about.html.twig`
- URL `/contact` → Uses `page--contact.html.twig`
- URL `/blog` → Uses `page--blog.html.twig`
- URL `/discreetservice` → Uses `page--discreetservice.html.twig`
- Any other content page → Uses `page.html.twig` (with content-pages.css styling)

## Styling Features

### Typography
- **Headings:** Clean, elegant headers with proper hierarchy
- **Body Text:** Easy-to-read Georgia serif font
- **Links:** Styled in your brand blue color with hover effects

### Layout
- **Centered content:** Maximum 900px width for optimal readability
- **Proper spacing:** Generous margins and padding
- **Dark theme:** Matches your existing gallery pages
- **Responsive:** Works perfectly on all devices

### Forms
- **Contact forms:** Pre-styled with your theme colors
- **Input fields:** Dark backgrounds with elegant borders
- **Submit buttons:** Styled with your brand blue

### Special Elements
- **Blockquotes:** Styled with accent border
- **Lists:** Proper indentation and spacing
- **Images:** Rounded corners with shadows
- **Tables:** Clean borders and hover effects

## Customization

### Changing Colors

Edit `css/content-pages.css` and look for these color values:

```css
/* Main accent color (blue) */
rgba(75, 150, 200, 1)

/* Text color (white) */
rgba(255, 255, 255, 0.85)

/* Background */
rgba(0, 0, 0, 0.7)
```

### Adjusting Layout Width

In `css/content-pages.css`, find:

```css
.content-page-wrapper {
    max-width: 900px;  /* Change this value */
    margin: 0 auto;
}
```

### Adding Custom Fonts

Add to `css/content-pages.css`:

```css
@import url('https://fonts.googleapis.com/css2?family=Your+Font&display=swap');

.content-page-wrapper h1 {
    font-family: 'Your Font', serif;
}
```

## Troubleshooting

### Template Not Working?

1. **Check URL alias:** Make sure it matches exactly (e.g., `/about`, not `/about-us`)
2. **Clear cache:** Configuration → Development → Performance → Clear all caches
3. **Check file permissions:** Ensure template files are readable

### Styling Not Showing?

1. **Clear browser cache:** Ctrl+Shift+R (or Cmd+Shift+R on Mac)
2. **Clear Drupal cache:** As mentioned above
3. **Check CSS file:** Ensure `content-pages.css` is in the `css/` folder
4. **Verify libraries.yml:** Make sure content-pages.css is listed

### Menu Links Still Blue?

This is normal Drupal menu styling. The content pages themselves will be properly styled with the new templates.

To style menu items, you would need to add custom CSS targeting the menu specifically, or use the sidebar menu which is already styled.

## File Structure

```
jasonlidbell_theme/
├── css/
│   ├── base.css
│   ├── sidebar.css
│   ├── gallery.css
│   ├── content-pages.css          ← NEW
│   └── ...
├── templates/
│   ├── page.html.twig
│   ├── page--about.html.twig      ← NEW
│   ├── page--contact.html.twig    ← NEW
│   ├── page--blog.html.twig       ← NEW
│   ├── page--discreetservice.html.twig  ← NEW
│   ├── page--content.html.twig    ← NEW
│   └── ...
├── jasonlidbell_theme.libraries.yml  ← UPDATED
└── README_UPDATED.md              ← NEW (this file)
```

## Support

If you encounter any issues:

1. Check the troubleshooting section above
2. Verify all files are uploaded correctly
3. Clear all caches (Drupal and browser)
4. Check Drupal logs: Reports → Recent log messages

## Version Notes

**Version:** 2.0 (Updated with Content Page Templates)
**Date:** January 2026
**Changes:** 
- Added content page templates
- Added content-pages.css styling
- Fixed broken layout for new pages
- Improved responsive design
- Added form styling

---

**Created by:** AI Assistant for Jason Liddell Photography
**License:** Same as original theme
