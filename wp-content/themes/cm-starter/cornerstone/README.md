Instructions after cloning this theme, or after manually installing _S theme in a fresh install
===

- [ ] clone or backup CM Starter (with plugins, etc. included)
- [ ] install fresh copy of _S.
- [ ] require get_template_directory() . '/cornerstone/cornerstone-functions.php';
- [ ] Go through cornerstone-functions.php file and determine which functionality will be needed for the site
- [ ] Add all of the missing root directory files
    - page-home.php
    - template-flexible.php
    - package.json
    - gulpfile.js
- [ ] Update package.json
- [ ] Install all dependencies via npm install
- [ ] Update breakpoints for Tachyons (no longer needed since tachyons ships with theme)
- [ ] Merge the _S "wp_enqueue_scripts" function with the CM Starter version
- [ ] Turn debug mode on (wp-config) for local development
- [ ] Pull style.css from CM-Starter -- since _S adds lots of styles for the main navigation
- [ ] Remove Normalize from _S style.css since normalize comes with tachyons
- [ ] Replace Theme Name and details in style.css
- [ ] Replace screenshot.png in theme root
- [ ] Get client to connect Google Analytics
- [ ] Uncheck Organize Uploads by Year and Month
- [ ] Change Permalink structure
- [ ] Uncheck "Organize my uploads into month and year based folders"
- [ ] If on CloudWays, set up deployApplication.php
