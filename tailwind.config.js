module.exports = {
    important: true,
    theme: {
        pagination: theme => ({
            color: theme('colors.purple.600'),
            link: 'bg-indigo-800 py-3 px-3 border-r border-gray-300 text-white no-underline rounded',
            linkHover: 'bg-indigo-500',
            linkDisabled: 'bg-indigo-900',
            linkFirst: null,
            linkLast: 'border-0',
        }),

        maxHeight: {
            '0': '0',
            '1/4': '20rem',
            '2/4': '35rem',
            '1/2': '50%',
            '3/4': '75%',
            'full': '100%',
        },

        extend: {
            margin: {
                '96': '20rem',
            },
            colors: {
                sidebar: '#22273F',
                content: '#32363D',
                dark: {
                    100: '#343A48',
                }
            },

        },
    },
    variants: {},
    plugins: [
        require('tailwindcss-plugins/pagination'),
        require('@tailwindcss/custom-forms'),
        require('tailwindcss-debug-screens'),
    ],
}
