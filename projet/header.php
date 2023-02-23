<?php
        if(!isset($_SESSION['connected_id'])) {
         header("Location: connexion.php");
        }
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
  <?php
                if(isset($_SESSION['admin'])) {
                        ?>
                        <a href='admin.php'><img src="newLogo.png" alt="Logo de notre réseau social"/></a>
                <?php } else {
                        ?> 
                        <img src="newLogo.png" alt="Logo de notre réseau social"/>
                        <?php
                }
                ?>
                <nav id="menu">
                        <a href="news.php">Actualités</a>
                        <a href="discover.php">Découvrir</a>
                        <form id="searchform" action="searchbar.php" method="POST">
                                <input size=40 type ='text' name ="search" placeholder="Search user, article or game"/>
                                <button type="submit" name="submit-search">Search</button>
                        </form>
                </nav>
                <nav id="user">
                        <a href="#">▾ Profil</a>
                        <ul>
                                <li><a href="my_profil.php?user_id=<?php echo $_SESSION['connected_id'] ?>">Ma ludothèque</a></li>
                                <li><a href="deconnexion.php">Déconnexion</a></li>
                        </ul>
                </nav>
        </header>
