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
                <p>Abonnés :</p>
                <?php
                $laQuestionEnSql = "
                    SELECT users.* 
                    FROM followers 
                    LEFT JOIN users ON users.id=followers.followed_user_id 
                    WHERE followers.following_user_id ='$userId'
                    GROUP BY users.id
                    ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                $user = $lesInformations->fetch_assoc();
                if($user == NULL) {
                    echo "<p>Vous n'êtes suivis par personne</p>";
                }
                while($user) {
                ?> 
                    <p><?= $user['alias'] ?></p>
                <?php
                $user = $lesInformations->fetch_assoc();
                }
                ?>
            </aside>
            <main class='contacts'>
                <article></article>
            </main>
        </div>
    </body>
</html>
