# Blog Layout Fix - 2 Column Grid

## Problem

Blog was showing **1 column** instead of **2 columns** (2x2 grid layout).

## Solution

Updated CSS selectors to target the correct Drupal view structure:

### Added Selectors:
```css
/* Target the view-content directly */
body .view-blog .view-content,
body .view-content {
    display: grid !important;
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 30px !important;
}

/* Also target nested structures */
body .views-element-container > div,
body .view-blog > .view-content,
body .blog-listing-wrapper .view-content {
    display: grid !important;
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 30px !important;
}
```

## What You'll Get

✅ **2 blogs per row** (2 columns)
✅ **4 blogs per page** (2 rows)  
✅ **Beige/white cards** with rounded corners
✅ **Pagination** at the bottom (1, 2, ››, Last »)
✅ **Proper spacing** between cards (30px gap)

## Blog Card Design (from Figma)

- Background: #F5F5F0 (beige/off-white)
- Border-radius: 15px
- Padding: 35px
- Shadow: 0 4px 15px rgba(0, 0, 0, 0.15)
- Title: Uppercase, bold
- Image: Inside card, rounded corners
- Excerpt: Gray text
- Tags: Black buttons at bottom

## Installation

1. Upload updated `css/blog.css`
2. **Clear Drupal cache** (CRITICAL!)
3. **Clear browser cache** (Ctrl+Shift+R)
4. Visit `/blog` page
5. Should show 2 columns with 4 blog posts

## If Still Showing 1 Column

### Debug Steps:

1. **Open DevTools** (F12)
2. **Inspect** the blog listing area
3. **Find** the element with class `.view-content`
4. **Check** if it has `display: grid` in Computed styles
5. **Look for** any conflicting CSS

### Force Clear Cache:

If regular cache clear doesn't work:
```bash
# Delete CSS cache
rm -rf sites/default/files/css/*
rm -rf sites/default/files/js/*

# Then clear Drupal cache
drush cr
```

## Current vs Expected

### Current (Wrong):
```
┌─────────────────┐
│  Blog Post 1    │
└─────────────────┘
┌─────────────────┐
│  Blog Post 2    │
└─────────────────┘
```

### Expected (Correct):
```
┌─────────┐ ┌─────────┐
│ Post 1  │ │ Post 2  │
└─────────┘ └─────────┘
┌─────────┐ ┌─────────┐
│ Post 3  │ │ Post 4  │
└─────────┘ └─────────┘
```

## Responsive Behavior

- **Desktop** (>768px): 2 columns
- **Tablet** (768px): 2 columns  
- **Mobile** (<768px): 1 column

The CSS is already configured for this.
