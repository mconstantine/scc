const babel = require('rollup-plugin-babel')
const { uglify } = require('rollup-plugin-uglify')

module.exports = {
  output: {
    format: 'iife'
  },
  plugins: [
    babel({
      babelrc: false,
      presets: [['@babel/preset-env', { modules: false }]],
      exclude: 'node_modules/**'
    }),
    uglify()
  ]
}
