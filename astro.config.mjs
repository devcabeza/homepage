// @ts-check
import { defineConfig } from 'astro/config';
import tailwindcss from '@tailwindcss/vite';
import sitemap from '@astrojs/sitemap';
import node from '@astrojs/node';

// https://astro.build/config
export default defineConfig({
  site: 'https://alejandrocabeza.dev',
  output: 'server',
  adapter: node({
    mode: 'standalone',
  }),
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
