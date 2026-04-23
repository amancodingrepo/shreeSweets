import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
  build: {
    outDir: 'assets/dist',
    emptyOutDir: false,
    rollupOptions: {
      input: resolve(__dirname, 'assets/src/input.css'),
      output: {
        assetFileNames: 'app.css',
      },
    },
  },
});
