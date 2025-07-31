const CACHE_NAME = 'bsc-v3';
const urlsToCache = [
  'brightchild.id/mobile/',
  'brightchild.id/mobile/dashboard',
  'brightchild.id/offline' // Buat route fallback
];

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => response || fetch(event.request)
      .catch(() => caches.match('brightchild.id/mobile/'))
  ));
});
