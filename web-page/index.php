<?php 

require_once("config.php");
include("nav.php");

//SQL query
$statement = $pdo->query("SELECT * FROM User");

//Runs query
$rows = $statement->fetchAll(pdo::FETCH_ASSOC);

//Shows results
//var_dump($rows);
echo "<pre>";
print_r($rows);
echo "</pre>";



?>