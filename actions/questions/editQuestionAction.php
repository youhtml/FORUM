<?php

require('actions/database.php');

//Validation du formulaire
if(isset($_POST['validate'])){

    //Verifier si les champs sont renseignés
    if(!empty($_POST['title']) AND !empty($_POST['description']) AND !empty($_POST['content'])){

        //les données a faire passer dans la requete
        $new_question_title = htmlspecialchars($_POST['title']);
        $new_question_description = nl2br(htmlspecialchars($_POST['description']));
        $new_question_content = nl2br(htmlspecialchars($_POST['content']));

        //Modifier les infos de la question qui possede l'id rentre en paramatre dans l'url
        $editQuestionOnWebsite = $bdd->prepare('UPDATE questions SET titre =?, description =?, contenu=? WHERE id =?');
        $editQuestionOnWebsite->execute(array($new_question_title, $new_question_description, $new_question_content, $idOfQuestion));

        //Redirection vers la page de mes questions de l'utilisateur
        header('Location: my-questions.php');

    }else{
        $errorMsg = 'Veuillez remplir les champs obligatoires';
    }
}