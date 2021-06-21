<template>
  <div class="welcome-component">
    <div class="container">
      <h1>{{ msg }}</h1>
      <slot />

      <div class="help-buttons">
        <a
          class="button"
          href="https://github.com/wearebraid/braid-wp-starter#readme"
          target="_blank"
        >
          Braid Starter Readme
        </a>
        <a
          class="button"
          href="https://github.com/wearebraid/griddle/tree/vue3#readme"
          target="_blank"
        >
          Griddle Documentation
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    msg: String,
    default: ''
  }
}
</script>

<style lang="scss" scoped>
.welcome-component {
  background-image: linear-gradient(to bottom right, #0c090c, #3f263f);
  color: $light;
  min-height: 100vh;
  display: flex;
  position: relative;

  &::before {
    position: absolute;
    content: '';
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 50%;
    height: 50%;
    min-width: 18.75em;
    min-height: 18.75em;
    background: url('../../img/logo-trans.svg') center center no-repeat;
    opacity: 0.05;
  }

  .container {
    position: relative;
    z-index: 2;
    padding-top: 4em;
    padding-bottom: 4em;
    margin-top: auto;
    margin-bottom: auto;
    text-align: center;
  }

  h1 {
    color: #d48fda;
    margin-bottom: 0.1em;

    @include deep() {
      & + p {
        opacity: 0.8;
        margin-top: 0;
      }
    }
  }

  .help-buttons {
    display: flex;
    width: 100%;
    align-items: center;
    justify-content: center;

    .button {
      display: inline-block;
      border: 1px solid #fff;
      color: #fff;
      padding: 0.5em 1em;
      border-radius: 999em;
      text-decoration: none;
      margin: 1em 0.5em;

      &:hover {
        background: #fff;
        color: #000;
      }
    }
  }
}
</style>
