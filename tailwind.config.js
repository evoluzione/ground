/** @type {import('tailwindcss').Config} */

// Default configuration: https://github.com/tailwindlabs/tailwindcss/blob/master/stubs/config.full.js
export default {
	presets: [
		require('@evoluzione/tailwind-config'),
	],
	theme: {
    extend: {
      typography: {
        DEFAULT: {
          css: {
            'ul li': {
              margin: '0',
            },
            'ol li': {
              margin: '0',
            },
          },
        },
      },
    },
  },
};