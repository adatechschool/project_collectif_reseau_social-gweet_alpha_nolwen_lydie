<?php include 'header.php' ?>
<body>   
    <div id="wrapper">
        <main>
            <?php
            if (isset($_POST['submit-search'])){
                $search = mysqli_real_escape_string($mysqli, $_POST['search']);

                $sqlTabBoardgames ="SELECT * FROM boardgames 
                WHERE name LIKE '%$search%' 
                OR type LIKE '%$search%' 
                OR description LIKE '%$search%' 
                OR creator LIKE '%$search%' ";
                $resultTabBoardgames = mysqli_query($mysqli,$sqlTabBoardgames);
                $queryResultBoardgames =mysqli_num_rows($resultTabBoardgames);

                $sqlTabUsers ="SELECT * FROM users 
                WHERE alias LIKE '%$search%'";
                $resultTabUsers = mysqli_query($mysqli,$sqlTabUsers);
                $queryResultUsers = mysqli_num_rows($resultTabUsers);

                $sqlTabPosts ="SELECT * FROM posts 
                WHERE content LIKE '%$search%'";
                $resultTabPosts = mysqli_query($mysqli,$sqlTabPosts);
                $queryResultPosts = mysqli_num_rows($resultTabPosts);


                $queryResultAll = $queryResultBoardgames + $queryResultUsers + $queryResultPosts;

                if ($queryResultAll > 0){
                    ?>
                    <h1> Resultats de votre recherche : </h1>
                    <?php
                    if ($queryResultUsers > 0){
                        ?>
                            <h2> Users : </h2>
                        <?php
                        while ($row = mysqli_fetch_assoc($resultTabUsers))
                        { 
                        ?>
                        <article>
                            <h3> <a href="wall.php?user_id=<?= $row['id'] ?>"><?= $row['alias'] ?></a></h3>                    
                        </article>
                        <?php
                        }}
                    if ($queryResultBoardgames > 0){
                        ?>
                        <h2> Jeux : </h2>
                        <?php
                        while ($row = mysqli_fetch_assoc($resultTabBoardgames))
                        { 
                            ?>
                                <article>
                                <section id='articleJeux'>
                                    <div>
                                        <h1><?=$row['name']?></h1>
                                        <small>Créateur•ice : <?=$row['creator']?></small>
                                        <p><strong>Age minimum : <?=$row['min_age']?>ans • Nombre de joueur•euse•s : <?=$row['min_players']?> - <?=$row['max_players']?> • Durée d'une partie : <?=$row['duration']?>minutes </strong></p> 
                                        <br>
                                        <p><?=$row['description']?></p>
                                    </div>
                                    <br>
                                    <div>
                                        <img alt='Image du jeu<?=$row['name']?>' height='300' src = <?=$row['images']?>></img>
                                    </div>
                                </section>
                                <footer>
                                    <form action="addToLudotheque.php" method="POST">
                                        <button type="submit" name="submit-like" value=<?=$row['id']?> >♥</button>
                                    </form>
                                    <p>Type: <i><?=$row['type']?></i></p>  
                                </footer>
                            </article>
                            <?php
                        }}
                    if ($queryResultPosts > 0){
                        ?>
                        <h2> Articles : </h2>
                        <?php
                        while ($row = mysqli_fetch_assoc($resultTabPosts))
                        { 
                            ?> 
                                <article>
                                    <h3>
                                        <time><i><?= $row['created'] ?></i></time>
                                    </h3>
                                    <br>
                                    <div>
                                        <p><?= $row['content'] ?></p>
                                    </div>
                                    <div>
                                        <p> <i>De : <?= $row['author_name'] ?></i></p><!--  Faut aller chercher dans une autre table  -->
                                    </div>
                                    <footer>
                                    <small>♥</small>
                                    </footer>
                                </article>
                            <?php
                        }}
                }else {
                    echo "Pas de résultat pour votre recherche !";
                }        
            }
            ?>
       
    </main>
    </div>
</body>
</html>