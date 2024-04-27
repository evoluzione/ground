import { defineConfig } from 'vite';

export default defineConfig({
	build: {
		sourcemap: true,
		rollupOptions: {
			input: ['assets/js/app.js'],
			output: {
				dir: 'dist/js',
				entryFileNames: 'ground-scripts.min.js',
				chunkFileNames: 'ground-[name].[hash].chunk.js',
				assetFileNames: '[name].min.[ext]'
			}
		}
	}
});
