import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
            colors: {
                blue1: "#283F50",
                blue2: "#567E93",
                blue3: "#688D9E",
                blue4: "#CFDDE4",
                red: "#BB1D01",
                grey: "#D5D5D5",
                grey2: "#F2F7FD",
                black: "#404040",
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
};
