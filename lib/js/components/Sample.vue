<template>
  <div class="container">
    <h1 v-text="message" />
    <h2>{{test}} from vuex store!</h2>
    <div class="slot-data">
      <slot />
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  data() {
    return {
      message: 'VueJs is working!'
    }
  },
  computed: {
    ...mapState('system', {
      test: 'test',
    })
  },
}
</script>

<style lang="scss" scoped>
h1 {
  color: $primary;
}
.slot-data {
  background: #ccc;
  padding: 15px;
  border: 1px solid #999;
}
.container {
  background: url('../../img/logo-trans.svg') no-repeat center center;
}
</style>
