<?php
require 'config.php';

$request = ($require_ssl) ? 'https://' : 'http://';
if (empty($_GET['url'])) header("Location: " . $request . $site_url);

try {
    $dbh = new PDO("mysql:host=$sql_host;dbname=$sql_db", $sql_user, $sql_pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $dbh->prepare('SELECT * FROM linkTable where shortCode = :shortCode');
    $query->bindParam(':shortCode', $_GET['url']);
    $query->execute();
    if ($query->rowCount() == 0) header("Location: " . $request . $site_url);
    $urldata = $query->fetch();
    if ($urldata["clicks"] !== -1) {
        $updateClicks = $dbh->prepare('UPDATE linkTable set clicks = clicks + 1 where shortCode = :shortCode');
        $updateClicks->bindParam(':shortCode', $_GET['url']);
        $updateClicks->execute();
    }
    header('Location: ' . $urldata["address"]);
    echo $urldata["address"];
} catch(PDOException $e) {
    header("Location: " . $request . $site_url);
}