<?php
try{
    // session_start(); 
    $bdd = new PDO('mysql:host=localhost;dbname=forum;charset=utf8;', 'root', '');
    echo 'Connexion réussie kjoiji';
}catch(Exception $e){
    die('Une erreur a été trouvée : ' . $e->getMessage());
}
