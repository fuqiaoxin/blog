<?php
//echo '<pre>';
var_dump($_SERVER);

$url=$_SERVER['SERVER_NAME'];
$url.=$_SERVER['REQUEST_URI'];

echo $url;