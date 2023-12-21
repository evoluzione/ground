import { defineConfig } from 'vite';

export default defineConfig({
	build: {
		emptyOutDir: false,
		sourcemap: true,
		rollupOptions: {
			input: ['src/js/app.js'],
			output: {
				dir: 'dist/js',
				entryFileNames: 'ground-scripts.min.js',
				chunkFileNames: 'ground-[name].[hash].chunk.js',
				assetFileNames: '[name].min.[ext]'
			}
		}
	}
});
