/*
* This file is for External component imports.
* All .vue components in the `./src/js/components/**` directory are
* AUTOMATICALLY imported and do not need to be defined in this file.
* Only use this file to import NPM dependencies that need global registration.
*/

// System
import { VueGriddle } from '@braid/griddle'


// Register Components
export default (app) => {
  // System
  app.component('Griddle', VueGriddle)
}
