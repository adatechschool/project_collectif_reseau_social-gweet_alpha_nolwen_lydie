<?php session_start() ?>
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
