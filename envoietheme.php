<?php
 

$dbh = new PDO("mysql:host=localhost;dbname=gestionformation;charset=utf8", "root", "root");

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
$stmt = $dbh->prepare("INSERT INTO theme (NomTheme, LogoTheme) VALUES (:nomtheme, :logo)");
$param2 = 'img/'.$_FILES['logo']['name'];
$stmt -> bindParam(':nomtheme', $_POST["nomtheme"]);
$stmt -> bindParam(':logo', $param2);
$stmt->execute();
$dbh = null;

$tmpName = $_FILES['logo']['tmp_name'];
$name = $_FILES['logo']['name'];
$size = $_FILES['logo']['size'];
$error = $_FILES['logo']['error'];
$tabExtension = explode('.', $name);
$extension = strtolower(end($tabExtension));
$extensions = ['jpg', 'png', 'jpeg'];
if(in_array($extension, $extensions)){
    move_uploaded_file($tmpName, 'img/'.$name);
}
else{
    echo "Mauvaise extension";
}



header('Location: panel.php');

?>