<?php
//Exercice :
// cree un formulaire avec les champs "ville", "code postal" et une zone de texte "adresse" dans cette page formulaire 2.php.

//- afficher les donné saisie par l'internaute dans la page formulaire 2-traitement.php

if (!empty($_POST)){
    
    
    echo '<p>ville :' . $_POST['ville'] . '</p>';
    echo '<p>postal :' .$_POST['postal'] . '</p>';
    echo '<p>adresse :' .$_POST['adresse'] . '</p>';
    



?>



<h1>Formulaire</h1>

<form method="post" action="formulaire2-traitement.php"><!--action permet de donnez un chemain au formulaire -->

<div><label for="ville">ville</label></div> <!--etiquette-->
<div><input type="text" name="ville" id="ville" ><!--champ input--->

<div><label for="postal">code postal</label></div>
<div><input type="number" name="postal" id="postal" >


<div><label for="adresse">adresse</label></div>
<div><textarea name="adresse" id="adresse" ></textarea></div>

<div><input type="submit" value="envoyer"></div>
</form>