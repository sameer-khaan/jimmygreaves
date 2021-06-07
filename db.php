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
    
    $_GLOBAL['admin_email'] = "sameerkhan5130@gmail.com";
    $_GLOBAL['from_email'] = "info@jimmygreaves.foundation";
    $_GLOBAL['from_name'] = "Jimmy Greaves Foundation";

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

    $_GLOBAL['admin_email'] = "sameerkhan5130@gmail.com";
    $_GLOBAL['from_email'] = "info@jimmygreaves.foundation";
    $_GLOBAL['from_name'] = "Jimmy Greaves Foundation";

    $conn = new mysqli($servername, $username, $password, $dbname, $port);
}

if ($conn->connect_errno)
{
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}

?>