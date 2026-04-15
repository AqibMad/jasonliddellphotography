# Store Page - Complete Setup & Troubleshooting

## ✅ Files Created:

1. **css/store.css** - Store page styling (3-column grid)
2. **templates/views-view--store.html.twig** - Store view wrapper
3. **templates/views-view-unformatted--store--default.html.twig** - Product cards template
4. **templates/commerce-product--teaser.html.twig** - Individual product card
5. **jasonlidbell_theme.theme** - Store view preprocessing functions
6. **jasonlidbell_theme.libraries.yml** - Updated with store library

## 🔧 EXACT Setup Steps:

### 1️⃣ Create Store View (Admin > Structure > Views)

```
View Name: store
(IMPORTANT: Must be exactly "store" for template to match!)

Content Type: Commerce Product
Create Display: Page
Page Path: /store (or /products)
```

### 2️⃣ Configure View Settings

**Display Settings:**
- Format: **Unformatted List** (NOT Grid)
- Show items per page: 30

**Fields to display:**
- ✓ Title
- ✓ Image (field_image)  
- ✓ Price (field_price)
- ✓ Body

### 3️⃣ Save & Test

- Save the view
- Go to `/store` URL
- Clear Drupal cache:

```bash
drush cr
```

Or via Admin:
**Configuration > Development > Performance > Clear all caches**

## 🎯 How Templates Work:

When you visit `/store`:

1. **views-view--store.html.twig** loads (view wrapper with header)
2. **views-view-unformatted--store--default.html.twig** loads (renders product rows)
3. Each row becomes a **product-card** with styling from **store.css**
4. **store.css** creates the 3-column grid with #857D74 theme

## 🚨 If Design Still Not Applying:

### Check 1: Cache is Cleared
```bash
drush cr
```

### Check 2: View Name is "store"
Go to: Admin > Structure > Views  
Find your view - it must be named **"store"** exactly

### Check 3: Template Exists
These files must exist:
- `themes/custom/jasonlidbell_theme/templates/views-view--store.html.twig`
- `themes/custom/jasonlidbell_theme/templates/views-view-unformatted--store--default.html.twig`
- `themes/custom/jasonlidbell_theme/css/store.css`

### Check 4: CSS Library Included
In `jasonlidbell_theme.libraries.yml`:
- store.css must be in global-styling with weight: 150 ✓

### Check 5: Browser Cache
- Hard refresh: **Ctrl+Shift+R** (Windows) or **Cmd+Shift+R** (Mac)
- Or clear browser cache completely

## 🎨 Design Features Applied:

✅ 3-column grid (desktop)
✅ 2-column grid (tablet)  
✅ 1-column grid (mobile)
✅ Product card hover effects
✅ Image zoom on hover
✅ Overlay "View Details" button
✅ Currency symbols ($, €, £, ₹)
✅ Price display
✅ Product description (truncated)
✅ "Add to Cart" button
✅ All in #857D74 brown theme color
✅ Professional shadows and effects

## 📱 Responsive Breakpoints:

- **Desktop** (> 992px): 3 columns
- **Tablet** (768px - 992px): 2 columns
- **Mobile** (< 768px): 1 column

---

## 🎉 Everything is Ready!

Your store page should now display all products in a beautiful 3-column grid with the custom #857D74 theme.
