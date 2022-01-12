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
        <title>À travers le dev | Pannel</title>
    </head>

    <body>
        <?php include("entete.php"); ?>

        <form class="form" action="envoietheme.php" method="post" enctype="multipart/form-data">
        <h2>POUR AJOUTER UN THÈME</h2>
        <label for="nomtheme">Nom du thème :</label><br/>
        <input type="text" id="nomtheme" name="nomtheme" placeholder="Nom du thème" require autofocus>
        <label for="logo">Logo du thème :</label><br/>
        <input type="file" name="logo">
        <button type="submit">Envoyer</button>
        <button type="reset">Annuler</button>
        <br/><br/><br/>
        </form>

        <form class="form" action="envoieforma.php" method="post" enctype="multipart/form-data">
        <h2>POUR AJOUTER UNE FORMATION</h2>
        <label for="nomforma">Nom de la formation :</label><br/>
        <input type="text" id="nomforma" name="nomforma" placeholder="Nom de la formation" require autofocus>
        <label for="niveau">Niveau de la formation :</label><br/>
        <select name="niveau">
            <option value="Débutant">Débutant</option>
            <option value="Intermédiaire">Intermédiaire</option>
            <option value="Avancé">Avancé</option>
        </select>
        <label for="theme">Thème de la formation :</label><br/>
        <select name="theme">
        <?php
        $dbh = new PDO("mysql:host=localhost;dbname=gestionformation;charset=utf8", "root", "root", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $stmt = $dbh->query("SELECT * FROM theme");
              while ($result=$stmt->fetch())
              {
                  echo '<option value="'.$result['IdTheme'].'">'.$result['NomTheme'].'</option>';
              }
        ?>
        </select>
        <label for="pdfforma">Plaquette pdf de la formation :</label><br/>
        <input type="file" name="pdfforma">
        <button type="submit">Envoyer</button>
        <button type="reset">Annuler</button>
        <br/><br/><br/>
        </form>

        <div id="liste">
        <h2>LISTE DES FORMATIONS</h2>
        <table>
              <thead><th>Nom de la formation</th><th>Fichier</th><th>Niveau</th><th>Thème</th></thead>
              <?php
                $dbh = new PDO("mysql:host=localhost;dbname=gestionformation;charset=utf8", "root", "root", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                $stmt2 = $dbh->query("SELECT * FROM formation F inner join theme T on F.IdTheme=T.IdTheme");
              while ($result2=$stmt2->fetch())
              {
                  echo '<tr><td>'.$result2['Descriptif'].'</td><td>'.$result2['NomFichier'].'</td><td>'.$result2['Niveau'].'</td><td>'.$result2['NomTheme'].'</td><td id="zoneedit"><a href="suppformation.php?id='.$result2['IdFormation'].'#liste"><i id="delete" class="fas fa-trash-alt"></i></a> <a href="pannel.php?id='.$result2['IdFormation'].'#edition"><i id="edit" class="fas fa-pen"></i></a> </td></tr>';
              }
        ?>
        </table>
        </div>

        <div id="edition">
        <?php
        if (!empty($_GET['id'])) {
              $stmt3 = $dbh->query('SELECT * FROM formation F inner join theme T on F.IdTheme=T.IdTheme where IdFormation='.$_GET['id']);
              $result3=$stmt3->fetch();
            echo '
            <form class="form" action="editformation.php?id='.$_GET['id'].'" method="post" enctype="multipart/form-data">
                <h2>POUR MODIFIER UNE FORMATION</h2>
                <label for="nomforma">Nom de la formation :</label><br/>
                <input type="text" id="nomforma" name="nomforma" placeholder="Nom de la formation" value="'.$result3['Descriptif'].'" require>
                <label for="niveau">Niveau de la formation :</label><br/>
                <select name="niveau">
                    <option value="Débutant" ';       if ($result3['Niveau']=="Débutant") echo 'SELECTED';                 echo ' >Débutant</option>
                    <option value="Intermédiaire" ';       if ($result3['Niveau']=="Intermédiaire") echo 'SELECTED';                 echo ' >Intermédiaire</option>
                    <option value="Avancé" ';       if ($result3['Niveau']=="Avancé") echo 'SELECTED';                 echo ' >Avancé</option>
                </select>
                <label for="theme">Thème de la formation :</label><br/>
                <select name="theme">';
                $stmt = $dbh->query("SELECT * FROM theme");
                    while ($result=$stmt->fetch())
                    {
                        echo '<option value="'.$result['IdTheme'].'"';
                        if ($result3['NomTheme']==$result['NomTheme']) echo ' SELECTED';
                        echo'>'.$result['NomTheme'].'</option>';
                    }
                echo '
                </select>
                <label for="pdfforma">Plaquette pdf de la formation (remettre la plaquette systématiquement) :</label><br/>
                <input type="file" name="pdfforma">
                <button type="submit">Envoyer</button>
                <button type="reset">Annuler</button>
                <br/><br/><br/>
                </form>';
        }
        ?>
        </div>

        <?php include("footer.php"); ?>
    </body>
</html>