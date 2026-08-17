<?php
$user = 'root';
$pass = '';
$database = 'assignment1';

$db = new mysqli('localhost', $user, $pass, $database) or die("Unable to connect");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>