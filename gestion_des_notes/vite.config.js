import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';  // Si vous utilisez Vue.js
import react from '@vitejs/plugin-react';  // Si vous utilisez React
import path from 'path';

export default defineConfig({
  plugins: [
    vue(),  // active le plugin Vue si vous utilisez Vue.js
    react(),  // active le plugin React si vous utilisez React
  ],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources/js'),  // alias pour raccourcir les chemins
    },
  },
  build: {
    outDir: 'public/build',  // Répertoire de sortie pour les fichiers compilés
    assetsDir: 'assets',  // Répertoire pour les fichiers statiques (images, CSS, etc.)
    manifest: true,  // Génère un fichier manifest.json pour lier les assets
    rollupOptions: {
      input: {
        main: path.resolve(__dirname, 'resources/js/app.tsx'),  // Point d'entrée principal pour JavaScript
      },
    },
  },
  server: {
    proxy: {
      '/app': 'http://127.0.0.1',  // Proxy pour les requêtes API (si nécessaire)
    },
  },
});
