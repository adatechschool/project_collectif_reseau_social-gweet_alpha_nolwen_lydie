<?php 
    session_start();
    include 'header.php';
?>    
    <body>   
        <div id="wrapper">
            <aside>
                <section class= 'sectionActualités'>
                    <h3>Découvrir</h3>
                    <p>Ajoutez à votre ludothèque les différents jeux présents sur cette page. </p>
                </section>
            </aside>
            <main>
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
        ?> 
    <?php    
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
                <p id='footerTheme'>Type: <i><?= $game['type'] ?></i></p>
                <form action="addToLudotheque.php" method="POST">
                    <button type="submit" name="submit-like" value=<?=$game['id']?> >♥</button>
                </form>             
            </footer>
        </article>
        <?php
    }
    ?>
</main>
        </div>
    </body>
</html>
