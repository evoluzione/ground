import js from '@eslint/js';
import globals from 'globals';
import prettier from 'eslint-config-prettier/flat';
import { defineConfig } from 'eslint/config';

export default defineConfig([
	{
		files: ['src/js/**/*.js'],
		plugins: { js },
		extends: ['js/recommended'],
		languageOptions: {
			ecmaVersion: 'latest',
			sourceType: 'module',
			globals: globals.browser,
		},
		rules: {
			'no-console': 'warn',
		},
	},

	// Keep last: turns off any stylistic rules so Prettier owns formatting.
	prettier,
]);
