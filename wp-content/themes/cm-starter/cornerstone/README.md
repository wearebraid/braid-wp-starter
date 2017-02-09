Instructions after cloning this theme, or after manually installing _S theme in a fresh install
===

- clone or backup CM Starter (with plugins, etc. included)
- install fresh copy of _S.
- require get_template_directory() . '/cornerstone/cornerstone-functions.php';
- Go through cornerstone-functions.php file and determine which functionality will be needed for the site
- Update package.json
- Install all dependencies via npm install
- Update breakpoints for Tachyons
- Merge the _S "wp_enqueue_scripts" function with the CM Starter version
- Turn debug mode on (wp-config) for local development
