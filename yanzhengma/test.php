<?php
set_time_limit(0);//ץȡ����ʱ������

include ("Valite.php");

$valite = new Valite();
$valite->setImage('1.jpeg');
$valite->getHec();
$ert = $valite->run();
print_r($ert);

?>
