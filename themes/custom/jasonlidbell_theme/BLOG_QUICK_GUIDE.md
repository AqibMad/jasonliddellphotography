# BLOG SETUP - Quick Reference Guide

## 🎯 **Your Blog is Ready!**

The theme now includes complete blog styling with:
- ✅ 2-column grid layout
- ✅ 4 posts per page
- ✅ Pagination support
- ✅ Beautiful blog cards
- ✅ Detail page design
- ✅ Fully responsive

---

## 📥 **Quick Setup (2 Methods)**

### **METHOD 1: Devel Generate (5 Minutes - RECOMMENDED)**

#### Step 1: Install Devel Module

**Via Composer:**
```bash
cd /var/www/html/drupalphotography
composer require drupal/devel
drush en devel devel_generate -y
drush cr
```

**Via Drupal UI:**
1. Download: https://www.drupal.org/project/devel
2. Go to: **Extend** → **Install new module**
3. Upload the downloaded file
4. Enable **Devel** and **Devel Generate**

#### Step 2: Generate Blog Posts

**Via Drush (Command Line):**
```bash
drush devel-generate-content 20 --bundles=article
```

**Via Drupal UI:**
1. Go to: **Configuration** → **Development** → **Generate content**
   (`/admin/config/development/generate/content`)

2. Fill in:
   - **Content type:** Article
   - **Number of nodes:** 20
   - **Max words in body:** 300
   - **Title length:** 5-10 words
   - Check: **Add an alias**
   - Check: **Set created date**
   
3. Click **Generate**

#### Step 3: Create Blog View

1. Go to **Structure** → **Views** → **Add view**

2. Settings:
   ```
   View name: Blog
   Show: Content of type Article
   Sorted by: Newest first (Post date descending)
   
   Page Settings:
   ✓ Create a page
   Path: /blog
   Display format: Unformatted list (or Grid)
   Items per page: 4
   ✓ Use a pager
   ```

3. Click **Save and edit**

4. In **FORMAT** section:
   - Style: Grid or Unformatted list
   - Show: Content (Teaser view mode)

5. In **FIELDS** section, add:
   - Content: Image
   - Content: Title
   - Content: Body (trimmed, 200 chars)
   - Content: Post date
   - Content: Read more link

6. In **FILTER CRITERIA**, add:
   - Content: Published (Yes)
   - Content: Type (Article)

7. **Save** view

Done! Visit `/blog` to see your blog!

---

### **METHOD 2: Manual Entry (30 Minutes)**

#### Create 10 Quick Blog Posts

1. Go to **Content** → **Add content** → **Article**

2. Use these quick templates:

**Blog Post 1:**
```
Title: 5 Tips for Stunning Portrait Photography
Body: Master the art of portrait photography with these essential techniques. Learn about lighting, composition, and connecting with your subjects to create memorable images that capture personality and emotion.
```

**Blog Post 2:**
```
Title: Behind the Scenes: Wedding Photography
Body: Discover the secrets of successful wedding photography. From preparation to execution, learn how to capture every precious moment while staying invisible and professional throughout the day.
```

**Blog Post 3:**
```
Title: Understanding Natural Light Photography
Body: Natural light is a photographer's best friend. Learn how to work with golden hour, diffused light, and challenging conditions to create stunning images without expensive equipment.
```

**Blog Post 4:**
```
Title: How to Choose Your Photography Package
Body: Confused about which photography package to select? This guide breaks down everything you need to know about choosing the perfect package for your needs and budget.
```

**Blog Post 5:**
```
Title: The Art of Food Photography
Body: Food photography requires special techniques. Learn about styling, lighting, and composition to make dishes look irresistible. Perfect for restaurant owners and food bloggers.
```

**Blog Post 6:**
```
Title: Boudoir Photography: What to Expect
Body: Boudoir sessions are empowering experiences. Learn what happens during a session, how to prepare, and why so many clients describe it as life-changing.
```

**Blog Post 7:**
```
Title: Dance Photography Techniques
Body: Capturing movement requires skill and timing. Discover the techniques professional photographers use to freeze or blur motion for dramatic dance photography.
```

**Blog Post 8:**
```
Title: Product Photography for Small Businesses
Body: Great product photos boost sales. Learn how to photograph your products professionally even with basic equipment and simple lighting setups.
```

**Blog Post 9:**
```
Title: Preparing for Your Photo Session
Body: Get the most from your photo session with proper preparation. From outfit selection to mindset, here's everything you need to know before your shoot.
```

**Blog Post 10:**
```
Title: Why Print Your Photos in 2024
Body: In our digital age, printed photographs have become treasures. Discover why printing your favorite images creates lasting value and emotional connection.
```

3. For each post:
   - Add a featured image (optional)
   - Set **Published** status
   - Save

4. Create the Blog View (same as Method 1, Step 3 above)

---

## 🎨 **What's Included in Theme**

### **Blog Listing Page (/blog)**
✅ 2-column grid layout
✅ 4 posts per page
✅ Beautiful blog cards with:
   - Featured image
   - Title
   - Excerpt (200 chars)
   - Read more link
   - Hover effects

✅ Pagination at bottom
✅ Fully responsive (single column on mobile)

### **Blog Detail Page**
✅ Full-width content layout
✅ Large featured image
✅ Beautiful typography
✅ Tag display
✅ "Back to Blog" button
✅ Scrollable content
✅ Responsive design

### **Styling Features**
✅ Dark theme matching your site
✅ Blue accent colors
✅ Smooth hover animations
✅ Touch-friendly on mobile
✅ Professional card design
✅ Custom pagination styling

---

## 📱 **Responsive Behavior**

### **Desktop (>1024px)**
- 2 columns
- 4 posts per page
- Large images

### **Tablet (768-1023px)**
- 2 columns
- Slightly smaller
- Touch-optimized

### **Mobile (<768px)**
- 1 column
- Full-width cards
- Stack vertically
- Easy scrolling

---

## 🎯 **View Configuration**

### **Display Settings**

**For Blog Listing:**
```
Format: Grid (2 columns) or Unformatted list with blog.css
Show: Teaser view mode
Items: 4 per page
Pager: Full pager
Sort: Post date (newest first)
```

**For Teaser Display:**
Go to: **Structure** → **Content types** → **Article** → **Manage display** → **Teaser**

Configure:
```
Image: Show, Medium (220×220) image style
Title: Show, linked to content
Body: Trimmed, 200 characters
Post date: Show
```

---

## 🔧 **Troubleshooting**

### **Blog page not styled correctly?**
1. Clear cache: **Configuration** → **Development** → **Performance** → **Clear all caches**
2. Hard refresh browser: Ctrl+Shift+R

### **2-column layout not showing?**
Make sure your View uses:
- Format: Grid with 2 columns, OR
- Format: Unformatted list (CSS will handle columns)

### **No "Generate content" menu?**
Devel module not installed. See Method 1, Step 1.

### **Articles not showing?**
Check View filters:
- Published: Yes
- Content type: Article

---

## ⚡ **Quick Commands Reference**

```bash
# Install Devel
composer require drupal/devel
drush en devel devel_generate -y

# Generate 20 blog posts
drush devel-generate-content 20 --bundles=article

# Or with more options
drush genc 20 article --kill --languages=en

# Clear cache
drush cr

# Check if articles exist
drush sqlq "SELECT COUNT(*) FROM node_field_data WHERE type='article'"
```

---

## ✨ **What You Get**

### **After Setup:**
1. Visit `/blog` - See beautiful blog grid
2. Click any post - Read full article
3. Use pagination - Navigate through posts
4. Test on mobile - Responsive design works perfectly

### **Client Can:**
1. Add new blog posts easily
2. Upload featured images
3. Write content in WYSIWYG
4. Publish/unpublish posts
5. See automatic 2-column layout

---

## 📚 **Files Added/Modified**

### **New Files:**
- `css/blog.css` - Complete blog styling
- `templates/page--blog.html.twig` - Blog listing template
- `BLOG_SETUP_COMPLETE.md` - Full documentation

### **Modified Files:**
- `jasonlidbell_theme.libraries.yml` - Added blog.css

---

## 🎉 **Next Steps**

1. ✅ Install Devel module
2. ✅ Generate 20 blog posts
3. ✅ Create Blog view
4. ✅ Clear cache
5. ✅ Visit `/blog`
6. ✅ Enjoy your beautiful blog!

---

## 💡 **Pro Tips**

### **For Better Blog Posts:**
- Add featured images to each post
- Use 200-300 words for excerpts
- Write catchy titles
- Add tags for organization
- Set proper publish dates

### **For Best Performance:**
- Enable image optimization
- Use appropriate image sizes
- Enable caching
- Optimize database

### **For SEO:**
- Install Pathauto module for clean URLs
- Add meta tags module
- Use descriptive titles
- Add alt text to images

---

**Your blog is ready to go! Just choose a method and follow the steps.** 🚀

**Estimated Time:**
- Method 1 (Devel): 5-10 minutes
- Method 2 (Manual): 30-45 minutes

Both methods give you a fully functional, beautiful blog!
