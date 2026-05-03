import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                outfit: ['Outfit', 'sans-serif'],
            },
            colors: {
                primary: '#E67E22',
                secondary: '#5D4037',
                accent: '#FFB347',
                'iaspig-orange': '#E67E22',
                'iaspig-brown': '#5D4037',
                'iaspig-cream': '#F9F5F2',
            },
        },
    },

    plugins: [forms],
    safelist: [
        'bg-iaspig-orange/10', 'text-iaspig-orange',
        'bg-iaspig-brown/10', 'text-iaspig-brown',
    ],
};
