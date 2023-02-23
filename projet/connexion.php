<?php 
    session_start();
    if(isset($_SESSION['connected_id'])) {
        header("Location: news.php");
    }
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Gweet - Connexion</title> 
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <?php 
            include 'db.php';
        ?>
        <div id="wrapper" >
            <aside>
                <h2>Présentation</h2>
                <p>Bienvenue sur Gweet</p>
            </aside>
            <main>
                <article>
                    <h2>Connexion</h2>
                    <?php
                    $enCoursDeTraitement = isset($_POST['email']);
                    if ($enCoursDeTraitement)
                    {
                        $emailAVerifier = $_POST['email'];
                        $passwdAVerifier = $_POST['motpasse'];

                        //Etape 4 : Petite sécurité
                        // pour éviter les injection sql : https://www.w3schools.com/sql/sql_injection.asp
                        $emailAVerifier = $mysqli->real_escape_string($emailAVerifier);
                        $passwdAVerifier = $mysqli->real_escape_string($passwdAVerifier);
                        // on crypte le mot de passe pour éviter d'exposer notre utilisatrice en cas d'intrusion dans nos systèmes
                        $passwdAVerifier = md5($passwdAVerifier);
                        // NB: md5 est pédagogique mais n'est pas recommandée pour une vraies sécurité
                        //Etape 5 : construction de la requete
                        $lInstructionSql = "SELECT * "
                                . "FROM users "
                                . "WHERE "
                                . "email LIKE '" . $emailAVerifier . "'";
                        // Etape 6: Vérification de l'utilisateur
                        $res = $mysqli->query($lInstructionSql);
                        $user = $res->fetch_assoc();
                        if (! $user OR $user["password"] != $passwdAVerifier)
                        {
                            echo "La connexion a échouée. ";
                            
                        } else
                        {
                            $_SESSION['connected_id'] = $user['id'];
                            header("Location: discover.php");
                        }
                    }
                    ?>                     
                    <form action="connexion.php" method="post">
                        <dl>
                            <dt><label for='email'>E-Mail</label></dt>
                            <dd><input type='email'name='email'></dd>
                            <dt><label for='motpasse'>Mot de passe</label></dt>
                            <dd><input type='password'name='motpasse'></dd>
                        </dl>
                        <input type='submit'>
                    </form>
                    <p>
                        Pas de compte?
                        <a href='inscription.php'>Inscrivez-vous.</a>
                    </p>
                </article>
            </main>
        </div>
    </body>
</html>
