# Shree Sweets WordPress Theme

## Logo & Favicon Setup

### Adding a Custom Logo
1. Go to **WordPress Admin > Appearance > Customize**
2. Click on **Site Identity**
3. Under **Logo**, click **Select Logo**
4. Upload your logo image (recommended: 300x100px, PNG/SVG format)
5. Click **Publish** to save

The logo will automatically replace the default "श्री" text logo in the header.

### Adding a Favicon
1. Go to **WordPress Admin > Appearance > Customize**
2. Click on **Site Identity**
3. Under **Site Icon**, click **Select Site Icon**
4. Upload a square image (recommended: 32x32px or 192x192px, ICO/PNG format)
5. Click **Publish** to save

The favicon will appear in browser tabs, bookmarks, and other places.

## Navigation Menu Setup

### Creating a Custom Menu
1. Go to **WordPress Admin > Appearance > Menus**
2. Click **Create a new menu**
3. Give your menu a name (e.g., "Primary Navigation")
4. Add menu items by selecting pages, posts, or custom links
5. Check the **Primary Menu** box under **Menu Settings**
6. Click **Save Menu**

### Default Menu Items
The theme automatically creates a default menu with these items:
- Home
- Shop
- Track Order
- About Us
- Contact

### Customizing Menu Names
To change menu item names:
1. Go to **WordPress Admin > Appearance > Menus**
2. Edit the menu item labels as desired
3. Save your changes

## Theme Features

### Responsive Design
- Mobile-first approach
- Optimized for all screen sizes
- Touch-friendly navigation

### WooCommerce Integration
- Full e-commerce support
- Custom product styling
- Shopping cart functionality

### Customizable Colors
- Brand color system using CSS variables
- Easy to modify colors in `style.css`

## File Structure

```
wordpress/shree-sweets/
├── functions.php          # Theme functions and setup
├── header.php             # Site header with logo and navigation
├── footer.php             # Site footer
├── style.css             # Main stylesheet
├── template-*.php        # Page templates
├── woocommerce/          # WooCommerce template overrides
└── assets/               # CSS, JS, and other assets
```

## Support

For customization help, refer to the WordPress Codex or contact your theme developer.