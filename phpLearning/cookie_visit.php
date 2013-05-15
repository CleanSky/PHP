<?php
//php利用cookie记录访问人数
if (!isset($_COOKIE['visits'])) $_COOKIE['visits'] = 0;
$visits = $_COOKIE['visits'] + 1;
setcookie('visits',$visits,time()+3600*24*365);
?>
<html>
<head>
<title> Title </title>
</head>
<body>
<?php
if ($visits > 1) {
  echo("This is visit number $visits.");
} else { // First visit
  echo('Welcome to oschina.net! Click here for a tour!');
}
?>
</body>
</html>