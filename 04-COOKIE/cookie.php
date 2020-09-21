<?php
//------------------------------------
// la superglobale $_COOKIE
//------------------------------------

 //Un cookie est un petit fichier (4 ko max) déposé par le serveur  du site dans le naviguateur de l'internaute et qui peut contenir des information. les cookies sont automatiquement  renvoyés au serveur web par le navigateur quand l'internaute navigue dans les pages concernées par le cookie. PHP permet de récuperer trés facilement les données contenue dans un cookie : ses information sont stockées dans la superglobale $_COOKIE.

 // Précaution a prendre avec les cookies : étant sauvgardé dans le poste de l'intenaute, le cookie peut etre volé ou modifié. on y mets donc pas d'information sensibles (prix de panier,CB, mot de passe.. ) mais des preference ou des trace de visite par exemple.


 // Application : nous allons stocker la langue sélectionnée par l'internaute dans un cookie.




// 2- On détermine la langue d'affichage pour l'internaute :


if(isset($_GET['langue'])){// si on a cliqué sur une langue l'indice langue est passer dan l'URL donc il se trrouve dans $_GET
    $langue = $_GET['langue'];// on affecte alors la valeur de la langue a la variable $langue("fr,es,en,it").

}elseif (isset($_COOKIE['langue'])){ //sinon si on a reçu a cookie appelé "langue"
    $langue =$_COOKIE['langue']; //on affecte la valeur stockée dans le cookie

}else {
    $langue = 'fr'; // par default si on a pas cliquer et que aucun cookie exsiste la langue sera FR.

}





///3- on envoie le cookie :

$un_an = time() + 365*24*60*60; // time() retourne le timestamp de l'instant présent auquel on ajoute 1ans expimé n seconde. pour memoir : timestamp = nombre de secondes écoulées depuis le/01/01/1970.

setcookie('langue',$langue,$un_an); // on envoie un cookie appelé "langue", avec la valeur celle qui est dans $langue, et pour date d'expiration $un_an.



// 4- on affiche la langue :
echo "<h2>Langue du site : $langue </h2>";


//setcookie() permet de créer un cookie. Cependant il n'y a pas de fonction pédéfinie permettant de le supprimer. pour cela on le met a joue avec une date perimé, ou a zéro, ou encore en mettant juste le nom cookie sans les autre arguments.




 // 1- le HTML
 ?>
 <h1>langue</h1>
 <ul>
 <li><a href="?langue=fr">français</a></li>
 <li><a href="?langue=es">espagnole</a></li>
 <li><a href="?langue=en">anglais</a></li>
 <li><a href="?langue=it">italien</a></li>
 
 </ul>


