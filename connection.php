<?php
// Information about the database
$host       = 'localhost';
$username   = 'root';
$password   = '';
$database   = 'lias_hairsalon';

$db = mysqli_connect($host, $username, $password, $database)
or die('Error: '.mysqli_connect_error());

