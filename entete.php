    <img src="img/bannieredev.png"/>
<nav id="menu">
        <ul>
            <li><a href="index.php" <?php if ($_SERVER['SCRIPT_NAME'] == '/site/index.php') echo 'class="active"'; ?>>Accueil</a></li>
            <li><a href="formation.php" <?php if ($_SERVER['SCRIPT_NAME'] == '/site/formation.php') echo 'class="active"'; ?>>Formations</a></li>
            <li><a href="contact.php" <?php if ($_SERVER['SCRIPT_NAME'] == '/site/contact.php') echo 'class="active"'; ?>>Contact</a></li>
            <li id="panel"><a href="panel.php" <?php if ($_SERVER['SCRIPT_NAME'] == '/site/panel.php') echo 'class="active"'; ?>>Panel</a></li>
        </ul>
</nav>