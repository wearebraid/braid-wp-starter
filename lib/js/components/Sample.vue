<template>
<div class="container">
  <h1 v-text="message" />
  <h2>{{test}} from vuex store!</h2>
  <slot />
</div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  data() {
    return {
      message: 'VueJs is working!'
    }
  },
  computed: {
    ...mapGetters({
      test: state => store.system.test 
    })
  }
}
</script>

<style lang="scss" scoped>
h1 {
  color: $primary;
}
</style>
