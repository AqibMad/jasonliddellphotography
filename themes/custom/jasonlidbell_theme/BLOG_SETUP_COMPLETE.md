# Quick Blog Setup with Dummy Content

## Method 1: Install Devel Generate (Recommended)

### Installation Steps:

#### Via Composer (Recommended):
```bash
cd /path/to/your/drupal
composer require drupal/devel
drush en devel devel_generate -y
drush cr
```

#### Via Drupal Admin Interface:
1. Go to **Extend** (admin/modules)
2. Click **"Install new module"**
3. Enter URL: `https://ftp.drupal.org/files/projects/devel-5.x.tar.gz`
4. Click **Install**
5. Enable **Devel** and **Devel Generate**
6. Clear cache

### Generate Dummy Blog Posts:

1. Go to: **Configuration** → **Development** → **Generate content**
   (URL: `/admin/config/development/generate/content`)

2. Fill in the form:
   - **Content type:** Select "Article" or "Basic page"
   - **Number of nodes:** 20 (or however many you want)
   - **Maximum number of words:** 500
   - **Title length:** 5-10 words
   - Check **"Add an alias"**
   - Check **"Set created date to random date"**
   - Set **Author:** User 1 or any user
   
3. Click **Generate**

4. Done! You now have 20 dummy blog posts!

---

## Method 2: Use Drush (Command Line)

If you have Drush installed:

```bash
# Generate 20 article nodes
drush devel-generate-content 20 --bundles=article

# Or with more options
drush genc 20 article --kill --languages=en
```

---

## Method 3: Manual Quick Entry (Without Module)

If you can't install modules, here's a quick manual method:

### Create Blog Content Type (if not exists):

1. **Structure** → **Content types** → **Add content type**
2. Name: "Blog"
3. Add fields:
   - Body (already exists)
   - Image (Media or Image field)
   - Tags (Term reference)
   - Date

### Quick Blog Template:

Use this template to quickly create blogs (copy/paste):

**Blog 1:**
Title: "5 Tips for Amazing Portrait Photography"
Body: "Portrait photography is an art that requires both technical skill and creative vision. Here are five essential tips to elevate your portrait game. First, understand lighting - natural light during golden hour creates stunning results. Second, focus on the eyes - they're the window to the soul. Third, use a shallow depth of field to create beautiful bokeh. Fourth, make your subject comfortable to capture genuine expressions. Finally, experiment with different angles and perspectives..."

**Blog 2:**
Title: "Behind the Scenes: Wedding Photography Secrets"
Body: "Wedding photography is one of the most rewarding yet challenging genres. After shooting over 100 weddings, I've learned invaluable lessons. Preparation is key - scout the venue beforehand and create a shot list with the couple. Stay calm under pressure - weddings are unpredictable. Build rapport with guests to capture candid moments. Always have backup equipment..."

**Blog 3:**
Title: "How to Choose the Perfect Photography Package"
Body: "Choosing the right photography package can be overwhelming. Here's what you need to know. First, identify your needs - are you looking for event coverage, portraits, or commercial work? Second, consider your budget and what's included. Third, review the photographer's portfolio to ensure their style matches your vision. Don't forget to ask about delivery timeline and image rights..."

[Continue with 17 more similar blogs...]

---

## Method 4: Import CSV (Advanced)

### Step 1: Install Feeds Module

```bash
composer require drupal/feeds
drush en feeds -y
```

### Step 2: Create CSV File

Create `blog_posts.csv`:

```csv
title,body,created
"Amazing Landscape Photography Tips","Learn how to capture stunning landscapes...","2024-01-15"
"Portrait Lighting Techniques","Master the art of portrait lighting...","2024-01-16"
"Wedding Photography Guide","Everything you need to know about shooting weddings...","2024-01-17"
```

### Step 3: Import via Feeds

1. **Structure** → **Feeds** → **Add feed type**
2. Configure mapping: CSV columns to node fields
3. Import your CSV

---

## Recommended: Devel Generate Setup

This is the FASTEST method:

### Quick Command (if you have Drush):

```bash
# Install devel
composer require drupal/devel
drush en devel devel_generate -y

# Generate 20 blog posts
drush genc 20 article --kill

# Clear cache
drush cr
```

### Via UI (if no command line):

1. Download: https://www.drupal.org/project/devel
2. Extract to: `/modules/contrib/devel/`
3. Enable: **Extend** → Check **Devel** and **Devel Generate**
4. Generate: **Configuration** → **Development** → **Generate content**

---

## After Generating Content

### Create Blog Listing View:

1. **Structure** → **Views** → **Add view**
2. Settings:
   - View name: "Blog"
   - Show: "Content" of type "Article"
   - Create a page: YES
   - Path: `/blog`
   - Display format: **Grid** (2 columns)
   - Items per page: **4**
   - Use pager: YES

3. **Fields to display:**
   - Image (featured image)
   - Title (linked to content)
   - Body (trimmed to 200 chars)
   - Post date
   - Read more link

4. **Save**

### Blog Teaser Display:

1. **Structure** → **Content types** → **Article** → **Manage display**
2. Select **Teaser** view mode
3. Configure:
   - Image: Show, image style "Medium"
   - Title: Show, linked
   - Body: Trimmed, 200 characters
   - Hide other fields

---

## Blog Page Layout (2 Columns, 4 per page)

### Option A: Use Views Grid

In your blog view:
- Format: **Grid**
- Number of columns: **2**
- Items per page: **4**
- Use pager: **Yes**

### Option B: Use Views + Custom Template

Create view with:
- Format: **Unformatted list**
- Items per page: **4**

Then create custom CSS for 2-column layout (I'll provide this)

---

## Quick Summary

**FASTEST METHOD:**
1. Install Devel module
2. Go to Configuration → Development → Generate content
3. Generate 20 article nodes
4. Create Views for blog listing
5. Done in 5 minutes!

**NO MODULE METHOD:**
1. Manually create 10-20 blog posts using template above
2. Create Views for display
3. Takes about 30 minutes

Which method would you prefer? I can provide detailed steps for whichever you choose!
