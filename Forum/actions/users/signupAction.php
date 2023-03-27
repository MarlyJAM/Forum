<?php
session_start();
require('actions/database.php');

//Validation du formulaire
if(isset($_POST['validate'])){

    //Vérifier si l'user a bien complété tous les champs
    if(!empty($_POST['pseudo']) AND !empty($_POST['lastname']) AND !empty($_POST['mail']) AND !empty($_POST['password'])){
        
        //Les données de l'user
        $user_pseudo = htmlspecialchars($_POST['pseudo']);
        $user_lastname = htmlspecialchars($_POST['lastname']);
        $user_mail = htmlspecialchars($_POST['mail']);
        $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        //Vérifier si l'utilisateur existe déjà sur le site
        $checkIfUserAlreadyExists = $bdd->prepare('SELECT pseudo FROM users WHERE pseudo = ?');
        $checkIfUserAlreadyExists->execute(array($user_pseudo));

        if($checkIfUserAlreadyExists->rowCount() == 0){
            
            //Insérer l'utilisateur dans la bdd
            $insertUserOnWebsite = $bdd->prepare('INSERT INTO users(pseudo, lastname,mail , mdp) VALUES(:pseudo, :lastname, :mail, :mdp)');
            
            $insertUserOnWebsite->execute([
                'pseudo'=>$user_pseudo,
                'lastname'=> $user_lastname,
                'mail'=> $user_mail,
                'mdp'=> $user_password
            ]);
            //Récupérer les informations de l'utilisateur
            $getInfosOfThisUserReq = $bdd->prepare('SELECT id, pseudo, lastname, mail FROM users WHERE laststname= :lastname AND mail = :mail AND pseudo = :pseudo');
            $getInfosOfThisUserReq->execute([
                'pseudo'=>$user_pseudo,
                'lastname'=> $user_lastname,
                'mail'=> $user_mail
            ]);

            $usersInfos = $getInfosOfThisUserReq->fetch();

            //Authentifier l'utilisateur sur le site et récupérer ses données dans des variables globales sessions
            $_SESSION['auth'] = true;
            $_SESSION['id'] = $usersInfos['id'];
            $_SESSION['lastname'] = $usersInfos['lastname'];
            $_SESSION['mail'] = $usersInfos['mail'];
            $_SESSION['pseudo'] = $usersInfos['pseudo'];
            
            
            $errorMsg = "Vous venez de vous s'inscrire sur le site";


            //Rediriger l'utilisateur vers la page d'accueil
            header('Location: index.php');
            exit();

        }else{
            $errorMsg = "L'utilisateur existe déjà sur le site";
        }

    }else{
        $errorMsg = "Veuillez compléter tous les champs...";
    }

}