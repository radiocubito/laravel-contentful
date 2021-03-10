const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    purge: [
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                gray: colors.warmGray,
            }
        },
    },

    variants: {},

    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms')
    ],
};
