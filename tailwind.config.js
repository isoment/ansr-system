module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {},
    fontFamily: {
      'nunito': ['Nunito'],
      'prompt': ['Prompt'],
    },
  },
  variants: {},
  plugins: [
    require('@tailwindcss/ui'),
  ]
}
