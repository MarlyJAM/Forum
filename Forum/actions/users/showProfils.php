<?php
require('actions/database.php');

if (isset($_GET['id']) AND !empty($_GET['id'])) {

    $idOfUser=$_GET['id'];

    $checkIfUserExists = $bdd->prepare('SELECT * FROM users WHERE id=? ');
    $checkIfUserExists->execute(array($idOfUser));

    
    if ($checkIfUserExists->rowCount()>0) {

           $userInfos=$checkIfUserExists->fetch();

           $users_pseudo=$userInfos['pseudo'];
           $users_name=$userInfos['lastname'];
           
           $getThisQuestions= $bdd->prepare('SELECT * FROM questions WHERE id_author= ?  ORDER BY id DESC' );

           $getThisQuestions->execute(array($idOfUser));

   } else {
    
    $errorMsg="Aucun utilisateur n'a été trouvé";
    
   }
   


} else {
    $errorMsg='Aucun utilisateur trouvé';
}
