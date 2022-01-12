<?php
 

$dbh = new PDO("mysql:host=localhost;dbname=gestionformation;charset=utf8", "root", "root");

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
$stmt = $dbh->prepare("INSERT INTO formation (Descriptif, NomFichier, Niveau, IdTheme) VALUES (:nomforma, :pdfforma, :niveau, :theme)");
$param2 = 'fichier/'.$_FILES['pdfforma']['name'];
$stmt -> bindParam(':nomforma', $_POST["nomforma"]);
$stmt -> bindParam(':pdfforma', $param2);
$stmt -> bindParam(':niveau', $_POST["niveau"]);
$stmt -> bindParam(':theme', $_POST["theme"]);
$stmt->execute();
$dbh = null;

$tmpName = $_FILES['pdfforma']['tmp_name'];
$name = $_FILES['pdfforma']['name'];
$size = $_FILES['pdfforma']['size'];
$error = $_FILES['pdfforma']['error'];
$tabExtension = explode('.', $name);
$extension = strtolower(end($tabExtension));
$extensions = ['pdf'];
if(in_array($extension, $extensions)){
    move_uploaded_file($tmpName, 'fichier/'.$name);
}
else{
    echo "Mauvaise extension";
}



header('Location: panel.php');

?>