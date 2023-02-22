<?php 
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
                <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
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
                        ?> <p>Vous n'êtes suivis par personne</p> <?php
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
            <main class='contacts'>
                <article></article>
            </main>
        </div>
    </body>
</html>
