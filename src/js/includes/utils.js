export function upperFirst (string) {
  return string ? string.charAt(0).toUpperCase() + string.slice(1) : ''
}

export function camelCase (str) {
  return str.replace(/(?:^\w|[A-Z]|\b\w)/g, function(word, index) {
    return index === 0 ? word.toLowerCase() : word.toUpperCase();
  }).replace(/\s+/g, '');
}
