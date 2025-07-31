// const CACHE_NAME = 'bsc-v3';
// const urlsToCache = [
//   'https://brightchild.id/mobile/',
//   'https://brightchild.id/mobile/dashboard',
//   'https://brightchild.id/mobile/offline' // Buat route fallback
// ];

// self.addEventListener('fetch', event => {
//   event.respondWith(
//     caches.match(event.request)
//       .then(response => response || fetch(event.request)
//       .catch(() => caches.match('https://brightchild.id/mobile/'))
//   ));
// });
