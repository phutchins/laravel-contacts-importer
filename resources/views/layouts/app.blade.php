<!doctype html>
<html>
  <head>
    <title>CSV Importer - @yield('title')</title>
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>
    <h1>CSV Importer</h1>
    <div id="app">
      <contactsapp></contactsapp>
      <!-- @yield('content') -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
    <script src="/js/app.js"></script>
    @yield('javascript')
  </body>
</body>
</html>
