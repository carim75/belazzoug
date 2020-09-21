<?php
//-------------------------------------
//LA superglobale $_GET
//---------------------
//$_GET represente l'information qui transite dans un URL. Il s'agit d'une superglobale, et donc, comme toutes les superglobales, array. par ailleur, superglobale signifie que cette variable est disponible dans tous les contextes du script, y compris dans l'espace local des fonctions sans avoir besoin de fair "global $_GET.

// les information transite dans l'URL selon la syntaxe suivente :
 // page.php?indice1=valeur1&indiceN=valeurN
// la superglobale $_GET réceptionne les informations dans un tableau :
 //$_GET = array("indice1" => "valeur1","indiceN" =>"valeurN" );


 //vérifier que l'on reçoit de l'information depuis l'URL :
    echo'<pre>';
    print_r($_GET);
    echo'</pres>';
if(isset( $_GET['article']) &&  isset($_GET['couleur']) && isset($_GET['prix'])){
  echo '<h1>' .  $_GET['article']  . '</h1>';
    echo '<p>'   . $_GET['couleur'] . '</p>';
    echo '<p>prix :' .  $_GET['prix'] .'$</p>';


}else{
    echo'<p>Veuillez choisire un produit <a href="page1.php">ici</a></p>';
}

// on réalité nous passons l'identifiant du produit dans l'url afin d'en selectionner les information dans la BDD.
  