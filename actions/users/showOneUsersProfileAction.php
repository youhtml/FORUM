<?php

require('actions/database.php');


//Recuperer l'identifiant de l'utilisateur
if(isset($_GET['id']) AND !empty($_GET['id'])){

    //l'id de l'utilisateur
    $idOfUser = $_GET['id'];

    //Verifie si l'utilisateur existe
    $checkIfUserExists = $bdd->prepare('SELECT pseudo, nom, prenom FROM users WHERE id = ?');
    $checkIfUserExists->execute(array($idOfUser));


    if($checkIfUserExists->rowCount() > 0){

        // recuperer les infos de l'utilisateur  
        $usersInfos = $checkIfUserExists->fetch();
        
        $user_pseudo = $usersInfos['pseudo'];
        $user_lastname = $usersInfos['nom'];
        $user_firstname = $usersInfos['prenom'];

        //Recuperer toutes les questions publiées par l'utilisateur
        $getHisQuestions = $bdd->prepare('SELECT * FROM questions WHERE id_auteur = ? ORDER BY id DESC');
        $getHisQuestions->execute(array($idOfUser));



    }else{

        $errorMsg = "Aucun utilisateur n'a été trouvé";

    }

}else{

    $errorMsg = "Aucun utilisateur trouvé";
}