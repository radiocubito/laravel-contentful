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
                primary: colors.cyan,
            },
            typography: {
                DEFAULT: {
                    css: {
                        'figure > a > img': {
                            marginTop: '0',
                            marginBottom: '0',
                        }
                    },
                },
            }
        },
    },

    variants: {},

    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp')
    ],
};
