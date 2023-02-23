<?php
        include 'header.php';
        if(!isset($_SESSION['admin'])) {
            header("Location:news.php");
        }
?>
    </head>
    <body>
        <?php
        /**
         * Etape 1: Ouvrir une connexion avec la base de donnée.
         */
        // on va en avoir besoin pour la suite
        //verification
        if ($mysqli->connect_errno)
        {
            echo("Échec de la connexion : " . $mysqli->connect_error);
            exit();
        }
        ?>
        <div id="wrapper" >
            <aside>
                <h2>Espace de gestion de comptes pour administrateur.ice</h2>
            </aside>
            <main>
                <h2>Utilisatrices</h2>
                <?php
                /*
                 * Etape 4 : trouver tous les mots clés
                 * PS: on note que la connexion $mysqli à la base a été faite, pas besoin de la refaire.
                 */
                $laQuestionEnSql = "SELECT * FROM `users` LIMIT 50";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                // Vérification
                if ( ! $lesInformations)
                {
                    echo("Échec de la requete : " . $mysqli->error);
                    exit();
                }

                /*
                 * Etape 5 : @todo : Afficher les utilisatrices en s'inspirant de ce qui a été fait dans news.php
                 * Attention à en pas oublier de modifier dans le lien les "user_id=123" avec l'id de l'utilisatrice
                 */
                while ($tag = $lesInformations->fetch_assoc())
                {
                    ?>
                    <article>
                        <h3><?= $tag["alias"] ?></h3>
                        <p><?= "<p> id: ".$tag['id']."</p>"?></p><br>
                        <p><?= $tag['email'] ?></p>
                        <nav>
                            <a href="wall.php?user_id=<?= $tag['id'] ?>">Mur</a>
                            | <a href="feed.php?user_id=<?= $tag['id'] ?>">Flux</a>
                            | <a href="settings.php?user_id=<?= $tag['id'] ?>">Paramètres</a>
                            | <a href="followers.php?user_id=<?= $tag['id'] ?>">Suiveurs</a>
                            | <a href="subscriptions.php?user_id=<?= $tag['id'] ?>">Abonnements</a>
                        </nav>
                    </article>
                <?php } ?>
            </main>
        </div>
    </body>
</html>
