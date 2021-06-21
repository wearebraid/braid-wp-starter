import { upperFirst, camelCase } from './utils'

const modules = import.meta.globEager('../components/**/*.vue')

export const registerComponents = app => Object.keys(modules).forEach((fileName) => {
  const componentConfig = modules[fileName]

  // Get PascalCase name of component
  const componentName = upperFirst(
    camelCase(
      // Gets the file name regardless of folder depth
      fileName
        .split('/')
        .pop()
        .replace(/\.\w+$/, '')
    )
  )

  // Register component globally
  app.component(
    componentName,
    componentConfig.default
  )
})
