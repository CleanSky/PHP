<?php
set_time_limit(0);//抓取不受时间限制

include ("Valite.php");

$valite = new Valite();
$valite->setImage('1.jpeg');
$valite->getHec();
$ert = $valite->run();
print_r($ert);

?>
