<?php 
require 'config.php'; 
if ($require_ssl) {
    if (empty($_SERVER['HTTPS'])) header("Location: https://" . $site_url);
}
?>
<!DOCTYPE html>
<html>
        <head>
            <title><?php echo $site_title; ?></title>
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js" integrity="sha384-3ziFidFTgxJXHMDttyPJKDuTlmxJlwbSkojudK/CkRqKDOmeSbN6KLrGdrBQnT2n" crossorigin="anonymous"></script>            
            <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
            <?php if ($recaptcha) echo "<script src='https://www.google.com/recaptcha/api.js'></script>"; ?>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <style>
                body {
                    font-family: 'Lato', sans-serif;
                }
            </style>
            <?php echo $header; ?>
        </head>
        <body>
            <!-- Analytics modal -->
            <div class="modal fade" id="statisticsModal" tabindex="-1" role="dialog" aria-labelledby="statisticsModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">View statistics for a link</div>
                        <div class="modal-body">
                            <form id="statisticsQuery" method="POST" action="statistics.php">
                                <div class="input-group">
                                    <span class="input-group-addon">Your 8-character short code</span>
                                    <input type="text" class="form-control" name="shortcode" placeholder="abc123de" />
                                    <span class="input-group-btn">
                                        <input type="submit" class="btn btn-primary" name="queryBtn" value="Query" />
                                    </span>
                                </div>
                            </form>
                            <div id="statisticsArea"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End analytics modal. Begin main page -->
            
            <div class="jumbotron" style="background-color: #e6e6e6">
                <div class="container">
                    <h1><?php echo $site_title; ?></h1>
                    <?php echo $description; ?>
                    <br />
                    <div id="alertArea"></div>
                    <form action="shorten.php" method="POST" id="shortenForm">
                        <div class="input-group">
                            <span class="input-group-addon">Address to shorten</span>
                            <input class="form-control" type="url" name="url" id="url" placeholder="http://lowendtalk.com" />
                            <span class="input-group-btn">
                                <input class="btn btn-primary g-recaptcha" onclick="lockInput()" type="submit" name="submitBtn" value="Shorten" data-callback="continueSubmit" data-sitekey="<?php echo $recaptcha_publickey; ?>" />
                            </span>
                        </div>
                        <br />
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="checkbox" name="enableAnalytics" class="form-check-input">Enable analytics</label>
                            <span style="float: right;">
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#statisticsModal">Statistics</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                function lockInput() {
                    $("input[name=url]").prop("readonly", true);
                    $("input[name=submitBtn]").prop("disabled", true);
                }
                function continueSubmit(token) {
                    $("#shortenForm").submit();
                }
                $(document).ready(function() {
                    $("#shortenForm").submit(function(event) {
                        event.preventDefault();   
                        var req = $.post("shorten.php", $("#shortenForm").serialize());
                        req.done(function(data) {
                            $("#alertArea").html(data);
                            $("input[name=url]").prop("readonly", false);
                            $("input[name=submitBtn").prop("disabled", false);
                        });
                        grecaptcha.reset();
                    });
                    $("#statisticsQuery").submit(function(event) {
                        $("input[name=shortcode]").prop("readonly", true);
                        $("input[name=queryBtn]").prop("disabled", true);
                        event.preventDefault();   
                        var req = $.post("statistics.php", $("#statisticsQuery").serialize());
                        req.done(function(data) {
                            $("#statisticsArea").html(data);
                            $("input[name=shortcode]").prop("readonly", false);
                            $("input[name=queryBtn").prop("disabled", false);
                        });
                    });
                });
            </script>
        </body>
        <footer>
            <?php echo $footer; ?>
        </footer>
</html>