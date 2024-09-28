import { defineConfig } from 'vite'
import { svelte } from '@sveltejs/vite-plugin-svelte'
import path from 'path'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [svelte()],
  build: {
    outDir: '../hotswapjs/public/svelte', // Output to Laravel's public folder
    emptyOutDir: true, // Clear the folder before each build
    rollupOptions: {
      input: path.resolve(__dirname, 'index.html') // Ensure it uses your main entry point
    }
  },
  base: '/svelte/' // Set the base URL for the Svelte assets
})
