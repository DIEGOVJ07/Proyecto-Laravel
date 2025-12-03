import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class', 

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                'cb-dark': '#0D1421',    // ← CAMBIADO para coincidir con la landing
                'cb-card': '#141D2D',    // ← CAMBIADO
                'cb-green': '#10B981',   // ← Mantiene el mismo verde
                'cb-border': '#29374D',  // ← CAMBIADO
            },
            
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};