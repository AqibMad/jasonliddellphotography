# Simple Blog - Title, Paragraph, Read More

## What's Included

Blog cards now show ONLY 3 things:

1. **Title** (uppercase, bold, black)
2. **Paragraph** (excerpt, limited to 5 lines)
3. **Read More Button** (black button with arrow)

## Template: `node--blog--teaser.html.twig`

Outputs clean HTML:

```html
<article>
  <h2><a href="...">TITLE</a></h2>
  
  <div class="blog-excerpt">
    <p>Excerpt text limited to 5 lines...</p>
  </div>
  
  <div class="blog-read-more">
    <a href="..." class="read-more-link">Read more →</a>
  </div>
</article>
```

## What's Hidden

Everything else is hidden with CSS:
- ❌ No dates
- ❌ No author
- ❌ No tags
- ❌ No metadata
- ❌ No images
- ❌ No footer

## Result

Clean, simple blog cards:

```
┌─────────────────────────┐
│ TITLE IN UPPERCASE      │
│                         │
│ Lorem ipsum text here   │
│ limited to 5 lines with │
│ proper spacing...       │
│                         │
│ [Read more →]           │
└─────────────────────────┘
```

## Installation

1. Upload theme files
2. Clear Drupal cache
3. Clear browser cache
4. Done!

Simple and clean!
