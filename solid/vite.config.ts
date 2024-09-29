import { defineConfig } from 'vite'
import solid from 'vite-plugin-solid'

export default defineConfig({
  plugins: [solid()],
  build: {
    outDir: '../hotswapjs/public/solid', // Output to Laravel's public folder
    emptyOutDir: true, // Clear the folder before each build
  },
  base: '/solid/' // Set the base URL
})
