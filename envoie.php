<?php
 

$dbh = new PDO("mysql:host=localhost;dbname=gestionformation;charset=utf8", "root", "root");

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
$stmt = $dbh->prepare("INSERT INTO contact (Nom, PNom, Formation, Commentaire, Email) VALUES (:nom, :prenom, :theme, :commentaire, :email)");
 
$stmt -> bindParam(':nom', $_POST["nom"]);
$stmt -> bindParam(':prenom', $_POST["prenom"]);
$stmt -> bindParam(':theme', $_POST["theme"]);
$stmt -> bindParam(':commentaire', $_POST["commentaire"]);
$stmt -> bindParam(':email', $_POST["email"]);
 
$stmt->execute();
 
$dbh = null;

header('Location: contact.php');

?>