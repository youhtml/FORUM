<?php

require('actions/database.php');

//Recuperer les questions par default sans recherche
$getAllQuestions = $bdd->query('SELECT id, id_auteur, titre, description, pseudo_auteur, date_publication FROM questions ORDER BY id DESC LIMIT 0,5');

//Verifier si une recherche a été rentré par l'utilisateur
if(isset($GET['search']) AND !empty($GET['search'])){

    //La recherche
    $usersSearch = $_GET['search'];

    // Récupérer toute les questions qui corresponde à la recherche (enfonction du titre)
    $getAllQuestions = $bdd->query('SELECT id, id_auteur, titre, description, pseudo_auteur, date_publication FROM questions WEHRE titre LIKE "%'.$usersSearch.'%" ORDER BY id DESC ');
}