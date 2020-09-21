<?php
require_once 'inc/init.php';
//--------------------------------------------------TRAITEMENT PHP--------------------------------------------------------------

$panier='';// pour afficher le formulaire d'ajout au panier
$suggestion = ''; //pour la suggestion de produits



// 1- Controle de l'existence du produit demandé (un produit en favori a pu etre supprimé de la BDD...) :

//debug($_GET);

if (isset($_GET['id_produit'])) {// si "id_produit" est dans l'URL, c'est que l'on a demandé le detaile d'un produit
    $resultat = executeRequete("SELECT * FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $_GET['id_produit']));

    if($resultat->rowCount() == 0) {//s'il ny a pas de produit en BDD avec cette identifiant, nous redirigeon vers la boutique
        header('location:index.php');//direction ver sla boutique index.php
        exit();


    }

    // 2- Affichage et mise en forme des informations du produit:
        $produit = $resultat->fetch(PDO::FETCH_ASSOC);// on "fetche" les données du produit sans faire de boucle car il y en a qu'un par identifant.
        //debug($produit);
        extract($produit);// cree des variables nommées comme les indices du tableau associatif, et qui prennent les valeurs.(extract permet de recupere les variable $prix,$titre,$)

    // 3-formulaire d'ajout au panier si le stock est supérieur 0:
        if($stock > 0){ //s'il y a du stock sur le produit, on affiche le bouton
            //Pour panier.php il nous faut l'identifiant du produit et la quantité ajoutée au panier:
                $panier .='<form method="post" action="panier.php">';
                $panier .= '<input type="hidden" name="id_produit" value="'.$id_produit.'">'; //pour renseigne $_POST avec l'id_produit de l'arcticle ajouté

                //Sélecteur de quantité
                $panier .= '<select name="quantite" class="custom-select col-3">';
                for($i = 1; $i <= $stock && $i <= 10; $i++){// on fait 10 tours de boucle max a concurrence du stock disponible (exemple: si le stock est de 3, on ne fait que 3 tours)
                    $panier .= "<option>$i</option>";





                }
                $panier .= '</select>';

                //bouton d'ajout au panier
                $panier .= '<input type="submit" name="ajout_panier" value="ajouter au panier" class="btn btn-info col-8 offset-1">';// offset-1 permet de décalé de 1 colone

                $panier .='</from>';

        }else{
            // si le stock est NULl 
            $panier.= '<p>produit indisponible</p>';
        }





}else{// si l'id_produit n'est pas dans l'URL, on redirige vers la boutique
    header('location:index.php');
    exit();

}

// Exercice : afficher 2 produits (photo et titre) aléatoirement appartenant à la catégorie du produit affiché au-dessus. Ces 2 produits doivent être différents du produit consulté. La photo est cliquable, et mène à la fiche détaillé du produit. Vous utilisez la variable $suggestion pour afficher le contenu.  


 $resultat = executeRequete("SELECT * FROM produit WHERE categorie = :categorie AND id_produit != :id_produit ORDER BY RAND() LIMIT 2", array(':categorie' => $categorie, ':id_produit' => $id_produit ));

 while($produit_suggere = $resultat->fetch(PDO::FETCH_ASSOC)){


//debug($produit_suggere);
                  $suggestion .= '<div class="col-sm-3">';// le .= permet de concaténer les valeurs a chaque tour de boucle a linterieur de $suggestion SANS remplacer la valeur précédente.

                 $suggestion .= '<h4>'. $produit_suggere['titre'] .'</h4>';
                 
                 $suggestion.= '<a href="?id_produit='. $produit_suggere['id_produit'].'">
                              <img src="'.$produit_suggere['photo'] . '" alt="'.$produit_suggere['titre'].'" class="img-fluid">
                 
                                </a>';// pour afficher le detail du produit, on ajoute un lien en GET "?" qui enoie l'id_produit a la page fiche_produit.php.

                  $suggestion .= '</div>';
                 

                 // '<a href="fiche_produit.php?id_produit='.$produit['id_produit'].'">
                                // <img class="card-img-top " src="' . $produit['photo'] . '" alt="' . $produit[''] . '">
                                //</a>';

 }
 









//---------------------------------------------------- AFFICHAGE-----------------------------------------------------------------
require_once 'inc/header.php';

?>

<div class="row">

<div class="class col-12">
<h1><?php  echo $titre; // on accède a cette variable "titre" grace a extract() fait sur le tableau $produit ?></h1> 

</div>

<div class="col md-8">
<img src="<?php echo $photo; ?>" alt="<?php echo $titre; ?>" class="img-fluid">
</div>

<div class="col md-4">

<h3>Description</h3>
<p><?php echo $description; ?></p>

<h4>Détais</h4>
<ul>
<li>catégorie:  <?php echo $categorie; ?></li>
<li>couleur:    <?php echo $couleur; ?></li>
<li>taille:     <?php echo $taille; ?></li>
</ul>
<h4>Prix: <?php echo number_format($prix, 2, ',', ''); ?> €TTC</h4><!--echo number- format($prix, 2, ',' '')-->
<?php echo $panier; //formulaire d'ajout au panier ?>

</div><!-- col md-4-->



</div><!--  .row  -->

<hr>

<div class="row">
<div class="col-12">
<h2>Suggestion de produits</h2>

</div>
<?php echo $suggestion; ?>
</div>

<?php

require_once 'inc/footer.php';


