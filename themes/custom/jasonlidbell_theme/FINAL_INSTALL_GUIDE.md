# Final Installation Guide - Exact Design Match

## What You'll Get

Your basic content pages (Discreet Service, About, Contact, etc.) will now look exactly like your screenshot:

✅ **Container**: Beige background (#F5F2EB) with rounded corners
✅ **Content**: Clean, no inner box, no shadows
✅ **Text**: Black/dark gray, left-aligned
✅ **Title**: Bold, left-aligned "Discreet Service"
✅ **Blog**: Completely unaffected

## Installation Steps

### 1. Upload Theme Files
Upload all files from the zip

### 2. Clear Drupal Cache (MANDATORY!)
**Configuration > Performance > "Clear all caches"**

### 3. Clear Browser Cache
**Ctrl + Shift + R** (or Cmd + Shift + R on Mac)

### 4. Test
Visit: `/discreet-service` 
Should look exactly like your screenshot!

## Design Details

### Container (.content-page-container)
- Background: #F5F2EB (beige)
- Border-radius: 20px
- Padding from edges
- Scrollable content

### Main Content (.content-page-main)
- NO background color
- NO box-shadow
- NO border
- Just clean content inside the beige container

### Typography
- Title: Georgia, 2.5rem, bold, black
- Body: Georgia, 1.05rem, dark gray (#333)
- Line-height: 1.8 for readability

## What's Protected

✅ Slider: Completely untouched
✅ Blog: Completely untouched (stays as-is)
✅ Gallery pages: Completely untouched

## Files in This Package

- `css/discreet-service-style.css` - NEW (your beige design)
- `css/slider.css` - Has your smooth animation
- `js/slider.js` - Has tab fix and timing
- `css/blog.css` - UNCHANGED (2 column layout preserved)
- All other files - As they were

## Remember

**You MUST clear Drupal cache!** 
Without this step, the new CSS won't load.

Configuration > Performance > Clear all caches

Then refresh browser with Ctrl+Shift+R
