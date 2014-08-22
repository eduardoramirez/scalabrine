<!DOCTYPE HTML>
<html>
   <head>
      <title>scalabrine | gzip</title>
      <meta charset="utf-8">
      <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300italic,600%7CSource+Code+Pro" rel="stylesheet" />
      <link rel="icon" href="/images/favicon.ico" type="image/x-icon" />
      <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />      
      <link rel="stylesheet" href="/css/gzip.css" />
</head>

<body>
      <?php
         session_start();
         if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
            header("Location: /login");
         }
      ?>
<table id="l2">
    <tbody><tr>
      <td style="width:655px; padding:20px; vertical-align:top">

        <h1>deflate / gzip results</h1>

        <a href="http://104.131.195.41:9091/index">http://104.131.195.41:9091/index</a>
  
        <table style="width:100%;">
          <tbody><tr>
            <td style="vertical-align:top; width:auto;">
              <table style="height:250px; width:300px;">
                <tbody><tr>
                  <td style="border-bottom:1px dotted #dadada;">Web page compressed?</td>
                  <td style="border-bottom:1px dotted #dadada; text-align:right; font-weight:bold;"><span style="color:#AAB161;">Yes</span></td>
                </tr>
                <tr>
                  <td style="border-bottom:1px dotted #dadada;">Compression type?</td>
                  <td style="border-bottom:1px dotted #dadada; text-align:right; font-weight:bold;">gzip</td>
                </tr>
                <tr>
                  <td style="border-bottom:1px dotted #dadada;">Size, Markup (bytes)</td>
                  <td style="border-bottom:1px dotted #dadada; text-align:right; font-weight:bold;">6,290</td>
                </tr>
                <tr>
                  <td style="border-bottom:1px dotted #dadada;">Size, Compressed (bytes)</td>
                  <td style="border-bottom:1px dotted #dadada; text-align:right; font-weight:bold;">1,850</td>
                </tr>
                <tr>
                  <td>Compression %</td>
                  <td style="text-align:right; font-weight:bold;">70.6</td>
                </tr>
                </tbody>
              </table>
            </td>
          </tr></tbody>
        </table>
  

      <table style="width:100%;">
        <tbody><tr>
          <td style="width:50%; vertical-align:top; text-align:left;">
          <h2>Response Headers</h2>
          <table style="border-collapse:collapse; color:#D8D6D6; font:normal 11px &#39;bitstream vera sans mono&#39;,&#39;courier new&#39;,monospace; width:310px;">
            <tbody><tr>
  <td style="background-color:#91998E; border:1px solid #E6E6E6;">status</td>
  <td style="border:1px solid #E6E6E6;">HTTP/1.1 302 Found</td>
</tr><tr>
  <td style="background-color:#91998E; border:1px solid #E6E6E6;">date</td>
  <td style="border:1px solid #E6E6E6;">Tue, 12 Aug 2014<br>23:18:05 GMT</td>
</tr><tr>
  <td style="background-color:#91998E; border:1px solid #E6E6E6;">set-cookie</td>
  <td style="border:1px solid #E6E6E6;">OnlyNinjasCanSeeThis<br>=qo0gqs8a97uh3t6j2fl<br>vmb7du5; path=/</td>
</tr><tr>
  <td style="background-color:#91998E; border:1px solid #E6E6E6;">expires</td>
  <td style="border:1px solid #E6E6E6;">Thu, 19 Nov 1981<br>08:52:00 GMT</td>
</tr><tr>
  <td style="background-color:#91998E; border:1px solid #E6E6E6;">cache-control</td>
  <td style="border:1px solid #E6E6E6;">no-store, no-cache,<br>must-revalidate,<br>post-check=0,<br>pre-check=0</td>
</tr><tr>
  <td style="background-color:#91998E; border:1px solid #E6E6E6;">pragma</td>
  <td style="border:1px solid #E6E6E6;">no-cache</td>
</tr><tr>
  <td style="background-color:#91998E; border:1px solid #E6E6E6;">location</td>
  <td style="border:1px solid #E6E6E6;">/login</td>
</tr><tr>
  <td style="background-color:#91998E; border:1px solid #E6E6E6;">content-encoding</td>
  <td style="border:1px solid #E6E6E6;">gzip</td>
</tr><tr>
  <td style="background-color:#91998E; border:1px solid #E6E6E6;">vary</td>
  <td style="border:1px solid #E6E6E6;">Accept-Encoding,User<br>-Agent</td>
</tr><tr>
  <td style="background-color:#91998E; border:1px solid #E6E6E6;">content-length</td>
  <td style="border:1px solid #E6E6E6;">1850</td>
</tr><tr>
  <td style="background-color:#91998E; border:1px solid #E6E6E6;">connection</td>
  <td style="border:1px solid #E6E6E6;">close</td>
</tr><tr>
  <td style="background-color:#91998E; border:1px solid #E6E6E6;">content-type</td>
  <td style="border:1px solid #E6E6E6;">text/html</td>
</tr>
          </tbody></table>
        </td>

      </tr>
    </tbody></table>
    </td></tr></tbody></table>

    <p>gidnetwork.com/tools/gzip-test.php was used in our testing. gzip was installed and configured by default with Apache. We tested that html, CSS, and JS files are being compressed when client requests include the header “Accept-Encoding: gzip.” When that header is part of the request, then the response also includes the same header.The server does not compress images even when that header is specified. We’re assuming this is because images are already compressed and it would not provide any benefit. Even if the header is part of the request, the server will not include it as part of the response.</p>
</body></html>