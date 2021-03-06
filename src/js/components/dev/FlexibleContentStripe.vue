<template>
  <div
    class="flexi-content-stripe"
    :data-grid-visible="grid"
    :data-is-visible="visible"
    v-observe.once.-200px="setVisible"
  >
    <slot />

    <div
      v-if="grid"
      class="stripe-overlay"
    >
      <div
        v-if="label"
        class="stripe-label"
      >
        {{ displayIndex }}) {{ displayLabel }}
        <div class="controls">
          <a
            v-if="postEditLink"
            :href="postEditLink"
            target="_blank"
            title="Edit content in post"
          >
            <svg
              aria-hidden="true"
              focusable="false"
              role="img"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 512 512"
            >
              <path
                fill="currentColor"
                d="M497.9 142.1l-46.1 46.1c-4.7 4.7-12.3 4.7-17 0l-111-111c-4.7-4.7-4.7-12.3 0-17l46.1-46.1c18.7-18.7 49.1-18.7 67.9 0l60.1 60.1c18.8 18.7 18.8 49.1 0 67.9zM284.2 99.8L21.6 362.4.4 483.9c-2.9 16.4 11.4 30.6 27.8 27.8l121.5-21.3 262.6-262.6c4.7-4.7 4.7-12.3 0-17l-111-111c-4.8-4.7-12.4-4.7-17.1 0zM124.1 339.9c-5.5-5.5-5.5-14.3 0-19.8l154-154c5.5-5.5 14.3-5.5 19.8 0s5.5 14.3 0 19.8l-154 154c-5.5 5.5-14.3 5.5-19.8 0zM88 424h48v36.3l-64.5 11.3-31.1-31.1L51.7 376H88v48z"
              />
            </svg>
          </a>
          <a
            v-if="showFieldsLink && fieldEditLink"
            :href="fieldEditLink"
            target="_blank"
            title="Edit field group"
          >
            <svg
              aria-hidden="true"
              focusable="false"
              role="img"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 512 512"
            >
              <path
                fill="currentColor"
                d="M487.4 315.7l-42.6-24.6c4.3-23.2 4.3-47 0-70.2l42.6-24.6c4.9-2.8 7.1-8.6 5.5-14-11.1-35.6-30-67.8-54.7-94.6-3.8-4.1-10-5.1-14.8-2.3L380.8 110c-17.9-15.4-38.5-27.3-60.8-35.1V25.8c0-5.6-3.9-10.5-9.4-11.7-36.7-8.2-74.3-7.8-109.2 0-5.5 1.2-9.4 6.1-9.4 11.7V75c-22.2 7.9-42.8 19.8-60.8 35.1L88.7 85.5c-4.9-2.8-11-1.9-14.8 2.3-24.7 26.7-43.6 58.9-54.7 94.6-1.7 5.4.6 11.2 5.5 14L67.3 221c-4.3 23.2-4.3 47 0 70.2l-42.6 24.6c-4.9 2.8-7.1 8.6-5.5 14 11.1 35.6 30 67.8 54.7 94.6 3.8 4.1 10 5.1 14.8 2.3l42.6-24.6c17.9 15.4 38.5 27.3 60.8 35.1v49.2c0 5.6 3.9 10.5 9.4 11.7 36.7 8.2 74.3 7.8 109.2 0 5.5-1.2 9.4-6.1 9.4-11.7v-49.2c22.2-7.9 42.8-19.8 60.8-35.1l42.6 24.6c4.9 2.8 11 1.9 14.8-2.3 24.7-26.7 43.6-58.9 54.7-94.6 1.5-5.5-.7-11.3-5.6-14.1zM256 336c-44.1 0-80-35.9-80-80s35.9-80 80-80 80 35.9 80 80-35.9 80-80 80z"
              />
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  props: {
    label: {
      type: String,
      default: ''
    },
    index: {
      type: String,
      default: '0'
    },
    postId: {
      type: String,
      default: '0'
    },
    groupId: {
      type: String,
      default: '0'
    },
    currentUser: {
      type: String,
      default: ''
    }
  },
  data () {
    return {
      visible: false
    }
  },
  computed: {
    ...mapGetters({
      grid: 'system/gridIsVisible'
    }),
    displayIndex () {
      return parseInt(this.index) + 1
    },
    displayLabel () {
      return this.label.split('_').map((word) => word.charAt(0).toUpperCase() + word.slice(1)).join(' ')
    },
    fieldEditLink () {
      if (this.groupId) {
        return `/wp-admin/post.php?post=${this.groupId}&action=edit`
      }
      return false
    },
    postEditLink () {
      if (this.postId) {
        return `/wp-admin/post.php?post=${this.postId}&action=edit&target=${this.index}:${this.label}`
      }
      return false
    },
    showFieldsLink () {
      return this.currentUser.toLowerCase().startsWith('braid_')
    }
  },
  methods: {
    setVisible () {
      this.visible = true
    }
  }
}
</script>

<style lang="scss" scoped>
.flexi-content-stripe {
  &[data-grid-visible="true"] {
    position: relative;
  }

  &:last-child {
    .stripe-overlay {
      border-bottom: 4px solid crimson;
    }
  }
}

.stripe-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  border: 4px solid crimson;
  border-bottom: none;
  z-index: 999;

  .stripe-label {
    position: absolute;
    top: 0;
    left: 0;
    padding: 0.5em 1em;
    background: crimson;
    color: #fff;
    font-family: monospace;
    font-size: 0.75em;
    pointer-events: all;
    display: flex;
    color: #fff;
  }

  .controls {
    display: flex;
    margin-left: 1em;

    svg {
      width: 1.25em;
      margin-right: 0.75em;
    }

    a {
      color: #fff;
      opacity: 0.75;
      cursor: pointer;

      &:hover {
        opacity: 1;
      }

      &:last-child {
        svg {
          margin-right: 0;
        }
      }
    }
  }
}
</style>
