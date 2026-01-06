/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/hasinhayder/tyro-login/resources/views/**/*.blade.php",
    ],
    darkMode: 'class', // Enable class-based dark mode
    theme: {
        extend: {
            fontFamily: {
                sans: ['"Noto Serif Bengali"', 'system-ui', 'sans-serif'],
            },
        },
    },
    plugins: [],
};
