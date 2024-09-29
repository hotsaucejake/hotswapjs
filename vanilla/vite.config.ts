import { defineConfig } from 'vite'

// https://vitejs.dev/config/
export default defineConfig({
    build: {
        outDir: '../hotswapjs/public/vanilla', // Output to Laravel's public folder
        emptyOutDir: true, // Clear the folder before each build
    },
    base: '/vanilla/' // Set the base URL
})