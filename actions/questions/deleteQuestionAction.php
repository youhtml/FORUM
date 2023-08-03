<?php

session_start();

if(isset($SESSION['auth'])){
    header('Location: ../../login.php');
}

require('../database.php');  //on ne met pas le chemin car se fichier le user y a acce directement ce n'est pas du "sous-code"

if(isset($_GET['id']) AND !empty($_GET['id'])){

    $idOfTheQuestion = $_GET['id'];

    $checkIfQuestionExists = $bdd->prepare('SELECT id_auteur FROM questions WHERE id = ?');
    $checkIfQuestionExists->execute(array($idOfTheQuestion));

    if($checkIfQuestionExists->rowCount() > 0){

        $questionsInfos = $checkIfQuestionExists->fetch();
        if($questionsInfos['id_auteur'] == $_SESSION['id']){

            $deleteThisQuestion = $bdd->prepare('DELETE FROM questions WHERE id =?');
            $deleteThisQuestion->execute(array($idOfTheQuestion));

            header('Location: ../../my-questions.php');

        }else{

            echo 'Vous ne pouvez pas supprimer cette question';
        }

    }else{

        echo "Aucune question n'a été trouvée";

    }

}else{

    echo "Aucune question n'a été trouvée";

}