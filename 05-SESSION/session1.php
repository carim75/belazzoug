<?php
//-----------------------------------------
//la superglobale $_SESSION
//-------------------------------------------
// Principe des sessions : un fichier temporaire appelé "session" est créé sur le serveur avec un identifiant unique. cette session est liée a un internaute car dans le meme temps, un cookie est deposé dans son naviguateur avec l'identifiant(au nom PHPSESSID). ce cookie se detruit lorsque on quitte le naviguateur.

//la session peut contenir tout sorte d'information , y comprit sensibles, car elle n'est pas accessible par l'internaute, donc pas modifiable par celui-ci. Ony stock des donné de login, des panier d'achat ext...

//tous les site qui fonctionne sur le principe de connexion (site bancaire...) ou qui on besoin de suivre un internaute de page en page (avec son panier par exemple) utilisent les sessions.

//Les donnée du fichier de session sont accessible et manipulables a partir de la superglobale $_SESSION

//creation d'une session
session_start();  // permet de crée un fichier de session OU de l'ouvrir si il exsiste déjà. 

//remplissage du fichier de session :
$_SESSION['pseudo'] = 'tintin';
$_SESSION['mdp'] = 'milou';  //$_SESSION étant une super global est un array. On accede donc a ses valeur en passant par les indices écrits entre[]. 

echo '1- la session apres remplissage :';
print_r($_SESSION);
//Les sessions se trouvent dans les dossier xampp/tmp/


//vider une partie de la session :
unset($_SESSION['mdp']); // nous supprimons le mot de passe avec unset().

echo '<br> 2- la session apres supression du mdp :';
print_r($_SESSION);

//Suppression de toute la session :
//session_destroy(); //suppression de la session(fichier) mais il faut savoir que le session_destroy() est d'abord vue par l'interpréteur qui ne l'execute qu'a la fin du script.
echo '<br>3- la session apres suppression:';
print_r($_SESSION);// nous avons fait un session_destroy() mais il ne sera éxécuté que a la fin de se script, c'est la raison pour laquelle nous avons encore accès au informations ici.

// les sessions ont l'aventage d'etre disponible partout sur le site : voir session2.php

echo '<p><a href="session2.php">Aller page 2</a></p>';
