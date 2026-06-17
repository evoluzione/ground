import { defineConfig } from "vite";

export default defineConfig({
	build: {
		outDir: "assets/js",
		emptyOutDir: true,
		sourcemap: true,
		rolldownOptions: {
			input: ["src/js/app.js"],
			output: {
				entryFileNames: "ground-scripts.min.js",
				chunkFileNames: "ground-[name].[hash].chunk.js",
				assetFileNames: "[name].min.[ext]",
			},
		},
	},
});
