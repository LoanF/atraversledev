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
        <title>À travers le dev | Contact</title>
    </head>

    <body>
        <?php include("entete.php"); ?>
   
        <form class="form" action="envoie.php" method="post">
        <h2>POUR DÉMARRER UNE FORMATION</h2>
        <label for="nom">Nom complet :</label><br/>
        <input type="text" id="nom" name="nom" placeholder="Nom" require autofocus>
        <input type="text" id="prenom" name="prenom" placeholder="Prénom" require><br/>
        <label for="email">Email :</label><br/>
        <input type="email" id="email" name="email" placeholder="adresse@exemple.com" require><br/>
        <label for="theme">Formation désirée :</label><br/>
        <select name="theme">
        <?php
              $dbh = new PDO("mysql:host=localhost;dbname=gestionformation;charset=utf8", "root", "root", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
              $stmt = $dbh->query("SELECT * FROM theme");
              while ($result=$stmt->fetch())
              {
                  echo '<optgroup label="'.$result['NomTheme'].'">';
                  $stmt2 = $dbh->query('SELECT * FROM formation where IdTheme='.$result['IdTheme']);
                  while ($result2=$stmt2->fetch()){
                      echo '<option value="'. $result2['IdFormation'] .'">'.  $result2['Descriptif'] .'</option>';
                  }
                  echo '</optgroup>';
              }
        ?>
        </select><br/>
        <label for="commentaire">Commentaire :</label><br/>
        <textarea id="commentaire" name="commentaire" rows="4" cols="50" placeholder="Dites nous en plus !"></textarea><br/>
        <button type="submit">Envoyer</button>
        <button type="reset">Annuler</button>
        <br/><br/><br/>
        <div class="contact">
        <span class="fas fa-phone-alt"></span> 07 77 76 09 35
        <span class="fas fa-envelope"></span> loanfrancois1@gmail.com
        </div>
        </form>

        <?php include("footer.php"); ?>
    </body>
</html>