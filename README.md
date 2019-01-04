# Braid WP Starter

Originally based off [Underscores](https://underscores.me/), and added to as we learn new things.

## Installation
clone the repo into you WordPress theme directory and rename the folder to the name of your choice and `cd` into it.

```bash
# remove the git tracking, this is a starter theme
# not something you'll want to maintain upstream tracking on
rm -rf .git/

# Create a .env file and change the `LOCAL_DOMAIN` to your local working domain
# This file can also be customized for additional webpack entry points
cp .env.example .env

# install dependencies
npm install
```

## Development
To begin webpack with hot module replacement for compiling JS and SCSS run: `npm start`

## Production
To build minified assets ready for production run  `npm run build`

---

## .env defaults
```
## YOUR LOCAL DOMAIN HERE
LOCAL_DOMAIN=localhost

## ENTRY POINTS FOR WHAT YOU WANT WEBPACK TO COMPILE
ENTRY_POINTS={ "app": "./lib/js/app.js" }

## BUILD DESTINATION FOR FILES
BUILD_PATH=dist

## SECURE FOR HTTPS OR HTTP
SECURE=false

## PORT FOR NPM SERVER / HMR
PORT=5000
```

---

## Asset generation

Assets are generated in the `/dist` directory with is git ignored by default. Ideally, you'll have a deployment system that runs the gulp task on a deploy and moves the generated assets for you so that you do not need to track them in your git repo.

If you'd like to track the generated assets in your repo (note this will always result in merge conflicts) then you can remove the `dist/` line from the `.gitignore` file. _(NOT RECOMMENDED_)
