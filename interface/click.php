<?php 
include 'config.php'; 
if ($show_counter == "no"){
 die("Counter disabled.");
}
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

<title><?php echo $page_title; ?></title>

</head>
<body>

<?php
$shortcode = $_GET['id'];
if (empty($shortcode)){
die("<br /><center><h3>Please enter your short code.</h3></center>");
} else {
$connection = mysqli_connect($sqlhost, $sqluser, $sqlpass, $sqldb);
$result = mysqli_query($connection, 'select url, counter from urldata where shortcode="'.$shortcode.'";');

if (mysqli_num_rows($result) == 0){
die("<br /><center><h3>An invalid short code was supplied.</h3></center>");
}

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$newurl = $row["url"];
$counter = $row['counter'];
 
echo '<br /><center><h3>Full URL:</h3>';
echo '<p>'.$newurl.'</p>';
echo '<p>It has gained '.$counter.' views. Nice job!</p></center>';
}
?>

</body>
</html>
