const CACHE_NAME = 'bsc-v3';
const urlsToCache = [
  '/mobile/',
  '/mobile/dashboard',
  '/offline' // Buat route fallback
];

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => response || fetch(event.request)
      .catch(() => caches.match('/mobile/'))
  ));
});
