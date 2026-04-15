# Theme Update - Zoom Animation Fix

## Changes Made

### Slider Zoom Animation (css/slider.css)

**Problem:** The home page and gallery category page sliders were zooming images too much (from scale 1.15 to 1.35), making images difficult to view properly as they became too zoomed in.

**Solution:** Updated the zoom animation to be more subtle and zoom TO the normal size (scale 1.0) instead of beyond it.

#### Specific Changes:

**Before:**
- Slides started at: `transform: scale(1.15)`
- Slides zoomed to: `transform: scale(1.35)`
- Result: Images zoomed in too much, cutting off important content

**After:**
- Slides start at: `transform: scale(0.95)` (slightly zoomed out)
- Slides zoom to: `transform: scale(1.0)` (normal size, fully visible)
- Result: Images zoom in smoothly to their full, properly visible size

## Files Modified

1. `css/slider.css` - Updated the `.slide` initial transform and `@keyframes subtleZoom` animation

## Installation

1. Backup your current theme
2. Replace the `css/slider.css` file with the updated version
3. Clear your Drupal cache (Configuration > Performance > Clear all caches)
4. Refresh your browser to see the changes

## Testing

Visit the following pages to verify the changes:
- Home page (/) - The slider images should zoom smoothly to normal size
- Gallery category pages - Images should be fully visible and not overly zoomed

## Notes

- The animation duration remains 8 seconds
- The fade transition (2 seconds) is unchanged
- This affects both the home page slider and gallery category page sliders
- The zoom is now subtle and elegant, keeping the entire image visible throughout the animation
