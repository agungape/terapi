// Nama cache untuk aplikasi
const CACHE_NAME = 'brightchild-cache-v1';

// Daftar aset yang akan di-cache (sesuaikan dengan kebutuhan Anda)
const urlsToCache = [
  '/mobile/',
  '/mobile/app/'

];

 self.addEventListener('install', event => {
    event.waitUntil(
      caches.open(CACHE_NAME)
        .then(cache => {
          console.log('Cache opened');
          return cache.addAll(urlsToCache).catch(error => {
            console.error('Failed to cache:', error);
          });
        })
    );
  });

  self.addEventListener('fetch', event => {
    event.respondWith(
      caches.match(event.request)
        .then(response => response || fetch(event.request))
        .catch(() => {
          // Fallback response jika fetch gagal
          return caches.match('/offline.html'); // Siapkan fallback page
        })
    );
  });

  self.addEventListener('activate', event => {
    event.waitUntil(
      caches.keys().then(cacheNames => {
        return Promise.all(
          cacheNames.map(cacheName => {
            if (cacheName !== CACHE_NAME) {
              return caches.delete(cacheName);
            }
          })
        );
      })
    );
  });
