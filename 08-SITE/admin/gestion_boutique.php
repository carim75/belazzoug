<?php 
require_once '../inc/init.php';
//--------------------------------------------------TRAITEMENT PHP---------------------------------------------------------------------------
//1- restriction d'accès au admin
if(!estAdmin()){//si membre non admin ou non connecté, on le renvoie vers connexion.php
    header('location:../connexion.php');// attention au ../
    exit();
}

//    7- suppression du produit
//    On se posisionne avant l'affichage du tableau <table> pour que celui-ci soi a jour sans le produit quand suprimera 
if(isset($_GET['id_produit'])){ //si existe "id_produit" dans l'URL c'est qu'on a demander sa supression.

    $resultat = executeRequete("DELETE FROM produit WHERE id_produit = :id_produit", array (':id_produit' => $_GET['id_produit'] ));//l'identifiant vien de l'URL.

    if($resultat){// si le DELETE retourne 1 objet PDOStatement  évaluer a true c'est que la requete a marché
        $contenu .= '<div class="alert alert-success">Le produit a bien été supprimé.</div>';

    }else{// dans le cas contraire on a reçu false
        $contenu .= '<div class="alert alert-success">Erreur lors de la suppression.</div>';
    }

}



// 6- Affichage des produits en back_office :
$resultat = executeRequete("SELECT * FROM produit");
$contenu .='<p> Nombre de produits dans ma boutique : '.$resultat->rowCount().'</p>';

$contenu .= '<table class="table">';
$contenu .='<tr>';
$contenu .='<th>ID</th>';
$contenu .='<th>Référence</th>';
$contenu .='<th>Catégorie</th>';
$contenu .='<th>Titre</th>';
$contenu .='<th>Description</th>';
$contenu .='<th>Couleur</th>';
$contenu .='<th>Taille</th>';
$contenu .='<th>Public</th>';
$contenu .='<th>Photo</th>';
$contenu .='<th>Prix</th>';
$contenu .='<th>Stock</th>';
$contenu .='<th>Action</th>';
$contenu .='</tr>';///colone pour les lien modifier ou suprimer

// les ligne du tableau :
//affichez un produit par ligne avec dans la colonne "photo" la photo du produit en90px de large.
$produit = '';
while($produit = $resultat->fetch(PDO::FETCH_ASSOC)){//cette boucle parcour les information du tableau $produit

    //debug($produit);
$contenu .='<tr>';
    foreach($produit as $donne => $info){
      if($donne == 'photo'){//si je suis sur la colonne "photo" alors je mets une balise <img>
    
        $contenu .='<td><img src="../'.$info.'" style="width:90px"></td>';

       }else{// pas de balise img pour les autre colonnes
           $contenu .= '<td>' . $info . '</td>';
       }

   
       
    }

$contenu .= '<td>
            <a href="formulaire_produit.php?id_produit='. $produit['id_produit'].'">modifier</a>
            <a href="gestion_boutique.php?id_produit='. $produit['id_produit']. '"onclick="return confirm(\'etes-vous sur de bien vouloir supprimer ce produit?)\'">supprimer</a>
            </td>'; // nous ajoutons les liens modifier et supprimer sur chaque ligne de produit (nous sommes a l'interieur du <tr>). Nous passons dans l'URL l'identifiant du produit contenu dans la variable $produit ['id_produit'] (cf debug($produit)).

$contenu .='</tr>';

}
$contenu .='</table>';











//------------------------------------------------------AFFICHAGE----------------------------------------------------------------------------------

require_once '../inc/header.php';
// 2- liens de navigation
?>
<h1 class="mt-4">Gestion boutique</h1>
<ul class="nav nav-tabs">
<li> <a href="gestion_boutique.php" class="nav-link active">Affichage des produits</a></li>
<li> <a href="formulaire_produit.php" class="nav-link">Formulaire produits</a></li>

</ul>



<?php
echo $contenu;
require_once '../inc/footer.php';

