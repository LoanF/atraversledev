<?php

$dbh = new PDO("mysql:host=localhost;dbname=gestionformation;charset=utf8", "root", "root");

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
$stmt = $dbh->prepare("DELETE FROM formation WHERE formation.IdFormation = :id");
 
$stmt -> bindParam(':id', $_GET["id"]);
 
$stmt->execute();
 
$dbh = null;

header('Location: panel.php');

?>