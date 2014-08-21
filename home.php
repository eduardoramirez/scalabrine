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
         <div class="container narrow">
            <div class="row marketing">
               <div class="col-lg-3">
                  <h4>JavaScript Error Collecting</h4>
                  <p>We have a service endpoint that collects the errors sent in as JavaScript errors happen.</p>
               </div>
               <div class="col-lg-3">
                  <h4>Account Creation and Management</h4>
                  <p>Users who wish to track their errors on their website can create an account, which may have many users. Additionally, each account will have full user management (Add, Edit and Delete users including setting passworsd and access). Users may also recover their own password using our password recovery system.</p>
               </div>
               <div class="col-lg-3">
                  <h4>Dashboard Page for Recent Errors</h4>
                  <p>Users who create an account can see their recent errors in a grid and chart.</p>
               </div>
               <div class="col-lg-3">
                  <h4>Error Detail Page</h4>
                  <p>Users can see an error detail page that show an error incident and provides an area for other users to comment on the errors and rate severity of an error (1-5 stars). Users can also upload screenshots.</p>
               </div>
               <div class="col-lg-3">
                  <h4>Configuration Page</h4>
                  <p>This configuration page is for developers to get the script for the site they will track errors on.</p>
               </div>
               <div class="col-lg-3">
                  <h4>Admin Dashboard</h4>
                  <p>This admin dashboard allows the admin to see who logs in and logs out of the system, add/edit/delete clients, and get basic stats on overall usage and error rates across accounts.</p>
               </div>
            </div>
            
         </div>
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
