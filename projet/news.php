<?php 
    include 'header.php';
?>   
    <body>                   
        <div id="wrapper">
            <aside>
                <section class= 'sectionActualités'>
                    <h3>Actualités</h3>
                    <p>Sur cette page vous trouverez les derniers messages de
                        tous les utilisatrices du site.</p>         
                </section>
            </aside>
            <main>
            <article>
                    <h2>Poster un article</h2>
                    <?php
                    if (!empty($_POST['message']))
                    {
                        $authorId = $_SESSION['connected_id'];
                        $postContent = $_POST['message'];
                        $authorId = intval($mysqli->real_escape_string($authorId));
                        $postContent = $mysqli->real_escape_string($postContent);
                        $check=mysqli_query($mysqli,"select * from posts where content='$postContent'");
                        $checkrows=mysqli_num_rows($check);
                    
                       if($checkrows>0) {
                          echo "Déjà posté !";
                       } else {  
                        $lInstructionSql = "INSERT IGNORE INTO posts "
                                . "(id, user_id, content, created) "
                                . "VALUES (NULL, "
                                . $authorId . ", "
                                . "'" . $postContent . "', "
                                . "NOW());"
                                ;
                        $ok = $mysqli->query($lInstructionSql);
                        if ( ! $ok )
                        {
                            echo "Impossible d'ajouter le message: " . $mysqli->error;
                        } else
                        {
                            echo "Message posté !";
                        }
                    }
                }
                    ?>                     
                    <form class='formArticle' action="news.php" method="post">
                        <dl>
                            <dd><textarea name='message'></textarea></dd>
                        </dl>
                        <input type='submit'>
                    </form>               
                </article>
                <?php
                    if (!empty($_POST['liked']))
                    {
                        $userId = $_SESSION['connected_id'];
                        $articleLikedId= intval($_POST['liked']);
                        $userId = intval($mysqli->real_escape_string($userId));
                        $articleLikedId = intval($mysqli->real_escape_string($articleLikedId));
                        $lInstructionSql = "INSERT INTO likes "
                                                . "(user_id,post_id) "
                                                . "VALUES ("
                                                . $userId . ", "
                                                . $articleLikedId .");" ;
                            $ok = $mysqli->query($lInstructionSql);
/*                             if ( ! $ok)
                            {
                                echo "Impossible de liker cet article :  " . $mysqli->error;
                            } else
                            {
                                echo "liké !";
                            } */
                    }
                ?>  
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
                    SELECT posts.content,
                    posts.id,
                    posts.created,
                    users.alias as author_name,  
                    count(likes.id) as like_number,  
                    GROUP_CONCAT(DISTINCT tags.label) AS taglist 
                    FROM posts
                    JOIN users ON  users.id=posts.user_id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                    LEFT JOIN likes      ON likes.post_id  = posts.id 
                    GROUP BY posts.id
                    ORDER BY posts.created DESC  
                    LIMIT 5
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
                while ($post = $lesInformations->fetch_assoc())
                {
                    //la ligne ci-dessous doit etre supprimée mais regardez ce 
                    //qu'elle affiche avant pour comprendre comment sont organisées les information dans votre 
                    //echo "<pre>" . print_r($post, 1) . "</pre>";

                    // @todo : Votre mission c'est de remplacer les AREMPLACER par les bonnes valeurs
                    // ci-dessous par les bonnes valeurs cachées dans la variable $post 
                    // on vous met le pied à l'étrier avec created 
                    // 
                    // avec le ? > ci-dessous on sort du mode php et on écrit du html comme on veut... mais en restant dans la boucle
                    ?>
                    <article>
                        <h3>
                            <time><i><?php echo $post['created'] ?></i></time>
                        </h3>
                        <p> <i> id post : <?php echo $post['id'] ?></i></p>
                        <br>
                        <div>
                        <p><?php echo $post['content'] ?></p>
                        </div>
                        <div>
                            <p> <i>De : <?php echo $post['author_name'] ?></i></p>
                        </div>
                        <footer>
                            <form action="news.php" method="POST"> 
                                <button type="submit" name="liked" value=<?=$post['id']?>>♥</button>
                                <label><?=$post['like_number']?></label>
                            </form>
                             <!--    $word = explode(",", $post['taglist']);
                                for($i = 0; $i < sizeof($word); $i++) {
                                  echo "<a href=''> #".$word[$i] ."</a>";
                               } -->
                        </footer>    
                    </article>
                    <?php
                    // avec le <?php ci-dessus on retourne en mode php 
                }// cette accolade ferme et termine la boucle while ouverte avant.
                ?>

            </main>
        </div>
    </body>
</html>
