<?php
require_once 'inc/init.php';
//------------------------------------------TRAITEMENT--------------------------------------------------------------------------------------------

//debug($_POST);

// 1- ajout du produit au panier :

if (!empty($_POST)){//si le formulaire d'ajout au panier a été envoyé
   
    //On selectionne en BDD le prix, la reference et le titre du produit ajouté
    $resultat = executeRequete("SELECT prix, reference, titre FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $_POST['id_produit']));//l'identifiant vient du formulaire

    $produit = $resultat->fetch(PDO::FETCH_ASSOC);
    //debug($produit);

    //On remplie la session avec les infos du produit ajouté au panier (on les met dans la session pour que le panier soit accessible dans toutes les page du site)

    $_SESSION['panier']['id_produit'][] = $_POST['id_produit']; //id_produit vient du formulaire donc de $_POST. les [] vides permettent d'ajouter un élément a la fin du tableau avec un indice numérique.

    $_SESSION['panier']['reference'][] = $produit['reference'];// la référence vien de la BDD

    $_SESSION['panier']['titre'][] = $produit['titre']; //le titre vien de la BDD

    $_SESSION['panier']['quantite'][] = $_POST['quantite']; // la quantite vient du formulaire

    $_SESSION['panier']['prix'][] =$produit['prix']; //le prix vien de la BDD
   //debug($_SESSION);

// 3- redirection vers la fiche produit une foi l'arcticle ajouté au panier
header('location:fiche_produit.php?id_produit='. $_POST['id_produit']);// je passe l'identifiant produit dans l'URL pour reafficher la fiche de ce produit.
exit();
    
}

//4- vider la panier
if (isset($_GET['action']) && $_GET['action'] == 'vider' ){//si j'ai cliquer sur "vider le panier"
    unset($_SESSION['panier']);// on suprime le panier de la session sans suprimer cette derniere totalement pour ne pas deconecter le membre.

}

//----------------------------------------------AFFICHAGE------------------------------------------------------------------------------------------

require_once 'inc/header.php';
// 2- affichage du panier
echo '<h1 class="mt-4">Votre panier</h1>';

if(empty($_SESSION['panier']['id_produit'])){ // s'il n'y a pas d'id produit c'est que le panier est vide

    echo'<p>Votre panier est vide</p>';

}else{

    echo '<table class="table table-striped">';
    //ligne des entetes
    echo '<tr class="info">
    <th>réference</th>
    <th>titre</th>
    <th>quantité</th>
    <th>prix unitaire</th>
    
    </tr>';
    //ligne de chaque produit
    // on fait une boucle for pour parcourir les indices numériques
    for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++){// on fait autant de tour que d'id_produit dans le panier

        echo '<tr>';

        echo '<td>' . $_SESSION['panier']['reference'][$i] . '</td>';
        echo '<td>' . $_SESSION['panier']['titre'][$i] . '</td>';
        echo '<td>' . $_SESSION['panier']['quantite'][$i] . '</td>';
        echo '<td>' . number_format($_SESSION['panier']['prix'][$i], 2, ',', '') . '€</td>';
        echo '</tr>';





    }

//ligne du total
echo '<tr>

  
  <th colspan="3" class="text-right">Total:</th>
  <th colspan="1">'.montantTotal() .'€TTC</th>

</tr>';

//ligne "vider" le panier
echo '<tr class="text-center">
<td colspan="4">
<a href="?action=vider"> vider le panier</a>
</td>
</tr>';

    echo '</table>';
}// fin du else





require_once 'inc/footer.php';