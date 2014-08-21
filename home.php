<!DOCTYPE HTML>
<html>
   <head>
      <title>scalabrine</title>
      <meta charset="utf-8">
      <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300italic,600%7CSource+Code+Pro" rel="stylesheet" />
      <link rel="icon" href="/images/favicon.ico" type="image/x-icon" />
      <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
      <link rel="stylesheet" href="/css/other.css" />
      <!--[if lte IE 8]><script src="js/html5shiv.js" type="text/javascript"></script><![endif]-->
      <script src="/js/skel.min.js"></script>
      <script>
      skel.init({
         prefix: '/css/style',
         preloadStyleSheets: true,
         resetCSS: true,
         boxModel: 'border',
         grid: { gutters: 30 },
         breakpoints: {
            wide: { range: '1200-', containers: 1140, grid: { gutters: 50 } },
            narrow: { range: '481-1199', containers: 960 },
            mobile: { range: '-480', containers: 'fluid', lockViewport: true, grid: { collapse: true } }
         }
      });
      document.write('<link rel="stylesheet" href="/css/font-awesome.min.css" />')
      </script>
   </head>
   <body>
      <div class="container">
         <!-- Header -->
         <header role="banner">
            <div id="header" class="row">
               <div class="4u">
                  <div id="logo"></div>
                  <h1>scalabrine</h1>
               </div>
               <div class="8u" id="nav">
                  <a href="/team">about us</a>
                  <a href="/login">login</a>
                  <a href="/signup">sign up</a>
               </div>
            </div>
         </header>
         <!-- Hero -->
         <section id="hero">
               <h2>hello.</h2>
               <p>we are scalabrine.</p>
         </section>
         <!-- Main -->
        <!-- things about our product should go here -->
         <!-- Footer -->
         <footer>
            <div id="footer">
               &copy; scalabrine.
            </div>
         </footer>
      </div>

   <!-- Piwik -->
   <script type="text/javascript">
       var _paq = _paq || [];
       _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
         (function() {
            var u=(("https:" == document.location.protocol) ? "https" : "http") + "://104.131.195.41:9091/piwik/";
            _paq.push(['setTrackerUrl', u+'piwik.php']);
            _paq.push(['setSiteId', 1]);
             var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
                   g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
            })();
   </script>
   <noscript><p><img src="http://104.131.195.41:9091/piwik/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
   <!-- End Piwik Code -->


   </body>
</html>
