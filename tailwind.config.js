import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            colors: {
                'csj-blue': {
                    50: '#F0FAF9',
                    100: '#8FD4D2',
                    200: '#8FD4D2',
                    300: '#8FD4D2',
                    400: '#2DB9B5',
                    500: '#2DB9B5',
                    600: '#2DB9B5',
                    700: '#239E9B',
                    800: '#1A7F7C',
                    900: '#1F2937',
                    950: '#1F2937',
                },
                'csj-gray': {
                    50: '#F3F4F6',
                    100: '#F3F4F6',
                    200: '#D1D5DB',
                    300: '#D1D5DB',
                    400: '#4B5563',
                    500: '#4B5563',
                    600: '#4B5563',
                    700: '#1F2937',
                    800: '#1F2937',
                    900: '#1F2937',
                },
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                heading: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                'csj': '0 4px 24px 0 rgba(12, 142, 231, 0.10)',
                'csj-lg': '0 8px 40px 0 rgba(12, 142, 231, 0.15)',
            },
        },
    },

    plugins: [forms, typography],
};