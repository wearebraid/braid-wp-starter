<template>
  <griddle
    v-if="griddleReady"
    :visible="gridVisible"
    @toggle="handleGriddleToggle"
  >
  </griddle>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  data () {
    return {
      griddleReady: false
    }
  },
  computed: {
    ...mapGetters({
      lockScroll: 'system/lockScroll',
      gridVisible: 'system/gridIsVisible'
    })
  },
  mounted () {
    const xrayToggle = document.querySelectorAll('#wp-admin-bar-xray_toggle')
    if (xrayToggle && xrayToggle[0]) {
      this.griddleReady = true
      const storedValue = window.getCookie('braid-xray') === 'true'
      this.handleGriddleToggle(storedValue)

      // set up event listener
      xrayToggle[0].addEventListener("click", () => {
        this.handleGriddleToggle(!this.gridVisible)
      });
    }
    this.griddleReady = true
  },
  watch: {
    lockScroll () {
      document.documentElement.setAttribute('data-scroll-lock', this.lockScroll)
    }
  },
  methods: {
    handleGriddleToggle (e) {
      const xrayToggle = document.querySelectorAll('#wp-admin-bar-xray_toggle .xray-toggle')
      if (xrayToggle && xrayToggle[0]) {
         xrayToggle[0].setAttribute('data-active', e)
         window.setCookie('braid-xray', e)
      }
      document.documentElement.setAttribute('data-grid-visible', e)
      this.$store.commit('system/setGridIsVisible', e)
    }
  }
}
</script>

<style lang="scss" scoped>
.griddle-container {
  @include deep() {
    .griddle-column {
      background: rgba($g-column-color, 0.075);

      &::before {
        .admin-bar & {
          top: 3em;
        }
      }
    }
  }
}
</style>
