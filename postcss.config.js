export default {
	map: { inline: false },
	plugins: {
		'postcss-import': {},
		'tailwindcss/nesting': {},
		tailwindcss: {},
		'postcss-for': {},
		'postcss-simple-vars': {},
		'postcss-100vh-fix': true,
		autoprefixer: process.env.NODE_ENV === 'production' ? {} : false,
		cssnano: process.env.NODE_ENV === 'production' ? {} : false
	}
};
