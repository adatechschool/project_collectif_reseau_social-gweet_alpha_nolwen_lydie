<?php
        include 'header.php';
        ?>
    </head>
    <body>
        <div id="wrapper">
            <?php
            /**
             * Etape 1: Le mur concerne un utilisateur en particulier
             * La première étape est donc de trouver quel est l'id de l'utilisateur
             * Celui ci est indiqué en parametre GET de la page sous la forme user_id=...
             * Documentation : https://www.php.net/manual/fr/reserved.variables.get.php
             * ... mais en résumé c'est une manière de passer des informations à la page en ajoutant des choses dans l'url
             */
            $userId =intval($_GET['user_id']);
            ?>
            <?php
            /**
             * Etape 2: se connecter à la base de donnée
             */
            ?>

            <aside>
                <?php
                /**
                 * Etape 3: récupérer le nom de l'utilisateur
                 */                
                $laQuestionEnSql = "SELECT * FROM users WHERE id= '$userId' ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                $user = $lesInformations->fetch_assoc();
                //@todo: afficher le résultat de la ligne ci dessous, remplacer XXX par l'alias et effacer la ligne ci-dessous
               // echo "<pre>" . print_r($user, 1) . "</pre>";
                ?>
                <section id="pseudoWall">
                    <img src="userNotConnected.png" alt="Portrait de l'utilisatrice"/>
                    <h3 ><?php echo $user['alias'] ?></h3>
                </section>
            </aside>
            <main>
            <section id = 'articleWall'>
                <h2> Articles </h2>
                <?php
                /**
                 * Etape 3: récupérer tous les messages de l'utilisatrice
                 */
                $laQuestionEnSql = "
                    SELECT posts.content, posts.created, users.alias as author_name, posts.id,
                    COUNT(likes.id) as like_number, GROUP_CONCAT(DISTINCT tags.label) AS taglist 
                    FROM posts
                    JOIN users ON  users.id=posts.user_id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                    LEFT JOIN likes      ON likes.post_id  = posts.id 
                    WHERE posts.user_id='$userId' 
                    GROUP BY posts.id
                    ORDER BY posts.created DESC  
                    ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                $queryResult =mysqli_num_rows($lesInformations);
                if ( ! $lesInformations)
                {
                    echo("Échec de la requete : " . $mysqli->error);
                }
                /**
                 * Etape 4: @todo Parcourir les messages et remplir correctement le HTML avec les bonnes valeurs php
                 */
                if ($queryResult >0){
                while ($post = $lesInformations->fetch_assoc())
                {
                    ?>                
                    <article>
                        <h3>
                            <time><?= $post['created'] ?></time>
                        </h3>
                        <address>De : <?= $post['author_name'] ?></address>
                        <div>
                            <p><?= $post['content'] ?></p>
                            
                        </div>                                            
                        <footer>
                            <form action="news.php" method="POST"> 
                                <button type="submit" name="liked" value=<?=$post['id']?>>♥</button>
                                <label><?=$post['like_number']?></label>
                            </form>
                        </footer>
                    </article>
                <?php }}else {
                            ?>
                            <p> L'utilisatrice n'a pas encore publié d'article !</p>
                            <?php 
                            }
                            ?> 
            </section>
            <section id = 'ludothequeWall'>
                <h2> Ludothèque </h2>
                <?php
                    // Etape 1: Ouvrir une connexion avec la base de donnée.
                    if ($mysqli->connect_errno)
                    {
                        echo "<article>";
                        echo("Échec de la connexion : " . $mysqli->connect_error);
                        echo("<p>Indice: Vérifiez les parametres de <code>new mysqli(...</code></p>");
                        echo "</article>";
                        exit();
                    }

                    // Etape 2: Poser une question à la base de donnée et récupérer ses informations
                    $idUser = $_SESSION['connected_id'];
                    $laQuestionEnSql = "
                        SELECT * FROM users_boardgames 
                        INNER JOIN boardgames ON users_boardgames.id_boardgame = boardgames.id
                        WHERE id_user = '$userId';
                        ";
                
                    $lesInformations = $mysqli->query($laQuestionEnSql);
                    $queryResult =mysqli_num_rows($lesInformations);
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
                        ?> 
                        <?php    
                        if ($queryResult >0){
                        while ($game = $lesInformations->fetch_assoc())
                        {
                            ?>
                            <article>
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
                                    <form action="addToLudotheque.php" method="POST">
                                        <button type="submit" name="submit-like" value=<?=$game['id']?> >♥</button>
                                    </form>
                                    
                                        <p>Type: <i><?= $game['type'] ?></i></p>
                                </footer>
                            </article>
                            <?php
                        }}else {
                            ?>
                            <p> L'utilisatrice n'a pas encore de jeu dans sa ludothèque !</p>
                            <?php 
                            }
                            ?>
                                </section>
                                </main>
                            </div>
                        </body>
                    </html>


