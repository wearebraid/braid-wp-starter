# Braid WP Starter

Originally based off [Underscores](https://underscores.me/) many moons ago. Now it's something of its own.

## Notable Features
- Full Vue3 w/ Vuex compatibility. Use Vue components anywhere in your templates.
- Vite build process for blazing fast HMR.
- [Griddle](https://github.com/wearebraid/griddle/tree/vue3) grid system with "x-ray" functionality built in.
- Pre-baked `flexible-block-loop` tempalte include for getting started with ACF Flexible Content page builders.
- Built-in support for [Braid ACF Flexible Visual Menu](https://github.com/wearebraid/acf-flexible-visual-menu), just add it to your theme and activate.

# Setup for local and production

## Installation
clone the repo into you WordPress theme directory and rename the folder to the name of your choice and `cd` into it.

```bash
# remove the git tracking, this is a starter theme
# not something you'll want to maintain upstream tracking on
rm -rf .git/

# install dependencies
npm install
```

## Linting
The starter theme comes with configuration files that will tell your linters to use WordPress standards for `.php` files. Javascript files are excluded from the WordPress coding standards as most JavaScript for a project using this theme will be in the form of Vue components. You should have the following linters enabled in your editor:

- [ESLint](https://marketplace.visualstudio.com/items?itemName=dbaeumer.vscode-eslint)
- [PHPCS](https://marketplace.visualstudio.com/items?itemName=ikappas.phpcs)
- [EditorConfig](https://marketplace.visualstudio.com/items?itemName=EditorConfig.EditorConfig)
- [Vetur](https://marketplace.visualstudio.com/items?itemName=octref.vetur)

## Development

Add `define( 'BRAID_LOCAL_DEV', true );` to your wp-config.php

To begin Vite with hot module replacement for compiling JS and SCSS run: `npm run dev`

Requires dev assets to run at `http://localhost:3000`

## Production

To build minified assets ready for production run  `npm run build`

## Asset generation

Assets are generated in the `/dist` directory with is git ignored by default. Ideally, you'll have a deployment system that runs the npm `build` task on a deploy and moves the generated assets for you so that you do not need to track them in your git repo.

If you'd like to track the generated assets in your repo (note this will always result in merge conflicts) then you can remove the `dist/` line from the `.gitignore` file. _(NOT RECOMMENDED_)

# Theme Features

## Directory Structure

The starter theme comes with two important directories, `src` and `braid`. 

The `src` folder will contain all JavaScript, Sass, and theme image assets. The files are compiled together during `build` through the `app.js` and `app.scss` entry points. Scripts can also be referenced directly in the event you need to hook a script into the WP-Admin or some other similar task that's not part of the main theme bundle. The `src` directory will exist in production alongside the compiled `dist` directory.

The `braid` directory includes all of the Braid theme function files as well as all of the braid-authored template parts for a project. By default the `braid` directory includes `api`, `functions` and `template-parts` sub-directories.

## Adding a new Flexible Content Block

### Adding the ACF fields

To create a new Flexible Content Block you first need to create a "page builder" field group in ACF that contains a single [Flexbile Content Field](https://www.advancedcustomfields.com/resources/flexible-content/) named `content`. Attach this field to your desired Post Type(s). Then, create a seperate standalone field group to represent your desired content block. 

Once your new field group has all of the fields you need, set the `Active` option to off. Then, back in your `content` page buider, create a new layout and give it a name that matches the field group you just created (eg, `Hero`). The only content of the new Layout should be a single [Clone Field](https://www.advancedcustomfields.com/resources/clone/) that pulls in all the fields of the disabled field group you just created.

By using clones you'll be able to share the same page block accross multiple page builders. For example you could have `Page Builder: Main` and `Page Builder: Home` with some components shared between both via Clone Fields. Regardless of which page builder you're working on - on order to be compatible with the provided `flexible-block-loop.php` template part your Flexible content field should be named `content`.

### Creating the PHP template

Now that you have a page buider with a Layout that represents the content of your new block you need to create the PHP template. To do so create a `.php` file in `/braid/template-parts/flexible` that matches the name of your Layout - prefixed with `flexible-`. For example, if you just created a `hero` Layout then you would create the file `/braid/template-parts/flexible/flexible-hero.php`. The contents of that file will be included in `flexible-content-loop.php` automatically and all of your field data will be accessible with the `get_sub_field()` ACF function.

### Using Vue Components

In many cases it's useful to quickly get your data into a Vue component for front-end templating. First you'll want to create your component in `/src/js/components`. Then you'll need to register your component in the `/src/js/includes/components.js` file.

From your PHP template you'll need to fetch any required data and provide it as props or slot content to your new Vue component. If you're passing a string value then you can supply prop values with `<?php echo $my_value; ?>` in your template. If you need to pass in an `Array`, `Object`, or content that contains full HTML markup then use the provided `vue_prop()` function to prepare the data.

```php
<?php $my_php_object = get_sub_field( 'block_options' ); ?>

<my-component
	:object-prop="<?php vue_prop( $my_php_object ); ?>"
>
</my-component>
```

Note that inside of PHP files you will need to use kebab-case Vue component syntax. Inside of `.vue` files you can use camel-case component names.

## X-Ray

The Braid starter theme comes with an admin-bar toggle that enables a mode we call X-Ray. X-Ray, when enabled, turns on the visual overlay for Griddle and enables some aditinal functionality in the `flexible-content-stripe` component that is inclduded in the default `flexible-block-loop.php` file. To get the most out of X-Ray mode your page builder needs to follow a few rules.

- Your main Flexible Content block should be named `content`. If you change this you'll need to update or fork the `flexible-block-loop.php` to account for it.
- Your Flexble Content area should have layouts that consist of _only_ clone fields. The `flexible-block-loop.php` looks up the default parent clone and provideds a link for easy editing. If you don't use clone fields then these quick-links will not work. Quick links to edit ACF fields only appear for users who have a username prefixed with `Braid_`.
