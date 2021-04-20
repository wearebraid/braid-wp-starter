<template>
  <div class="container">
    <h1>Vue {{ msg }}</h1>
    <button @click="count++">count is: {{ count }}</button>
    <slot />
  </div>
</template>

<script>
export default {
  props: {
    msg: String,
    default: ''
  },
  data() {
    return {
      count: 0
    }
  }
}
</script>

<style lang="scss" scoped>
h1 {
  color: $error;
}
</style>