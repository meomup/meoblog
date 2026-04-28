# News Flat Modern - WordPress Theme

A modern, flat design WordPress theme specifically built for news portals, magazines, and content-heavy websites. Features a clean homepage layout, category gallery menu, and beautiful photo album interface.

## Features

### 🎨 Design
- **Modern Flat Design**: Clean, minimalist aesthetic with subtle shadows and smooth transitions
- **Responsive Layout**: Fully responsive design that works on all devices
- **Custom Color Scheme**: Easily customizable colors through WordPress Customizer
- **Google Fonts Integration**: Uses Inter and Merriweather fonts for optimal readability

### 📰 Homepage
- **Featured Section**: Large hero area with main story and side featured items
- **News Grid**: Clean card-based layout for latest articles
- **Category Badges**: Color-coded category labels on each post
- **Post Meta**: Display date, author, and comment count

### 🖼️ Gallery/Album
- **Photo Album Template**: Dedicated page template for photo galleries
- **Category Filtering**: Filter images by category with smooth animations
- **Lightbox Viewer**: Full-screen image viewer with navigation
- **Hover Effects**: Beautiful overlay effects on hover

### 🍔 Navigation
- **Category Menu**: Automatic category-based navigation menu
- **Dropdown Support**: Multi-level menu support
- **Mobile Responsive**: Hamburger menu for mobile devices
- **Sticky Header**: Header stays visible on scroll

### ⚙️ Technical
- **WordPress 5.0+ Compatible**: Built with latest WordPress standards
- **Gutenberg Ready**: Full block editor support
- **SEO Optimized**: Semantic HTML5 markup
- **Performance Optimized**: Minimal dependencies, fast loading
- **Translation Ready**: Full internationalization support

## Installation

1. Download the theme folder `news-flat-theme`
2. Upload to `/wp-content/themes/` directory
3. Activate through WordPress Admin → Appearance → Themes
4. Configure theme options in Customizer

## Setup Instructions

### Creating a Gallery Page

1. Create a new Page in WordPress
2. Select "Album Gallery" as the page template
3. Publish the page
4. Add posts with featured images - they will automatically appear in the gallery

### Menu Configuration

1. Go to Appearance → Menus
2. Create a new menu or edit existing
3. Assign to "Primary Menu" location
4. Add categories for automatic organization

### Recommended Settings

- **Homepage**: Set a static front page using the default template
- **Posts Page**: Create a blog page for standard post listing
- **Featured Images**: Use images at least 1200x600px for best results
- **Categories**: Organize content with clear category structure

## Customization

### Colors

Access via Appearance → Customize → Theme Colors:
- Primary Color (default: #3498db)
- Secondary Color (default: #2c3e50)
- Accent Color (default: #e74c3c)

### Logo

1. Go to Appearance → Customize → Site Identity
2. Upload your custom logo
3. Recommended size: 250x80px

### Widgets

Available widget areas:
- Sidebar
- Footer Widget 1
- Footer Widget 2

## File Structure

```
news-flat-theme/
├── style.css                 # Main stylesheet with theme info
├── functions.php             # Theme functions and features
├── header.php                # Header template
├── footer.php                # Footer template
├── index.php                 # Main template file
├── single.php                # Single post template
├── page.php                  # Page template
├── category.php              # Category archive template
├── page-gallery.php          # Gallery page template
├── js/
│   └── navigation.js         # Navigation and interactions
├── template-parts/
│   └── content-card.php      # Post card component
├── images/                   # Theme images
└── languages/                # Translation files
```

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Opera (latest)

## Changelog

### Version 1.0.0
- Initial release
- Homepage with featured section and news grid
- Category gallery menu
- Photo album template with lightbox
- Responsive design
- Customizer options

## Credits

- **Fonts**: Google Fonts (Inter, Merriweather)
- **Icons**: Inline SVG icons
- **License**: GPL v2 or later

## Support

For support and updates, please visit the theme repository or contact the developer.

---

**License**: This theme is licensed under the GNU General Public License v2 or later.
