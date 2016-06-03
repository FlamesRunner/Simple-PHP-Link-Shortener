<?php
include 'config.php';
include 'ssl.php';

$url = $_POST['url'];
$ip = $_SERVER['REMOTE_ADDR'];

if (filter_var($url, FILTER_VALIDATE_URL) === false) {
header("Location: /?err=1");
die();
}

for ($i = 0; $i<6; $i++) 
{
    $a .= mt_rand(0,9);
}

$connection = mysqli_connect($sqlhost, $sqluser, $sqlpass, $sqldb);
$result = mysqli_query($connection, 'insert into urldata (shortcode, url, counter, ip) VALUES ("'.$a.'", "'.$url.'", "0", "'.$ip.'");');
mysqli_close($connection);

setcookie("shortcode", $a, time()+3600); 
setcookie("oldurl", $url, time()+3600); 
header("Location: success.php");

?>
