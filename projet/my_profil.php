<?php 
    session_start();
    include 'header.php';
?>  
    <body>
        <div id="wrapper">
            <?php 
                $userId = intval($_GET['user_id']);
                $infoUserSQL = "SELECT * FROM users WHERE users.id = $userId";
                $infoUser = $mysqli->query($infoUserSQL);
                $infoUser = $infoUser->fetch_assoc();
            ?>
            <aside>
                <img src="userNotConnected.png" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3><?= $infoUser['alias'] ?></h3>
                    <p><?= $infoUser['email'] ?></p>
                </section>
                <!--  Abonnements du profil --->
                <p style="text-decoration: underline">Abonnement :</p>
                <?php
                $laQuestionEnSql = "
                    SELECT users.* 
                    FROM followers 
                    LEFT JOIN users ON users.id=followers.followed_user_id 
                    WHERE followers.following_user_id ='$userId'
                    GROUP BY users.id
                    ";
                    $lesInformations = $mysqli->query($laQuestionEnSql);
                    $num_rows = mysqli_num_rows($lesInformations);
                    if($num_rows == 0) {
                        ?> <p>Vous ne suivez personne</p> <?php
                    } else {
                        ?> <div style="display: flex; flex-direction: row;"> <?php
                        foreach($lesInformations as $row) {
                            ?> <p><?= $row['alias'] ?>&nbsp;</p> <?php
                        }
                        ?> </div> <?php
                    }
                ?>

                <!-- Abonnés du profil -->
                <p style="text-decoration: underline">Les Abonnés :</p>
                <?php 
                $userId = intval($_GET['user_id']); 

                $laQuestionEnSql = "
                    SELECT users.*
                    FROM followers
                    LEFT JOIN users ON users.id=followers.following_user_id
                    WHERE followers.followed_user_id='$userId'
                    GROUP BY users.id
                    ";

                $lesInformations = $mysqli->query($laQuestionEnSql);
                $num_rows = mysqli_num_rows($lesInformations);
                if($num_rows == 0) {
                    ?> <p>Vous n'êtes suivis par personne</p> <?php
                } else {
                    ?> <div style="display: flex; flex-direction: row"> <?php
                    foreach($lesInformations as $row) {
                        ?> <p><?= $row['alias'] ?>&nbsp;</p> <?php
                    }
                    ?> </div> <?php
                }
                ?> 
            </aside>

            <main>
                <h1> Ma ludothèque </h1>
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
        WHERE id_user = '$idUser';
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
    <p> Vous n'avez pas encore de jeu dans votre ludothèque.</p>
    <?php
    }
    ?>
            </main>

        </div>
    </body>
</html>
