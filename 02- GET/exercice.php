<?php
//exercice :

/*
1-vous affichez dans ce script : 1 tittre "mon profil", un nom et un prénom.
2-Vous y ajoutez un lien en GET "modifier mon profil".ce lien passe dans  L'url a la page exercice .php que l'ACTION demandée est modification.
3- si vous recevez cette information depuis l'URL vous affichez "vous avez demandé la modification de votre profil.".





*/
echo '<h1> mon profil </h1> <br>';
print_r($_GET);// pour verifier que je reçcois  de l'info par l'URL

if(isset($_GET['action']) && $_GET['action'] == 'modification'){//si existe "action" dans $_GET, donc dans L'URL, c'est qu'on a cliqué sur le lien  modifier mon profil". Puis on verifie que la valeur de $_GET ['action'] est "modification", auquel cas on a bien cliqué sur le lien "modifier".

    echo'<p> vous avez demandez la modofication de votre profil</p>';
}


echo '<p>azzoug</p> <br>';
echo '<p> karim </p> <br>';
?>
<a href="exercice.php?action=modification">modifier mon profil</a>
