# Animate.css Theme - Optimized & Faster

## What This Is

This theme uses **Animate.css** for smooth, professional animations with optimizations for better performance and faster animation speed.

## Changes Made

### 1. Kept Animate.css (as requested!)
- **CDN**: Added in `templates/html.html.twig`
- **Animation**: Using `animate__zoomIn` effect
- **Speed**: Using `animate__faster` class (0.8 seconds)

### 2. Optimizations for Smoothness
- **GPU Acceleration**: Added `translateZ(0)` for hardware rendering
- **Anti-flickering**: Added `backface-visibility: hidden`
- **Font smoothing**: Added `-webkit-font-smoothing: antialiased`
- **RequestAnimationFrame**: Syncs animation with browser rendering
- **Transition prevention**: Prevents overlapping animations

### 3. Faster Animation Speed
- **Animation duration**: 0.8 seconds (fast and smooth)
- **Slide interval**: 5 seconds per slide
- **Fade out**: 0.8 seconds

## Files Modified

1. **templates/html.html.twig** - Added Animate.css CDN
2. **css/slider.css** - Added optimizations + faster speed
3. **js/slider.js** - Added smoothness improvements + faster timing

## Installation

1. **Backup your theme**
2. **Upload these 3 files** (replace existing)
3. **Clear Drupal cache**: Configuration > Performance > Clear all caches
4. **Clear browser cache**: Ctrl+Shift+R (Windows) or Cmd+Shift+R (Mac)
5. **Test**: Visit home page and gallery pages

## Customization

### Make Animation Even Faster
In `css/slider.css` line 90:
```css
.animate__faster {
    animation-duration: 0.8s !important; /* Change to 0.5s for faster */
}
```

### Make Animation Slower
Change to:
```css
.animate__faster {
    animation-duration: 1.5s !important; /* Slower */
}
```

### Change Slide Duration
In `js/slider.js` line 53:
```javascript
slideInterval = setInterval(nextSlide, 5000); // 5 seconds
                                      ^^^^^ Change this
```

### Use Different Animate.css Effect
In `js/slider.js`, replace `animate__zoomIn` with:
- `animate__fadeIn` - Simple fade
- `animate__fadeInUp` - Fade up
- `animate__slideInUp` - Slide up
- `animate__bounceIn` - Bounce effect
- See all: https://animate.style/

Example in line 26 and 77:
```javascript
nextSlide.classList.add('animate__animated', 'animate__fadeIn', 'animate__faster');
```

## What's Included

✅ **Animate.css CDN** (as you requested)  
✅ **Optimized for smoothness** (GPU acceleration, anti-flicker)  
✅ **Faster animation** (0.8s instead of 5s)  
✅ **Smooth transitions** (RequestAnimationFrame)  
✅ **All original theme files** (nothing removed)

## Troubleshooting

**Still not smooth?**
1. Clear BOTH Drupal and browser cache
2. Try in Chrome or Firefox first
3. Check image sizes (optimize to <500KB each)
4. Disable browser extensions/ad blockers
5. Try incognito mode

**Animation too fast?**
- Increase the duration in `.animate__faster` class

**Animation too slow?**
- Decrease the duration in `.animate__faster` class

## Summary

This is the **Animate.css version** you wanted, with:
- Smoothness optimizations added
- Faster animation speed (0.8s)
- Better performance
- Nothing removed, only improved!
