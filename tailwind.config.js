/** @type {import('tailwindcss').Config} */

module.exports = {
    prefix: 'sentry-',
    darkMode: false, // or 'media' or 'class',
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
}
