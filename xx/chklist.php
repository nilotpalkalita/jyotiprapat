<?php

$abc = rand(3000,5000);
$i = 0;
 if(!empty($_POST['chk'])){
     foreach($_POST['chk'] as $report_id){
     	++ $i;
     	$str = '....';
     	echo $i;
     	echo nl2br($str);
        echo "$report_id was checked! ";
     }
   }

?>