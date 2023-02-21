<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Gweet - Mon Profil</title> 
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
                    <p><?= $infoUser['email'] ?></p>
                </section>
                <?php
                $laQuestionEnSql = "
                    SELECT users.* 
                    FROM followers 
                    LEFT JOIN users ON users.id=followers.followed_user_id 
                    WHERE followers.following_user_id ='$userId'
                    GROUP BY users.id
                    ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                while($user = $lesInformations->fetch_assoc()) {
                ?> 
                    <p><?= $user['alias'] ?></p>
                <?php
                }
                ?>
            </aside>
            <main class='contacts'>
                <article></article>
            </main>
        </div>
    </body>
</html>
