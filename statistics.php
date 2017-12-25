<?php
require 'config.php';

if (empty($_POST['shortcode'])) die('<br /><div class="alert alert-danger">Sorry, but no URL could be resolved.</div>');

try {
    $dbh = new PDO("mysql:host=$sql_host;dbname=$sql_db", $sql_user, $sql_pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $dbh->prepare('SELECT * FROM linkTable where shortCode = :shortCode');
    $query->bindParam(':shortCode', $_POST['shortcode']);
    $query->execute();
    if ($query->rowCount() == 0) die('<br /><div class="alert alert-danger">Sorry, but no URL could be resolved.</div>');
    $urldata = $query->fetch();
    if ($urldata["clicks"] == -1) {
        echo '<br /><div class="alert alert-warning">No statistics data could be retrieved as the user who created it has opted to disable analytics.</div><p><b>Original URL:</b> ' . $urldata["address"] . '</p>';
    } else {
        echo '<br /><p><b>Original URL:</b> ' . $urldata["address"] . '</p>';
        echo '<p>Number of clicks since the link was shortened: ' . $urldata["clicks"] . '</p>';
    }
} catch(PDOException $e) {
    header("Location: " . $request . $site_url);
}