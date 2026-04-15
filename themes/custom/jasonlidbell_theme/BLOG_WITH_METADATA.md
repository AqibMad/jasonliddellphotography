# Blog Cards with Metadata - Final Design

## What's Changed

### 1. ✅ Limited Excerpt Text
- Text limited to **4 lines** using `-webkit-line-clamp`
- Prevents overflow and keeps cards consistent
- Adds ellipsis (...) if text is too long

### 2. ✅ Read More Button
- **Black button** with white text
- Arrow icon (→) added automatically
- Hover: Slides right and darkens

### 3. ✅ Metadata Row (Inline)
After the Read More button, shows:
- **Date** (e.g., "July 3, 2014")
- **Author** (e.g., "Liddell")
- **Leave A Comment** link
- **Category** (e.g., "Uncategorized")

All styled as **small black buttons** in a row.

## Card Structure

```
┌─────────────────────────────────┐
│ TITLE IN UPPERCASE              │
│                                 │
│ Excerpt text limited to 4       │
│ lines with ellipsis if too      │
│ long to fit in the space...     │
│                                 │
│ [Read More →]                   │
│                                 │
│ [July 3, 2014] [Author]         │
│ [Leave Comment] [Category]      │
└─────────────────────────────────┘
```

## Styling

**Read More Button:**
- Background: #000
- Padding: 10px 25px
- Border-radius: 8px
- Arrow icon: →

**Metadata Buttons:**
- Background: #000
- Padding: 6px 14px
- Border-radius: 6px
- Font: 0.75rem, uppercase, bold
- Display: inline-flex with 15px gap

## CSS Features

```css
/* 4-line text limit */
-webkit-line-clamp: 4;

/* Footer metadata inline */
footer {
    display: flex;
    gap: 15px;
}

/* Black buttons for all metadata */
footer > div {
    background: #000;
    color: #fff;
}
```

## Result

Clean, professional blog cards matching your Figma design with:
- Limited text (no overflow)
- Clear Read More button
- Organized metadata in footer
- Consistent styling throughout

## Installation

1. Upload `css/blog.css`
2. Clear Drupal cache
3. Clear browser cache
4. Perfect!
