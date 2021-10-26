<?php

if ($_SERVER["SERVER_NAME"] == "localhost")
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

	$servername = "localhost";
	$username = "root";
	$password = "123456";
	$dbname = "jimmy";

    $conn = new mysqli($servername, $username, $password, $dbname);
}
else
{
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);

    $servername = "db-mysql-sgp1-70384-do-user-8294932-0.b.db.ondigitalocean.com";
    $username = "rootnew";
    $password = "fqv0pp57umztqf10";
    $dbname = "jimmy";
    $port = 25060;

    $conn = new mysqli($servername, $username, $password, $dbname, $port);
}

define('MAILCHIMP_APIKEY','fd194716bec5c6fbdff48d332b4c5190-us5');
define('MAILCHIMP_SERVER','us5');
define('MAILCHIMP_LISTID','b9eece34b4');

if ($conn->connect_errno)
{
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}

?>