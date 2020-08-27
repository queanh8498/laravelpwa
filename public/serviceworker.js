var staticCacheName = "pwa-v" + new Date().getTime();
var filesToCache = [
   '/offline',
	'/dangnhap',
    '/css/app.css',
    '/js/app.js',
	'/backend/images/admin.png',
	'/backend/css/bootstrap.min.css',
	'/backend/bootstrap/css/bootstrap.min.css',
	'/backend/css/style.css',
	'/backend/css/style-responsive.css',
	'/backend/css/font.css',
	'/backend/css/font-awesome.css',
	'/backend/css/monthly.css',
	'/backend/DataTables/datatables.min.css',
	'/backend/css/datatables.min.css',
	'/backend/js/jquery2.0.3.min.js',
	'/backend/js/raphael-min.js',
	'/backend/js/morris.js',
	'/backend/js/bootstrap.js',
	'/backend/js/jquery.dcjqaccordion.2.7.js',
	'/backend/js/scripts.js',
	'/backend/js/jquery.slimscroll.js',
	'/backend/js/jquery.nicescroll.js',
	'/backend/js/jquery.scrollTo.js',
	'/backend/ckeditor/ckeditor.js',
	'/backend/DataTables/datatables.min.js',
	'/backend/js/datatables.min.js',
	'/backend/js/pdfmake.min.js',
	'/backend/js/vfs_fonts.js',
	'/backend/js/jquery.form-validator.min.js',
	'/backend/js/monthly.js',
	'/backend/js/canvasjs.min.js',
	'/backend/css/morris.css',
    '/images/icons/icon-72x72.png',
    '/images/icons/icon-96x96.png',
    '/images/icons/icon-128x128.png',
    '/images/icons/icon-144x144.png',
    '/images/icons/icon-152x152.png',
    '/images/icons/icon-192x192.png',
    '/images/icons/icon-384x384.png',
    '/images/icons/icon-512x512.png',
];

// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("pwa-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                return response || fetch(event.request);
            })
            .catch(() => {
                return caches.match('offline');
            })
    )
});