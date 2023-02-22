<?php include 'header.php' ?>
<body>   
    <div id="wrapper">
        <main>
            <?php
            if (isset($_POST['submit-search'])){
                $search = mysqli_real_escape_string($mysqli, $_POST['search']);
                $sql ="SELECT * FROM boardgames WHERE name LIKE '%$search%' OR type 
                    LIKE '%$search%' OR description LIKE '%$search%' OR creator LIKE '%$search%'";
                $result = mysqli_query($mysqli,$sql);
                $queryResult = mysqli_num_rows($result);

                if ($queryResult > 0){
                    echo "Resultats de votre recherche :" ;
                   while ($row = mysqli_fetch_assoc($result))
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
                   }
                }else {
                    echo "Pas de résultat pour votre recherche !";
                }        
            }
            ?>
       
    </main>
    </div>
</body>
</html>