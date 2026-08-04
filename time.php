<?php
date_default_timezone_set('Asia/Calcutta');
$curret_date1 = date("Y-m-d H:i:s");
$diff = strtotime($curret_date1);
echo date('Y-m-d H:i:sa',$diff)."<br>";
$curret_date1 = date("Y-m-d H:i:s");

?>