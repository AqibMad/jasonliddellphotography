# QUICK START GUIDE - Updated Theme Installation

## 3-Step Installation

### 1. Upload Files
- Replace your current theme files with these updated files
- Keep your existing images and logo

### 2. Clear Cache
- Go to: **Configuration** → **Development** → **Performance**
- Click: **"Clear all caches"**

### 3. Create Pages
Follow the instructions below to add your new pages

---

## Adding the Discreet Service Page

### Step-by-Step:

1. **Navigate:** Content → Add Content → Basic Page

2. **Fill in Title:** 
   ```
   Discreet Service
   ```

3. **Add Body Content (copy this HTML):**
   ```html
   <h1>Discreet Service</h1>

   <p class="lead-text">Professional photography with complete privacy and confidentiality</p>

   <h2>What We Offer</h2>
   <p>Complete privacy and discretion for all your photography needs.</p>

   <h2>Services Include</h2>
   <ul>
     <li>Private studio sessions</li>
     <li>Non-disclosure agreements</li>
     <li>Secure file delivery</li>
     <li>Complete confidentiality</li>
   </ul>

   <h2>Contact for Booking</h2>
   <p>Reach out to discuss your private session needs.</p>
   ```

4. **Set URL Alias:**
   - Expand "URL Path Settings" section
   - Check "Generate automatic URL alias" OR
   - Uncheck it and type: `/discreetservice`

5. **Click Save**

---

## Adding Other Pages

Use the same process but with these settings:

### About Page
- **URL:** `/about`
- **Title:** "About Me" or "About"

### Contact Page  
- **URL:** `/contact`
- **Title:** "Contact"

### Blog Page
- **URL:** `/blog`
- **Title:** "Blog"

---

## What's Fixed

✅ **Before:** Menu items showed as unstyled blue links with broken layout
✅ **After:** Clean, professional content pages with proper styling

### New Features:
- Elegant typography matching your brand
- Proper spacing and margins
- Dark theme consistent with galleries
- Responsive design for all devices
- Pre-styled forms for contact pages
- Professional color scheme

---

## Template Magic

The theme automatically applies the right template based on your URL:

- `/about` → Clean about page layout
- `/contact` → Contact page with form styling  
- `/blog` → Blog-optimized layout
- `/discreetservice` → Discreet service page

**No extra work needed!** Just create the page with the right URL and it looks perfect.

---

## Styling Highlights

### Content Pages Feature:
- ✨ Centered content (max 900px for readability)
- ✨ Beautiful headings in your brand fonts
- ✨ Links in brand blue with hover effects
- ✨ Forms styled and ready to use
- ✨ Images with rounded corners and shadows
- ✨ Professional spacing throughout

---

## Need Help?

### Issue: Template not working?
**Fix:** 
1. Check URL alias matches exactly
2. Clear cache again
3. Refresh browser (Ctrl + Shift + R)

### Issue: Styling looks off?
**Fix:**
1. Clear Drupal cache
2. Clear browser cache
3. Make sure `content-pages.css` file is uploaded

### Issue: Menu items still blue?
**Note:** That's normal for Drupal menus. The actual page content will be styled beautifully. The sidebar menu is already styled perfectly.

---

## File Checklist

Make sure these files are uploaded:

**New Templates:**
- ✅ `templates/page--about.html.twig`
- ✅ `templates/page--contact.html.twig`  
- ✅ `templates/page--blog.html.twig`
- ✅ `templates/page--discreetservice.html.twig`
- ✅ `templates/page--discreet-service.html.twig`

**New CSS:**
- ✅ `css/content-pages.css`

**Updated File:**
- ✅ `jasonlidbell_theme.libraries.yml`

---

## Pro Tips

💡 **Tip 1:** Use `<h1>` for page titles, `<h2>` for sections
💡 **Tip 2:** Add `class="lead-text"` to opening paragraphs for emphasis
💡 **Tip 3:** URLs are case-sensitive - use lowercase
💡 **Tip 4:** Always clear cache after making changes

---

**That's it!** You now have a professional, clean theme for all your content pages. No more broken layouts when adding new pages!

Questions? Check the full README_UPDATED.md file for detailed information.
