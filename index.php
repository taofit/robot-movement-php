<?php

$url = "Oskar Kallström";
$newUrl = urlencode($url);
echo $newUrl;
echo ' ';
echo urldecode($newUrl);