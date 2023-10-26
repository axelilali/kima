import { defineConfig } from 'vite'

export default defineConfig({
	server: {
		host: 'localhost',
	},
	publicDir: '',
	build: {
		assetsDir: '.',
		emptyOutDir: true,
		outDir: `public/dist`,
		manifest: true,
		rollupOptions: {
			input: ['assets/js/main.js', 'assets/sass/styles.scss'],
		},
	},
	plugins: [
		{
			name: 'twig-reload',
			handleHotUpdate({ file, server }) {
				if (file.endsWith('.twig')) {
					server.ws.send({ type: 'full-reload', path: '*' })
				}
			},
		},
	],
})
