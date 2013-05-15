<?php
$interest = "arts";
$homepage = "http://www.oschina.net";
$query = "homepage=".urlencode( $homepage );
$query .= "&interest=".urlencode( $interest );
echo $query;
?>