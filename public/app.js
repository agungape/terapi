// Versi cache (ubah ini untuk memperbarui cache)
const CACHE_NAME = 'pixio-pwa-v1';

// Daftar resource yang akan di-cache (sesuaikan dengan kebutuhan Anda)
const urlsToCache = [
  '/',
  '/mobile',
  '/assets/mobile/pixio/css/styles.css',
  '/assets/mobile/pixio/js/custom.js',
  '/assets/mobile/pixio/images/app-logo/bsc.png',
  // Tambahkan file lainnya yang diperlukan
];

// Event: Install Service Worker
self.addEventListener('install', (event) => {
  console.log('Service Worker: Installed');
  // Pre-cache resources
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then((cache) => {
        console.log('Service Worker: Caching files');
        return cache.addAll(urlsToCache);
      })
      .catch((err) => {
        console.log('Service Worker: Cache error', err);
      })
  );
});

// Event: Fetch resources
self.addEventListener('fetch', (event) => {
  console.log('Service Worker: Fetching', event.request.url);
  // Strategi Cache-First
  event.respondWith(
    caches.match(event.request)
      .then((response) => {
        // Jika ada di cache, kembalikan dari cache
        if (response) {
          return response;
        }
        // Jika tidak ada, fetch dari jaringan
        return fetch(event.request)
          .then((response) => {
            // Jika fetch gagal (misalnya offline), tampilkan fallback
            if (!response || response.status !== 200) {
              return caches.match('/offline.html'); // Ganti dengan halaman offline jika ada
            }
            return response;
          });
      })
  );
});

// Event: Aktifasi Service Worker
self.addEventListener('activate', (event) => {
  console.log('Service Worker: Activated');
  // Hapus cache lama
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cache) => {
          if (cache !== CACHE_NAME) {
            console.log('Service Worker: Clearing old cache');
            return caches.delete(cache);
          }
        })
      );
    })
  );
});
