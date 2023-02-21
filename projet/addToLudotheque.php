<?php 
    include 'header.php';
?>
<?php
    if (!empty($_POST['submit-like']))
    {
        $userId = $_SESSION['connected_id'];
        $gameLikedId= intval($_POST['submit-like']);
        /*  echo $gameLikedId; */
        $userId = intval($mysqli->real_escape_string($userId));
        $gameLikedId = intval($mysqli->real_escape_string($gameLikedId));
        $lInstructionSql = "INSERT INTO users_boardgames "
                                . "(id_user,id_boardgame) "
                                . "VALUES ("
                                . $userId . ", "
                                . $gameLikedId .");" ;
            $ok = $mysqli->query($lInstructionSql);
            if ( ! $ok)
            {
                echo "Impossible d'ajouter le jeu :  " . $mysqli->error;
            } else
            {
                echo "Jeu ajouté !";
            }
    }
?>                   