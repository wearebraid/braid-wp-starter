import Vue from 'vue'

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
