<!DOCTYPE HTML>
<html>
   <head>
      <title>scalabrine | team 16</title>
      <meta charset="utf-8">
      <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300italic,600%7CSource+Code+Pro" rel="stylesheet" />
      <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
      <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
      <link rel="stylesheet" href="css/other.css"/>
      <link rel="stylesheet" href="css/bootstrap.min.css">

      <!--[if lte IE 8]><script src="js/html5shiv.js" type="text/javascript"></script><![endif]-->
      <script src="js/skel.min.js"></script>
      <script>
      skel.init({
         prefix: 'css/style',
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
 <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Connection', 2],
          ['Server-Side', 1],
          ['Client-Side', 3],
          ['Server', 2],
          
        ]);

        // Set chart options
        var options = {
            'backgroundColor': 'transparent',
            'title':'Types of errors',
                       'width':800,
                       'height':600,
                       is3D: true,
                       'fontName': 'Source Sans Pro',
                       'fontSize': 20,
                       pieSliceTextStyle: {color: '#FFF9ED', 'fontName': 'Source Sans Pro', 'fontSize': 20},
                       titleTextStyle: {color: '#b2b9bC', 'fontName': 'Source Sans Pro', 'fontSize': 22 },
                       legendTextStyle: {color: '#b2b9bC', 'fontName': 'Source Sans Pro' },
                       colors: ['#e97770','#47B2B2', '#004C80', '#00A352'],
                       chartArea:{left:350,top:100}
                    };

                  pieSliceTextStyle: {
            color: 'black'
        }

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
   </head>



   <body>
      <?php
         session_start();
         if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
            header("Location: /login");
         }
      ?>
      <div class="container">
         <!-- Header -->
         <header role="banner">
            <div id="header" class="row">
               <div class="4u">
                  <div id="logo"></div>
                  <h1>scalabrine</h1>
               </div>
               <div class="8u" id="nav">
                  <a href="/config">config</a>
                  <a href="/error_log">error logs</a>
                  <a href="/gzip">gzip</a>
                  <a href="/logout">logout</a>
               </div>
            </div>
         </header>
         <!-- Hero -->
         <section id="hero">
               <h2>welcome user.</h2>
                      </section>
         <!-- Main -->
<table class="table table-bordered table-striped table-responsive">
  <th>Error Message</th>
  <th>Times Occured</th>
  <tr><td>[client 137.110.90.227:53661]  referer: http://104.131.195.41:9091/piwik/index.php?module=CoreHome</td>
   <td>3</td>
</tr>
<tr><td>[client 108.253.176.209:56081] [104.131.195.41/sid#7f5ada893868][rid#7f5adb1170a0/initial]</td>
   <td>4</td>
</tr>
<tr><td>[client 108.253.176.209:50616] [rid#7fb3293880a0/subreq] local path result: /index.cgi.php  </td>
   <td>1</td>
</tr>
<tr><td>[client 137.110.90.227:60590] [rid#7fb32e2180a0/initial] init rewrite engine with requested uri /js/  </td>
   <td>5</td>
</tr>
<tr><td>[client 108.253.176.209:55348] [rid#7fb5dd2030a0/initial] applying pattern '^(.*)' to uri '/login'   </td>
   <td>10</td>
</tr>
</table>




         <!--Div that will hold the pie chart-->
         <div id="chart_div"></div>

         
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
