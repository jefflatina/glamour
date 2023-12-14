<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "glamour";

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
{
    die("Something went wrong.". mysqli_connect_error());
}

?>