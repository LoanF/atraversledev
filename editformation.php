<?php
 

$dbh = new PDO("mysql:host=localhost;dbname=gestionformation;charset=utf8", "root", "root");

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
$stmt = $dbh->prepare("UPDATE formation SET  Descriptif=:nomformation, Niveau=:niveauformation, IdTheme=:themeformation, NomFichier=:logoformation WHERE IdFormation = :id");

$param2 = 'fichier/'.$_FILES['pdfforma']['name'];

$stmt -> bindParam(':id', $_GET["id"]);
$stmt -> bindParam(':nomformation', $_POST["nomforma"]);
$stmt -> bindParam(':niveauformation', $_POST["niveau"]);
$stmt -> bindParam(':themeformation', $_POST["theme"]);
$stmt -> bindParam(':logoformation', $param2);
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