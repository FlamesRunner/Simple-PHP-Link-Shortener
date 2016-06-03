<?php
include 'config.php';

$shortcode = $_GET['a'];

if (empty($shortcode)){

header("Location: /");
die();

} else {

$connection = mysqli_connect($sqlhost, $sqluser, $sqlpass, $sqldb);
$result = mysqli_query($connection, 'select url, counter from urldata where shortcode="'.$shortcode.'";');

if (mysqli_num_rows($result) == 0){
header("Location: /");
die();
}

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$newurl = $row["url"];
$counter = $row['counter'];
$newcounter = $counter + 1;

$updatequery = mysqli_query($connection, 'update urldata set counter="'.$newcounter.'" where shortcode="'.$shortcode.'";');

mysqli_close($connection);

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

<script type="text/javascript">
function countdown() {
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML)<=1) {
	clearInterval(timervariable);
	window.location = '<?php echo $newurl; ?>';
    }
    i.innerHTML = parseInt(i.innerHTML)-1;
}

var timervariable = setInterval(function(){ countdown(); },1000);

</script>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href=""><?php echo $page_title; ?></a>
    </div>
   <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <p class="navbar-text">Redirecting in <span id="counter">10</span> seconds</p>
      </ul>
   </div>
  </div>
</nav>

<div style="padding-top: 10%;"></div>
<div style="text-align: center;">
<h3>Thank you for using our service!</h3>
<p>You will be redirected momentarily.</p>
<br />
<div class="btn-group">
<a onclick="clearInterval(timervariable);" class="btn btn-danger">Pause the counter. I think the link is malicious.</a>
<a href="/a/<?php echo $shortcode; ?>" class="btn btn-success">I've verified the URL and it's safe.</a>
</div>
<br />
<br />
<br />
<p>Full URL: <?php echo $newurl; ?></p>
<br />
<br />
<p style="font-size: 10px;">Sponsored content</p>

<?php echo $ad_code; ?>

<br />
<br />
<p><b>Report abuse:</b> <?php echo $abuse_email; ?></p>

</div>
</body>

</html>
<?php
}
?>
?>
