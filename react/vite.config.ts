import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
// https://vitejs.dev/config/
export default defineConfig({
  plugins: [react()],
  build: {
    outDir: '../hotswapjs/public/react', // Output to Laravel's public folder
    emptyOutDir: true, // Clear the folder before each build
  },
  base: '/react/' // Set the base URL
})
