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
                    50:  '#E8F9FD',
                    100: '#A8ECFA',
                    200: '#A8ECFA',
                    300: '#6CDDEE',
                    400: '#0DCAF0',
                    500: '#0DCAF0',
                    600: '#0DCAF0',
                    700: '#0AABE0',
                    800: '#0888B3',
                    900: '#212529',
                    950: '#212529',
                },
                'csj-gray': {
                    50:  '#F8F9FA',
                    100: '#F8F9FA',
                    200: '#DEE2E6',
                    300: '#DEE2E6',
                    400: '#6C757D',
                    500: '#6C757D',
                    600: '#6C757D',
                    700: '#495057',
                    800: '#343A40',
                    900: '#212529',
                },
            },
            fontFamily: {
                sans:    ['Inter', ...defaultTheme.fontFamily.sans],
                heading: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                'csj':    '0 4px 24px 0 rgba(13, 202, 240, 0.10)',
                'csj-lg': '0 8px 40px 0 rgba(13, 202, 240, 0.15)',
            },
        },
    },

    plugins: [forms, typography],
};