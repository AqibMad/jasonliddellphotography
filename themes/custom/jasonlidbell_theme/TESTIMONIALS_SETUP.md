# Testimonials Slider - Drupal Setup Guide

## What's Been Created

### Templates:
1. **page--testimonials.html.twig** - Main page wrapper
2. **views-view-unformatted--testimonials.html.twig** - View wrapper for slider
3. **node--testimonial.html.twig** - Individual testimonial display

### CSS:
- **css/testimonials.css** - All testimonial slider styles

### JavaScript:
- **js/testimonials-slider.js** - Auto-sliding functionality (6 seconds per slide)

## Drupal Setup Steps

### 1. Create Content Type

1. Go to: **Structure > Content types > Add content type**
2. Name: **Testimonial**
3. Machine name: `testimonial`
4. Save

### 2. Add Fields to Testimonial Content Type

Add these fields:

**Field 1: Image**
- Field type: Image
- Machine name: `field_image`
- Label: Image
- Required: Yes
- Upload destination: Public files
- Allowed file extensions: png jpg jpeg
- Maximum upload size: 10 MB

**Field 2: Body** (already exists)
- Use the default body field for testimonial text

### 3. Create a View for Testimonials

1. Go to: **Structure > Views > Add view**
2. View name: **Testimonials**
3. Show: **Content** of type **Testimonial**
4. Create a page: **Yes**
   - Page title: Testimonials
   - Path: `/testimonials`
   - Display format: **Unformatted list**
   - Items per page: **All** (or set high number like 50)
5. Save view

### 4. Configure View Display

In the view edit page:

**Format Settings:**
- Format: Unformatted list
- Show: Content
- View mode: Full content

**Fields:**
- Don't add individual fields, use "Content" instead
- This ensures the node template is used

**Sort Criteria:**
- Add: Content: Post date
- Sort: Descending (newest first)

### 5. Add Testimonials

1. Go to: **Content > Add content > Testimonial**
2. Fill in:
   - **Title**: Client name (e.g., "Leecie Gantzas")
   - **Body**: Full testimonial text with multiple paragraphs
   - **Image**: Upload portrait photo (400x600px recommended)
3. Save
4. Add at least 3 testimonials for the slider

## How It Works

### Structure:
```
/testimonials page
  └─ View: Testimonials
      └─ Displays all testimonial nodes
          └─ Each node uses node--testimonial.html.twig
              ├─ Image (left 35%)
              └─ Text (right 65%)
                  ├─ Title: "TESTIMONIALS"
                  ├─ Author: Node title
                  └─ Body: Testimonial text
```

### Slider Behavior:
- Auto-advances every 6 seconds
- Smooth horizontal slide transition (0.5s)
- Scrollbar appears if text is too long
- Fully responsive

## File Structure

```
jasonlidbell_theme/
├── templates/
│   ├── page--testimonials.html.twig
│   ├── views-view-unformatted--testimonials.html.twig
│   └── node--testimonial.html.twig
├── css/
│   └── testimonials.css
├── js/
│   └── testimonials-slider.js
└── jasonlidbell_theme.libraries.yml (updated)
```

## Testing

1. Upload theme files
2. Clear Drupal cache: **Configuration > Performance > Clear all caches**
3. Create testimonial content type and fields
4. Create view
5. Add 3-5 testimonials
6. Visit `/testimonials`
7. Should see auto-sliding testimonials!

## Customization

### Change slide duration:
Edit `js/testimonials-slider.js`, line with `setInterval`:
```javascript
setInterval(nextSlide, 6000); // Change 6000 to desired milliseconds
```

### Change image size:
Edit `css/testimonials.css`:
```css
.slide-image {
    flex: 0 0 35%; /* Change 35% to desired width */
}
```

### Change colors:
Edit `css/testimonials.css`:
```css
.testimonials-container {
    background: #F5F2EB; /* Change background color */
}
```

## Important Notes

- Title (author name) comes from the node title
- Body field contains all testimonial text
- Images should be portrait orientation (taller than wide)
- Recommended image size: 400x600px or similar ratio
- At least 3 testimonials recommended for good rotation
- Slider works automatically, no manual controls

## Troubleshooting

**Slider not working:**
- Clear Drupal cache
- Check browser console for JavaScript errors
- Verify view machine name matches template

**Images not showing:**
- Check image field machine name is `field_image`
- Verify images are uploaded and public
- Check image style/size settings

**Layout broken:**
- Clear Drupal cache
- Check CSS is loading
- Verify template names match exactly

## Success!

Once set up, you can easily add new testimonials from **Content > Add content > Testimonial** and they'll automatically appear in the slider!
