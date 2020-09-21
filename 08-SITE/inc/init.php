<?php
/*Le fichier init.php sera inclus dans tous les scripts(hors inclusions) poour initialiser:
                          -la connection a la BDD
                          -la création ou l'ouverture de la session
                          -la définition du chemain du site sur le serveur
                          -l'inclusion du fichier Function.php
*/



//Connexion a la BDD

$pdo = new PDO(
    'mysql: host=localhost;dbname=site_commerce', // driver mysql, serveur de la BDD (host), nom de la BDD(dbname) a changer
    'root', // pseudo de la BDD
    '', // root pour MAC 'mot de passe de la BDD
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,  // option1 : on affiche les erreurs SQL
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'  // option2: on definnit le jeu de caracteres des echanges avec la BDD




    )
);


//Création ou ouverture de session
session_start();


//Chemin du site
define('RACINE_SITE', '/PHP/08-site/'); //on indique ici les dossier dans lequels se situe le site a partir de "localhost".Cela permet de créer des chemins absolus a partir de "localhost"(caracterisés par le / au debut). Ils son utilisé notament dans un header.php qui peut etre unclus dans des fichiers apparteneant a des dossers ou des sous dossier differents : par consequent les chemains relatifs vers les sources changeraient, alors que le chemain absolus sont les memes.


//Declarer une variable d'affichage
$contenu = '';

//inclusion des fonctions
require_once 'functions.php';// fait l'inclusion une seule foi du fichier spécifié
