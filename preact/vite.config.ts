import { defineConfig } from 'vite'
import preact from '@preact/preset-vite'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [preact()],
  build: {
    outDir: '../hotswapjs/public/preact', // Output to Laravel's public folder
    emptyOutDir: true, // Clear the folder before each build
  },
  base: '/preact/' // Set the base URL
})
