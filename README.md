# Braid WP Starter

Originally based off [Underscores](https://underscores.me/), and added to as we learn new things.

## Configuration

Most of the configuration you'll want to do will be in the `gulpfile.js` and the `braid/braid-default-users.php` files for your build.

## installation
clone the repo into you WordPress theme directory and rename the folder to the name of your choice and `cd` into it.

```bash
# remove the git tracking, this is a starter theme
# not something you'll want to maintain upstream tracking on
rm -rf .git/

# install dependencies
npm install

# generate assets and watch for changes
gulp

```

## Asset generation

Assets are generated in the `/dist` directory with is git ignored by default. Ideally, you'll have a deployment system that runs the gulp task on a deploy and moves the generated assets for you so that you do not need to track them in your git repo.

If you'd like to track the generated assets in your repo (note this will always result in merge conflicts) then you can remove the `dist/` line from the `.gitignore` file.