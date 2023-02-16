<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Actualités</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <?php
        include 'header.php';
        ?>
        <div id="wrapper">
            <aside>
                <section>
                    <h3>Bienvenue !</h3>
                    <p>Ajoute à ta ludothèque les différents jeux présents sur cette page. </p>
                    <form method="post">
                        <input type="text" name="search" placeholder="Search..." required>
                        <input type="submit" value="Search">
                    </form>
                  <!--   <script>
                        function jumpTo(){
                            let gameToSearch = document.getElementById("word").value
                            console.log(gameToSearch)
                            document.getElementById(gameToSearch).scrollIntoView();}
                    </script> -->
                </section>
            </aside>
            <main>
                <?php
                /*
                  // C'est ici que le travail PHP commence
                  // Votre mission si vous l'acceptez est de chercher dans la base
                  // de données la liste des 5 derniers messsages (posts) et
                  // de l'afficher
                  // Documentation : les exemples https://www.php.net/manual/fr/mysqli.query.php
                  // plus généralement : https://www.php.net/manual/fr/mysqli.query.php
                 */

                // Etape 1: Ouvrir une connexion avec la base de donnée.
                //verification
                if ($mysqli->connect_errno)
                {
                    echo "<article>";
                    echo("Échec de la connexion : " . $mysqli->connect_error);
                    echo("<p>Indice: Vérifiez les parametres de <code>new mysqli(...</code></p>");
                    echo "</article>";
                    exit();
                }

                // Etape 2: Poser une question à la base de donnée et récupérer ses informations
                // cette requete vous est donnée, elle est complexe mais correcte, 
                // si vous ne la comprenez pas c'est normal, passez, on y reviendra
                $laQuestionEnSql = "
                    SELECT * FROM boardgames 
                    ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                // Vérification
                if ( ! $lesInformations)
                {
                    echo "<article>";
                    echo("Échec de la requete : " . $mysqli->error);
                    echo("<p>Indice: Vérifiez la requete  SQL suivante dans phpmyadmin<code>$laQuestionEnSql</code></p>");
                    exit();
                }

                // Etape 3: Parcourir ces données et les ranger bien comme il faut dans du html
                // NB: à chaque tour du while, la variable post ci dessous reçois les informations du post suivant.
                while ($game = $lesInformations->fetch_assoc())
                {?>
                    <article id = "<?= $game['name'] ?>">
                        <section id='articleJeux'>
                            <div>
                                <h1><?= $game['name'] ?></h1>
                                <small>Créateur•ice : <?= $game['creator'] ?></small>
                                <p><strong>Age minimum : <?= $game['min_age'] ?> ans • Nombre de joueur•euse•s : <?= $game['min_players'] ?> - <?= $game['max_players'] ?> • Durée d'une partie : <?= $game['duration'] ?> minutes </strong></p> 
                                <br>
                                <p><?= $game['description'] ?></p>
                            </div>
                            <br>
                            <div>
                                <img alt= "Image du jeu <?= $game['name'] ?>" height="300" src = <?= $game['images'] ?>></img>
                            </div>
                        </section>
                        <footer>
                            <small>♥ <?php echo $post['like_number'] ?> </small>
                            
                                <p>Type: <i><?= $game['type'] ?></i></p>
                            
                        </footer>
                    </article>
                    <?php
                }
                ?>
            </main>
        </div>
    </body>
</html>
