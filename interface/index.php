<?php include 'config.php'; ?>
<?php include 'ssl.php'; ?>

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

<div class="container">
<div style="padding-top: 5%;"></div>
<h1><?php echo $page_title; ?></h1>
<hr>
<div style="padding-top: 20px;"></div>
<form action="shorten.php" method="POST">

<?php
if ($_GET['err'] === "1"){
?>
<div class="alert alert-danger fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <b>Error: </b> You specified an invalid URL.</b>
</div>
<div style="padding-top: 10px;"></div>
<?php
} else {
?>
<div style="padding-top: 10px;"></div>
<?php
}
?>

<div class="input-group">
<span class="input-group-addon" id="basic-addon1">URL to shorten</span>
<input class="form-control" name="url" placeholder="http://example.com" />
</div>
<div style="padding-top: 2%;"></div>
<input type="submit" class="btn btn-default" value="Shorten URL" style="float: right;" />
</form>

<br />
<br />
<br />

<div style="text-align: center;">
<p style="font-size: 10px;">Sponsored content</p>
<?php echo $ad_code; ?>
</div>
<br />
<br />

<?php
if ($show_counter == "no"){

} else {
?>
<script type="text/javascript">
function changeiframe() {
        var browserFrame = document.getElementById("clickviewer");
        browserFrame.src= "click.php?id=" + document.getElementById("clickid").value;
}
</script>

<!-- Modal -->
<div id="statistics" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Check the number of clicks</h4>
      </div>
      <div class="modal-body">
	<iframe frameborder="none" src="click.php" name="clickviewer" id="clickviewer" width="100%" height="150px" scrolling="none">Your browser does not support the statistic viewer.</iframe>
	<br />
	<br />
	<div class="input-group">
	<input type="number" name="clickid" id="clickid" placeholder="The code at the end of your shortened URL goes here." class="form-control">
	<span class="input-group-btn">
	<input type="submit" onclick="changeiframe()" class="btn btn-success" value="Check">
	</span>
	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div style="text-align: center;"><button type="button" class="btn btn-default" data-toggle="modal" data-target="#statistics">View statistics</button></div>
<?php } ?>
<br>
<p style="text-align: center;"><?php echo $page_footer; ?></p>

</div>

</body>

</html>

