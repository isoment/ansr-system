module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {},
    fontFamily: {
      'nunito': ['Nunito'],
    },
  },
  variants: {},
  plugins: [
    require('@tailwindcss/ui'),
  ]
}
