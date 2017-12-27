<?php
require 'config.php';

if (empty($_POST['url'])) die('<div class="alert alert-warning">Please enter an address.</div>');
if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) die('<div class="alert alert-danger">Invalid address.</div>');

$analytics = ($_POST['enableAnalytics'] == "on") ? 0 : -1;
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
try {
    $dbh = new PDO("mysql:host=$sql_host;dbname=$sql_db", $sql_user, $sql_pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $iterations = 0;
    while($iterations <= 10) { // Keep generating short codes until we get one that hasn't been used yet
        $string = generateRandomString(8);
        $check = $dbh->prepare('SELECT id FROM linkTable WHERE shortCode = :shortCode');
        $check->bindParam(':shortCode', $string);
        $check->execute();
        if ($check->rowCount() !== 0) {
            $inUse = true;
        } else {
            break;
        }
        $iterations++;
    }
    if ($iterations == 10) die('<div class="alert alert-warning">There was an issue processing your request. Please try again.</div>');
    $query = $dbh->prepare('INSERT INTO linkTable (address, clicks, shortCode, submittedBy) VALUES (:address, :clicks, :shortCode, :submittedBy)');
    $query->bindParam(':address', $_POST['url']);
    $query->bindParam(':shortCode', $string);
    $query->bindParam(':clicks', $analytics);
    $query->bindParam(':submittedBy', $_SERVER['REMOTE_ADDR']);
    $query->execute();
    $request = ($require_ssl == true) ? "https://" : "http://";
    $newURL = $request . $site_url . '/' . $link_directory . '/' . $string;
    echo '<div class="alert alert-success">Your link was shortened to: <a href="' . $newURL . '" target="_blank">' . $newURL . '</a>';
} catch(PDOException $e) {
    if ($debugging) $error = ' Error: ' . $e->getMessage();
    echo '<div class="alert alert-danger">Service issue.' . $error . '</div>';
}
?>
