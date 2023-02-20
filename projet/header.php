<?php 
        session_start();
        if(!isset($_SESSION['connected_id'])) {
           header("Location:connexion.php");
        }
?>
<header>
        <a href='admin.php'><img src="newLogo.png" alt="Logo de notre réseau social"/></a>
        <nav id="menu">
                <a href="news.php">Actualités</a>
                <a href="discover.php">Découvrir</a>
        </nav>
        <nav id="user">
                <a href="#">▾ Profil</a>
                <ul>
                        <li><a href="settings.php?user_id=<?php echo $_SESSION['connected_id'] ?>">Paramètres</a></li>
                        <li><a href="my_profil.php?user_id=<?php echo $_SESSION['connected_id'] ?>">Mon Profil</a></li>
                        <li><a href="deconnexion.php">Déconnexion</a></li>
                </ul>
        </nav>
</header>
