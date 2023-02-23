<?php 
    session_start();
    include 'header.php';
?>
<?php
    if (!empty($_POST['submit-like']))
    {
        $userId = $_SESSION['connected_id'];
        $gameLikedId= intval($_POST['submit-like']);
        $userId = intval($mysqli->real_escape_string($userId));
        $gameLikedId = intval($mysqli->real_escape_string($gameLikedId));
        $check=mysqli_query($mysqli,"select * from users_boardgames where id_user='$userId' and id_boardgame ='$gameLikedId'");
        $checkrows=mysqli_num_rows($check);
       if($checkrows>0) {
          echo "Déjà liké !";
       } else {  
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
}
?>                   