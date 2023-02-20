<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Mes abonnements</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <?php
        include "db.php";
        include 'header.php';
        ?>
        <div id="wrapper">
            <?php 
                $userId = intval($_GET['user_id']);
                $infoUserSQL = "SELECT * FROM users WHERE users.id = $userId";
                $infoUser = $mysqli->query($infoUserSQL);
                $infoUser = $infoUser->fetch_assoc();
            ?>
            <aside>
                <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3><?= $infoUser['alias'] ?></h3>
                    <p>Sur cette page vous trouverez la liste des personnes dont
                        l'utilisatrice
                        n° <?= intval($_GET['user_id']) ?>
                        suit les messages
                    </p>

                </section>
            </aside>
            <main class='contacts'>
                <?php
                $laQuestionEnSql = "
                    SELECT users.* 
                    FROM followers 
                    LEFT JOIN users ON users.id=followers.followed_user_id 
                    WHERE followers.following_user_id='$userId'
                    GROUP BY users.id
                    ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                // Etape 4: à vous de jouer
                while($user = $lesInformations->fetch_assoc()) {
                ?>
                <article>
                    <img src="user.jpg" alt="blason"/>
                    <h3><?= $user['alias'] ?></h3>
                    <p> id : <?= $user['id'] ?></p>                    
                </article>
                <?php 
                }
                ?>
            </main>
        </div>
    </body>
</html>
