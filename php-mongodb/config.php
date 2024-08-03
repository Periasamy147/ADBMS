<?php
require 'vendor/autoload.php'; // Include Composer's autoloader

$client = new MongoDB\Client("mongodb://localhost:27017");

$database = $client->mydb;
$usersCollection = $database->users;
$notesCollection = $database->notes;
?>
