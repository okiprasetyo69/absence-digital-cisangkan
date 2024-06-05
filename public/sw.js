var cacheName = 'Absence Digital';
var filesToCache = [
    '/',
    //'/index.html',
    //'/css/style.css',
    //'/js/main.js'
];

/* Start the service worker and cache all of the app's content */
self.addEventListener('install', function(e) {
    e.waitUntil(
        caches.open(cacheName).then(function(cache) {
        return cache.addAll(filesToCache);
        })
    );
});

self.addEventListener('activate', function(event) {
    event.waitUntil(
        caches.keys().then(function(cacheNames) {
            return Promise.all(
            cacheNames.map(function(cacheName) {
                if (cacheName.startsWith('pages-cache-') && staticCacheName !== cacheName) {
                return caches.delete(cacheName);
                }
            })
            );
        })
    );
});

/* Serve cached content when offline */
self.addEventListener('fetch', function(e) {
    //console.log('Fetch event for ', e.request.url);
    e.respondWith(
        caches.match(e.request).then(function(response) {
        return response || fetch(e.request);
        })
    );
});
