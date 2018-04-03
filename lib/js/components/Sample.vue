<template>
<div class="container">
  <h1 v-text="message" />
  <slot />
</div>
</template>

<script>
export default {
  data() {
    return {
      message: 'VueJs is working!'
    }
  }
}
</script>

<style lang="scss" scoped>
</style>
