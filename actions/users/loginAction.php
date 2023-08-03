<?php
session_start();
require('actions/database.php');

//Validation du formulaire
if(isset($_POST['validate'])){

    //Verifier si l'utilasateur à bien completé tous les champs
    if(!empty($_POST['pseudo']) AND!empty($_POST['password'])){

        //Les données de l'user
        $user_pseudo = htmlspecialchars($_POST['pseudo']);
        $user_password = htmlspecialchars($_POST['password']);

        //Vérifier si l'utilisateur existe déjà (si le pseudo est correct)
        $checkIfUserExists = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
        $checkIfUserExists->execute(array($user_pseudo));

        if($checkIfUserExists->rowCount() > 0){

            //Recupérer les données de l'utilisateur
            $usersInfos = $checkIfUserExists->fetch();

            //Vérifier si le mot de passe est correct
            if(password_verify($user_password, $usersInfos['mdp'])){

                $_SESSION['auth'] = true;
                $_SESSION['id'] = $usersInfos['id'];
                $_SESSION['lastname'] = $usersInfos['nom'];
                $_SESSION['firstname'] = $usersInfos['prenom'];
                $_SESSION['pseudo'] = $usersInfos['pseudo'];

                //On redirige vers la page d'accueil
                header('Location: index.php');

            }else{

                $errorMsg = "Votre mot de passe est incorrect";
            }

        }else{

            $errorMsg = "Votre pseudo est incorrect";
        }

    }else{
        $errorMsg = "Veuillez remplir tous les champs";
    }
}