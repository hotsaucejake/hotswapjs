import { defineConfig } from 'vite'

// https://vitejs.dev/config/
export default defineConfig({
    build: {
        outDir: '../hotswapjs/public/lit', // Output to Laravel's public folder
        emptyOutDir: true, // Clear the folder before each build
    },
    base: '/lit/' // Set the base URL
})