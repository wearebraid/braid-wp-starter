import Vue from 'vue'
import moment from 'moment'

Vue.filter('date', function (value) {
  if (!value) return ''
  return moment(value).format('MM/DD/YYYY')
})

Vue.filter('capitalize', function (value) {
  return _.capitalize(value)
})

Vue.filter('widowless', function (text) {
  text = text.trim().split(' ')
  if (text.length > 3) {
    let lastWords = `${text[text.length - 2]}&nbsp;${text[text.length - 1]}`
    text.pop()
    text.pop()
    text.push(lastWords)
  }
  return text.join(' ')
})
