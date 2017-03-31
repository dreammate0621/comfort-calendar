<?php

if($_SERVER['SERVER_NAME'] == 'lc.pdfdownloader.com') {
	define('SITEURL', 'http://lc.pdfdownloader.com/');

	//Database Info
	$db_host = "localhost";
	$db_name = "pdfdownloader";
	$db_user = "root";
	$db_pass = "";
}

$db_link = mysqli_connect($db_host, $db_user, $db_pass) or die('Failed in connecting to mysql server');
mysqli_select_db($db_link, $db_name) or die('Failed in selecting database');
