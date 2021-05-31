<?php 

$diff = strtotime("2010-07-05") - strtotime("2010-07-01");
if($diff < 86400)
    echo 'Less than a day';
else
    echo (int)($diff / 86400) . ' days';
