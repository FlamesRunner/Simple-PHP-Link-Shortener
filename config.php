<?php
// Site settings
$require_ssl = false; // The require SSL mode will force SSL and will make all shortened links use SSL
$site_url = 'example.com/shorten'; // Do not include http:// or https:// and do not add a trailing slash at the end of the URL.
$site_title = 'Link Shortener';
$debugging = false; // Enable to show PDO exceptions, etc
$link_directory = 'a'; // A shortened link will look like: http://yourSite.com/linkshortener/a/<some short code> - make sure you change the directory 'a' inside the directory to this name!

// MySQL Information
$sql_user = '';
$sql_pass = '';
$sql_host = 'localhost';
$sql_db = '';

// Header, description and footer/advertising code
$header = '';
$description = '<p>Simple, no frills link shortening. Analytics are optional.</p>';
$footer = '';
?>
