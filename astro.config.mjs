// @ts-check
import { defineConfig } from 'astro/config';
import tailwindcss from '@tailwindcss/vite';
import sitemap from '@astrojs/sitemap';

// https://astro.build/config
export default defineConfig({
  site: 'https://alejandrocabeza.dev',
  integrations: [
    sitemap({
      changefreq: 'monthly',
      priority: 1.0,
    }),
  ],
  vite: {
    plugins: [tailwindcss()],
  },
});
