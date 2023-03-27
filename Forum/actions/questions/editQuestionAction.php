<?php

require('actions/database.php');

//Validation du formulaire
if(isset($_POST['validate'])){

    //Vérifier si les champs sont remplis
    if(!empty($_POST['title']) AND !empty($_POST['description']) AND !empty($_POST['content'])){

        //Les données à faire passer dans la requête
        $new_question_title = htmlspecialchars($_POST['title']);
        $new_question_description = nl2br(htmlspecialchars($_POST['description']));
        $new_question_content = nl2br(htmlspecialchars($_POST['content']));
        
        //Modifier les informations de la question qui possède l'id rentré en paramètre dans l'URL
        $editQuestionOnWebsite = $bdd->prepare('UPDATE questions SET title = :title, description = :description, content = :content WHERE id = :id');
        
        $editQuestionOnWebsite->execute(['title'=>$new_question_title, 'description'=>$new_question_description,'content'=> $new_question_content,'id'=> $idOfQuestion]);
        //Redirection vers la page d'affichage des questions de l'utilisateur
        header('Location: my-questions.php');
        exit();

    }else{
        $errorMsg = "Veuillez compléter tous les champs...";
    }

}