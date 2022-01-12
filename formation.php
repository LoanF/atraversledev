<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="style.css"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="img/favicon.png" type="images/x-icon" />
        <script src="https://kit.fontawesome.com/94af0f2e21.js" crossorigin="anonymous"></script>
        <title>À travers le dev | Formations</title>
    </head>

    <body>
        <?php include("entete.php"); ?>

        <?php
        $dbh = new PDO("mysql:host=localhost;dbname=gestionformation;charset=utf8", "root", "root", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $stmt = $dbh->query("SELECT * FROM theme");
        echo '<article>';
        while ($result=$stmt->fetch())
              {
                        echo "<a href='formation.php?forma=".$result['IdTheme']."' class='forma'>
                        <div>
                        <img src='". $result['LogoTheme'] ."' id='img'/>
                        </div>
                        </a>";
              }
        $stmt->closeCursor();
        echo '</article>';
        if (!empty($_GET['forma'])) {
            echo '<article>';
            $theme = $_GET['forma'];
            $stmt = $dbh->prepare("SELECT * FROM formation where IdTheme='$theme'");
            $stmt -> execute();
            while ($result=$stmt-> fetch())
            {
                echo "<div class='forma2'><h3>".
                $result['Descriptif']."
                </h3><p>".
                $result['Niveau'];
                if (!isset($result['NomFichier'])) {
                    echo "<p><button class='off'><i class='fas fa-file-pdf'></i> Télécharger</button></p>";
                }
                if (isset($result['NomFichier'])) {
                    echo "<p><a href='". $result['NomFichier'] ."' target='_blank'><button class='on'><i class='fas fa-file-pdf'></i> Télécharger</button></a><p>";
                }

                echo "</p></div>";
            }
            echo '</article>';}
        $stmt->closeCursor();
        $dbh=null;?>

        <p>Pour débuter une formation, merci de remplir le <a href="contact.php">formulaire</a> et nous vous recontacterons !</p>

      <?php include("footer.php"); ?>
    </body>
</html>