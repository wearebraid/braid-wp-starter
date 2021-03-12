# Braid WP Starter

Originally based off [Underscores](https://underscores.me/), and added to as we learn new things.

## Installation
clone the repo into you WordPress theme directory and rename the folder to the name of your choice and `cd` into it.

```bash
# remove the git tracking, this is a starter theme
# not something you'll want to maintain upstream tracking on
rm -rf .git/

# install dependencies
npm install
```

## Development

Add `define( 'BRAID_LOCAL_DEV', true );` to your wp-config.php

To begin webpack with hot module replacement for compiling JS and SCSS run: `npm run dev`

Requires dev assets to run at `http://localhost:3000`

## Production

To build minified assets ready for production run  `npm run build`

## Asset generation

Assets are generated in the `/dist` directory with is git ignored by default. Ideally, you'll have a deployment system that runs the gulp task on a deploy and moves the generated assets for you so that you do not need to track them in your git repo.

If you'd like to track the generated assets in your repo (note this will always result in merge conflicts) then you can remove the `dist/` line from the `.gitignore` file. _(NOT RECOMMENDED_)
