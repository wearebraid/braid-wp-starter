// System
import { VueGriddle } from '@braid/griddle'

// Elements
import Sample from '../components/Sample.vue'

// Register Components
export default (app) => {
    app.component('Sample', Sample)
    app.component('Griddle', VueGriddle)
}