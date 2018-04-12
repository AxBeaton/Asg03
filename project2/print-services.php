<?php
$url='json/printRules.json';
$str = file_get_contents($url);
header('Content-Type: application/json');
echo $str;
?>