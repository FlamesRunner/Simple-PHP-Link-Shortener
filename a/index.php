<?php
require '../config.php';
$request = ($require_ssl) ? 'https://' : 'http://';
header('Location: ' . $request . $site_url);
?>