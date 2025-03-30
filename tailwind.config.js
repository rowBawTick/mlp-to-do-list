/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './vendor/usernotnull/tall-toasts/config/**/*.php',
    './vendor/usernotnull/tall-toasts/resources/views/**/*.blade.php',
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
