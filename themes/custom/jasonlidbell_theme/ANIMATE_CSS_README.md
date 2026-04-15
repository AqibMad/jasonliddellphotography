# Theme Update - Animate.css Implementation (No More Glitchy Animations!)

## Overview

This update replaces the glitchy custom CSS zoom animation with **Animate.css**, a professional, battle-tested animation library that provides smooth, hardware-accelerated animations.

## What Changed

### Problem
The previous custom zoom animation was glitchy and caused visual artifacts during the transition between slides.

### Solution
Integrated **Animate.css** library and its smooth `zoomIn` animation for a professional, glitch-free experience.

## Files Modified

### 1. **templates/html.html.twig**
- Added Animate.css CDN link in the `<head>` section
- CDN: `https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css`

### 2. **css/slider.css**
- Removed glitchy custom `@keyframes` animation
- Simplified slide styles to work with Animate.css
- Added custom duration classes (`.animate__slow`, `.animate__slower`)
- Clean base styles with no transform conflicts

### 3. **js/slider.js**
- Updated to use Animate.css classes: `animate__animated`, `animate__zoomIn`, `animate__slower`
- Improved slide initialization (calls `showSlide(0)` on load)
- Increased slide duration to 6 seconds for better viewing experience
- Smoother class transitions with 50ms delay

## How It Works

The animation now uses Animate.css classes:
- **animate__animated** - Base class that enables animations
- **animate__zoomIn** - Smooth zoom-in effect from 95% to 100% scale
- **animate__slower** - 5-second animation duration (customizable in CSS)

## Installation Steps

1. **Backup your current theme**

2. **Replace these files:**
   - `templates/html.html.twig`
   - `css/slider.css`
   - `js/slider.js`

3. **Clear Drupal cache**
   - Go to: Configuration > Performance > Clear all caches
   - Or use Drush: `drush cr`

4. **Test the site**
   - Visit your home page
   - Visit gallery category pages
   - Check that animations are smooth and glitch-free

## Benefits

✅ **No More Glitches** - Professional, tested animations  
✅ **Hardware Accelerated** - Smooth 60fps animations  
✅ **Cross-Browser Compatible** - Works on all modern browsers  
✅ **Lightweight** - Animate.css is only ~80KB  
✅ **Maintained** - Regularly updated library with bug fixes  

## Customization

You can customize the animation by editing `js/slider.js`:

### Change Animation Type
Replace `animate__zoomIn` with other Animate.css animations:
- `animate__fadeIn` - Simple fade
- `animate__slideInUp` - Slide from bottom
- `animate__fadeInUp` - Fade and slide up
- [See all animations](https://animate.style/)

### Change Animation Duration
In `css/slider.css`, modify:
```css
.animate__slower {
    animation-duration: 5s !important; /* Change this value */
}
```

### Change Slide Duration
In `js/slider.js`, modify:
```javascript
slideInterval = setInterval(nextSlide, 6000); // Change 6000 (6 seconds)
```

## Troubleshooting

**Q: Animations not working?**
- Clear browser cache (Ctrl+F5 or Cmd+Shift+R)
- Clear Drupal cache
- Check browser console for errors

**Q: Animation too fast/slow?**
- Adjust `animation-duration` in `css/slider.css`
- Adjust `setInterval` timing in `js/slider.js`

**Q: Want different animation?**
- Visit https://animate.style/
- Pick an animation
- Replace `animate__zoomIn` in `js/slider.js`

## Technical Details

- **Library**: Animate.css v4.1.1
- **CDN**: Cloudflare CDN (fast, reliable)
- **Animation**: Hardware-accelerated CSS3 transforms
- **Performance**: Optimized with `will-change` property
- **Compatibility**: All modern browsers (Chrome, Firefox, Safari, Edge)

## Support

If you encounter any issues:
1. Check browser console for errors
2. Verify all three files were updated correctly
3. Ensure Drupal cache is cleared
4. Test in different browsers

---

**Note**: The Animate.css CDN is loaded from Cloudflare, which has excellent uptime and speed. However, if you prefer to host it locally, download the CSS file from https://animate.style/ and include it in your theme's CSS directory.
