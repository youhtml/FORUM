<?php

require('actions/database.php');

$getAllAnswersOThisQuestion = $bdd->prepare('SELECT id_auteur, pseudo_auteur, id_question, contenu FROM answers WHERE id_question = ? ORDER BY ID DESC');
$getAllAnswersOThisQuestion->execute(array($idOfTheQuestion));