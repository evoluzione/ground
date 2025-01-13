import { defineConfig } from 'vite';

export default defineConfig({
	build: {
		sourcemap: true,
		rollupOptions: {
			input: ['src/js/app.js'],
			output: {
				dir: 'assets/js',
				entryFileNames: 'ground-scripts.min.js',
				chunkFileNames: 'ground-[name].[hash].chunk.js',
				assetFileNames: '[name].min.[ext]'
			}
		}
	}
});
