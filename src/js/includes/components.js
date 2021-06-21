// System
import { VueGriddle } from '@braid/griddle'

// Dev
import GlobalEvents from '../components/dev/GlobalEvents.vue'
import FlexibleContentStripe from '../components/dev/FlexibleContentStripe.vue'

// Elements
import Welcome from '../components/Welcome.vue'

// Register Components
export default (app) => {
  // System
  app.component('Griddle', VueGriddle)

  // Dev
  app.component('GlobalEvents', GlobalEvents)
  app.component('FlexibleContentStripe', FlexibleContentStripe)

  // Elements
  app.component('Welcome', Welcome)
}
