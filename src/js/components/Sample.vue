<template>
  <h1>Vue {{ msg }}</h1>
  <button @click="count++">count is: {{ count }}</button>
  <p>
    Edit <code>components/HelloWorld.vue</code> to test hot module replacement.
  </p>
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