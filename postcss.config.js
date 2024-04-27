const isProduction = process.env.NODE_ENV === 'production';

export default {
  map: { inline: false },
  plugins: {
    'postcss-import': {},
    'tailwindcss/nesting': {},
    tailwindcss: {},
    'postcss-for': {},
    autoprefixer: isProduction ? {} : false,
    cssnano: isProduction ? {} : false
  }
};
