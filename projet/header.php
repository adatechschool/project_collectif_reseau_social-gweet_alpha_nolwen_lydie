<?php
        session_start() ;
        include 'db.php';       
?>
<!doctype html>
        <html lang="fr">
                <head>
                        <meta charset="utf-8">
                        <title>Gweet</title> 
                        <link rel="stylesheet" href="style.css"/>
                        <link rel="icon" type="image/png" sizes="16x16"  href="/favicons/favicon-16x16.png">
                        <meta name="msapplication-TileColor" content="#ffffff">
                        <meta name="theme-color" content="#ffffff">
                </head>
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
                                <li><a href="followers.php?user_id=<?php echo $_SESSION['connected_id'] ?>">Mes suiveurs</a></li>
                                <li><a href="subscriptions.php?user_id=<?php echo $_SESSION['connected_id'] ?>">Mes abonnements</a></li>
                                <li><a href="deconnexion.php">Déconnexion</a></li>
                        </ul>
                </nav>
        </header>
