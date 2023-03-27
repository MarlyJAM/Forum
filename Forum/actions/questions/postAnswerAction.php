<?php
require('actions/database.php');


if (isset($_POST['validate'])) {
    if (!empty($_POST['answer'])) {  
        
        
        $user_answer = nl2br(htmlspecialchars($_POST['answer']));

        
        $insertAnswer= $bdd-> prepare('INSERT INTO `answers`( `id_author`, `pseuso_author`, `id_question`, `contents`) VALUES (?,?,?,?)' );
        
        
        $insertAnswer->execute(array(   $_SESSION['id']   ,$_SESSION['pseudo']    , $idOfTheQuestion, $user_answer));

        $errorMsg="Réponse postée";
    }else {
        $errorMsg="Completez ce champ";
    }
}
