// System
import { VueGriddle } from '@braid/griddle'

// Dev
import GlobalEvents from '../components/dev/GlobalEvents.vue'
import FlexibleContentStripe from '../components/dev/FlexibleContentStripe.vue'

// Elements
import Sample from '../components/Sample.vue'

// Register Components
export default (app) => {
  // System
  app.component('Griddle', VueGriddle)

  // Dev
  app.component('GlobalEvents', GlobalEvents)
  app.component('FlexibleContentStripe', FlexibleContentStripe)

  // Elements
  app.component('Sample', Sample)
}
