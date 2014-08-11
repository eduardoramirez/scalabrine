<!DOCTYPE HTML>

<?php
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
   header("Location:login.php");
}

?>
<html>
   <head>
      <title>scalabrine | team 16</title>
      <meta charset="utf-8">
      <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300italic,600%7CSource+Code+Pro" rel="stylesheet" />
      <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
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
      document.write('<link rel="stylesheet" href="css/font-awesome.min.css">')
      </script>
   </head>
   <body>
      <div class="container">
         <!-- Header -->
         <header role="banner">
            <div id="header" class="row">
               <div class="4u">
                  <h1>scalabrine</h1>
               </div>
            </div>
         </header>
         <!-- Hero -->
         <section id="hero">
               <h2>hello.</h2>
               <p>we are scalabrine.</p>
         </section>
         <!-- Main -->
         <article>
            <h3>team members</h3>
            <div class="row">
               <section class="4u">
                  <h4>Matt Asaro</h4>
                  <p><i class="fa fa-github"></i> mattasaro</p>
                  <p><i class="fa fa-envelope-o"></i> masaro@ucsd.edu</p>
                  <br>
                  <p><i class="fa fa-user"></i> Software Engineer mainly on .NET. I like coding, but I’d rather be outside playing sports or doing something in the ocean. I love watching comedies that make me laugh so hard that I cry.</p>
               </section>
               <section class="4u">
                  <h4>Slava Gadetskiy</h4>
                  <p><i class="fa fa-github"></i> vgadetsk</p>
                  <p><i class="fa fa-envelope-o"></i> vgadetsk@ucsd.edu</p>
                  <br>
                  <p><i class="fa fa-user"></i> Born in Ukraine, 3rd year transfer at UCSD, love driving, soccer and basketball.</p>
               </section>
               <section class="4u">
                  <h4>Kenny Mai</h4>
                  <p><i class="fa fa-github"></i> kenmai9</p>
                  <p><i class="fa fa-envelope-o"></i> k1mai@ucsd.edu</p>
                  <br>
                  <p><i class="fa fa-user"></i> 5th year student at UCSD, for Computer Science. I love my dog and taking care of business.</p>
               </section>
            </div>
            <div class="row">
               <section class="4u">
                  <h4>Eduardo Ramirez</h4>
                  <p><i class="fa fa-github"></i> eduardoramirez</p>
                  <p><i class="fa fa-envelope-o"></i> edr007@ucsd.edu</p>
                  <br>
                  <p><i class="fa fa-user"></i> 3rd year student at UCSD studying computer science. I love photography and soccer.</p>
               </section>
               <section class="4u">
                  <h4>Alvin See</h4>
                  <p><i class="fa fa-github"></i> alvinsee</p>
                  <p><i class="fa fa-envelope-o"></i> aysee@ucsd.edu</p>
                  <br>
                  <p><i class="fa fa-user"></i> A computer ENGINEERING student who has a very nihilistic view on life. I like taking long walks on the beach and watching the sunset.</p>
               </section>
               <section class="4u">
                  <h4>Th**@s Po**ll</h4>
                  <p><i class="fa fa-github"></i> tpo***l</p>
                  <p><i class="fa fa-envelope-o"></i> tpo***l@pi**.com</p>
                  <br>
                  <p><i class="fa fa-user"></i> Rumored phantom 6th member. Legend has it that is he the underground boss of CSE 135.</p>
               </section>
            </div>
         </article>
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
