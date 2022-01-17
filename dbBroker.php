<?php
$host = "localhost";
$db = "pretplata";
$username = "root";
$password = "";

$connection = new mysqli($host, $username, $password, $db);

if ($connection->connect_errno) {
    exit("Nauspesna konekcija: greska> ".$conn->connect_error);
}