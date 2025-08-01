self.addEventListener('install', (e) => {
	e.waitUntil(
		caches.open('app-bright').then((cache) => cache.addAll([
			'/app'
		])),
	);
});

self.addEventListener('fetch', (e) => {
	e.respondWith(
		caches.match(e.request).then(function (response) {
			return response || fetch(e.request);
		})
	);
});
