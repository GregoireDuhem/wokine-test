import { defineConfig } from "vite";
import path from "path";

export default defineConfig(({ command }) => ({
  root: "src",
  base: command === "serve" ? "/" : "/wp-content/themes/wokine-test/frontend/dist/",
  build: {
    outDir: path.resolve(__dirname, "dist"),
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input: {
        main: path.resolve(__dirname, "src/main.js"),
      },
    },
  },
  server: {
    port: 5173,
    strictPort: true,
    origin: "http://localhost:5173",
    cors: {
      origin: "http://wokine-test.local",
    },
    hmr: {
      host: "localhost",
    },
  },
}));
