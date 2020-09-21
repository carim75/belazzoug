<?php
//-------------------------------------------------
// La superglobale $_POST
//-------------------------------------------------

// $_POST est une superglobale qui permet de recuperer les donné saisie dans un formulaire.

//$_POST étant une superglobale, et donc un array et disponible dans tous les contexte du script y compris au sein des fonction sans y fair "global $_POST"

// les données saisie dans le formulaire  sont réceptionnées dans $_POST de la maniere suivante : $_POST = array(''name1 => 'valeur input1','nameN =>'valeur inputN');

echo '<pre>';
print_r($_POST);// pour verirfier que se frormulaire envoie bien des données
echo '</pre>';

if (!empty($_POST)){ // si n'est pas vide $_post c'est que l'on a reçu des donné du formulaire. on peut donc afficher le contenue: (empty= verifie si c vide )

    echo '<p>prénom :' . $_POST['prenom'] . '</p>';
    echo '<p>description :' .$_POST['description'] . '</p>';

}

//remarque:
//-Cliquer dans L'URL et fair entrer permet de réinitialiser le formulaire comme si nous venion pour la 1er fois.
//-faire F5 ou CTRL + r permet de rafraichir la page et de renvoyer les dernieres données saisies dans le formulaire.

?>

<h1>Formulaire</h1>

<form method="post" action=""><!-- un formulaire doit toujours etre dans une balise <form> pour fonctionner. l'attribut method définit comment les données vont circuler entre le navigateur et le serveur.l'attribut action définit l'URL de destination des données saisies.-->

<div><label for="prenom">prenom</label></div>
<div><input type="text" name="prenom" id="prenom" ></div><!-- il ne faut pas oublier les "name" dans les formulaire : ils constitue les indices du tableau $_POSTqui receptionnne les données-->

<div><label for="description">description</label></div><!--l'attribut for n'est pas indispensable mais il permet de relié le label a l'input qui porte un ID de la meme valeur. ainsi quand on clique sur l'étiquette, le curseur se positionne dans l'input-->
<div><textarea name="description" id="description" ></textarea></div>

<div><input type="submit" value="envoyer"></div><!--bouton cliquable-->



</form>