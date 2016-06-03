<?php
include 'config.php';
include 'ssl.php';

if (!isset($_COOKIE["shortcode"])){
header("Location: /");
die();
}

$shortcode = $_COOKIE['shortcode'];
$longurl = $_COOKIE['oldurl'];

unset($_COOKIE['shortcode']);
unset($_COOKIE['oldurl']);
setcookie("shortcode", "", time()-3600);
setcookie("oldurl", "", time()-3600);

?>

<!DOCTYPE html>

<html>

<head>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<style type="text/css">
body {
font-family: 'Lato', sans-serif;
}
</style>

<title>Redirected</title>

</head>

<body>

<div class="container">
<div style="padding-top: 10%;"></div>
<h1><?php echo $page_title; ?></h1>
<hr>

<div style="padding-top: 10px;"></div>
<h3><b>Good job! You've shortened your URL.</b></h3>
<h4><a href="<?php echo $longurl; ?>" target="_blank"><?php echo $longurl; ?></a> has been shortened into <a href="<?php echo $url; ?>/a/<?php echo $shortcode; ?>" target="_blank"><?php echo $url; ?>/a/<?php echo $shortcode; ?></a></h4>
<div style="padding-top: 5%;"></div>
<a href="/" class="btn btn-default btn-block">Shorten another link</a>

<div style="padding-top: 10%;"></div>

<p style="text-align: center;">Designed by Andrew H.</p>

</div>

</body>

</html>
