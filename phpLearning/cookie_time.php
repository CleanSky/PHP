<?php
//PHP 通过 Cookie 记录用户的访问时间
 setcookie( "vegetable", "artichoke", time()+3600, "/",".oschina.net", 0 );
 ?>
 <html>
 <head>
 <title>Setting and Printing a Cookie Value</title>
 </head>
 <body>
 <?php
 if ( isset( $_COOKIE['vegetable'] ) ) {
     print "<p>Hello again, your chosen vegetable is ";
     print "{$_COOKIE['vegetable']}</p>";
 } else {
     print "<p>Hello you. This may be your first visit</p>";
 }
 ?>
 </body>
 </html>