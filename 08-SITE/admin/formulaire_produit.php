<?php
require_once '../inc/init.php';
//--------------------------------------------------TRAITEMENT PHP---------------------------------------------------------------------------
//1- restriction d'accès au admin
if (!estAdmin()) { //si membre non admin ou non connecté, on le renvoie vers connexion.php
    header('location:../connexion.php'); // attention au ../
    exit();
}

// 4- Enregistrement du produit en BDD
//debug($_POST);

if (!empty($_POST)) { // si le formulaire a été envoyé

    // ici il faudrait mettre tous les controles sur les formulaire... 
    $photo_bdd = ''; //par defaut la photo en BDD est vide

    // 9 suite : modification de la photo : 

    if (isset($_POST['photo_actuelle'])) { //si existe "photo_actuelle " dans $_POSTE c'est que nous sommes en train de modifier le produit avec sa photo. On remet l'URL de la photo en BDD:
        $photo_bdd = $_POST['photo_actuelle'];
    }





    // 5 suite : traitrement de la photo:
    //debug($_FILES);// $_FILES est une superglobal qui represente l'input type "file" d'un formulaire. L'indice "photo" correspond a l'atribut "name" de l'input. les autre uindice de se tableau son predefinie :name= pour le nom du fichier,    type= pour le type du fichier(image),"tmp_name" pour ladresse du fichier temporaire en cours d'upload,   "error" pour le code erreur du telechargement, "size" pour la taille du fichier uploadé.

    if (!empty($_FILES['photo']['name'])) { //si un fichier est en cours d'upload

        $fichier_photo = $_FILES['photo']['name']; // nom de la photo

        $photo_bdd = 'photo/' . $fichier_photo; // chemain relatif de la photo qui est enregistré en BDD et qui nous servira pour l'attribut "src" des balises images( les photos sont copié dans le dossier "photo" ligne suivante).

        copy($_FILES['photo']['tmp_name'], '../' . $photo_bdd); //......cette fonction prédefinie enregistre le fichier qui est temporairement a l'adresse"tmp_name" vers l'adresse dont le chemain est "../photo/fichier_photo.jpg

    }









    //insertion en BDD
    $requete = executeRequete("REPLACE INTO produit VALUES (:id_produit, :reference, :categorie, :titre, :description, :couleur, :taille, :public, :photo, :prix, :stock)", array(
        ':id_produit' =>  $_POST['id_produit'],
        ':reference' =>   $_POST['reference'],
        ':categorie' =>   $_POST['categorie'],
        ':titre' =>       $_POST['titre'],
        ':description' => $_POST['description'],
        ':couleur' =>     $_POST['couleur'],
        ':public' =>      $_POST['public'],
        ':taille' =>      $_POST['taille'],
        ':photo' =>       $photo_bdd,
        ':prix' =>        $_POST['prix'],
        ':stock' =>       $_POST['stock'],

    )); //REPLACE INTO fait un INSERT  quand l'ID donné n'existe pas (0). il se comporte un UPDATE quand l'ID donné existe.

    if ($requete) { // si executeRequete a retourné un objet PDOStatement, donc implicitement evalué a true, alors c que la requete a marcher
        $contenu .= '<div class="alert alert-success">Le produit a été enregistré.</div>';
    } else { //sinnon dans le cas contraire, executeRequete nous a retourné False
        $contenu .= '<div class="alert alert-success">erreur l\'hors de l\'enregistrement.</div>';
    }
} // fin du if (!empty($_POST))




//   8- Remplissage du formulaire de modification:
//debug($_GET);
if (isset($_GET['id_produit'])) { // si id-produit est dans l'URL c'est que nous avons demandé la modification du produit : On selectionne les info du produit en BDD pour l'afficher dans le formulaire
    $resultat = executeRequete("SELECT * FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $_GET['id_produit']));

    $produit = $resultat->fetch(PDO::FETCH_ASSOC); //on "fetch" le produit sans boucle while car il y en a qu'un seul par identifiant.

    debug($produit); // on affiche toute les info de l'id produit



}













//------------------------------------------------------AFFICHAGE----------------------------------------------------------------------------------

require_once '../inc/header.php';
// 2- liens de navigation
?>
<h1 class="mt-4">Gestion boutique</h1>
<ul class="nav nav-tabs">
    <li> <a href="gestion_boutique.php" class="nav-link">Affichage des produits</a></li>
    <li> <a href="formulaire_produit.php" class="nav-link active">Formulaire produits</a></li>

</ul>



<?php
echo $contenu;
// 3- Formulaire d'ajout ou de modification de produit
?>
<form action="" method="post" enctype="multipart/form-data">
    <!--l'attribue enctype spécifie que le formulaire envoie des données binaires (fichier) et du texte (champs de formulaire): permet d'uploader une photo-->

    <input type="hidden" name="id_produit" value="<?php echo $produit['id_produit'] ?? 0; ?>"><!-- ce champ est nécessaire pour la modification ou la creation d'un produit, car on a besoin de l'ID pour la requete SQL. Nous mettons 0 par defaut en value pour que le REPLACE se comporte comme un INSERT et insere le produit en BDD.type"hidden" pour cacher le champ ou nous mettons l'id du produit existant pour que le REPLACE  se comporte comme un UPDATE"modifier"-->

    <div> <label for="reference">Référence</label></div>
    <div><input type="text" name="reference" id="reference" value="<?php echo $produit['reference'] ?? ''; ?>"></div>

    <div> <label for="categorie">Categorie</label></div>
    <div><input type="text" name="categorie" id="categorie" value="<?php echo $produit['categorie'] ?? ''; ?>"></div>

    <div> <label for="titre">Titre</label></div>
    <div><input type="text" name="titre" id="titre" value="<?php echo $produit['titre'] ?? ''; ?>"></div>

    <div> <label for="couleur">Couleur</label></div>
    <div><input type="text" name="couleur" id="couleur" value="<?php echo $produit['couleur'] ?? ''; ?>"></div>

    <div> <label for="description">Description</label></div>
    <div><textarea name="description" id="description" cols="30" rows="10"><?php echo $produit['description'] ?? ''; ?></textarea></div>

    <div><label for="taille">taille</label></div>
    <div>
        <select name="taille" id="taille">
            <option value="S" <?php if (isset($produit['taille']) && $produit['taille'] == 'S') echo 'selected'; ?>>S</option>
            <option value="M" <?php if (isset($produit['taille']) && $produit['taille'] == 'M') echo 'selected'; ?>>M</option>
            <option value="L" <?php if (isset($produit['taille']) && $produit['taille'] == 'L') echo 'selected'; ?>>L</option>
            <option value="XL" <?php if (isset($produit['taille']) && $produit['taille'] == 'XL') echo 'selected'; ?>>XL</option>
        </select>
    </div>


    <div><label for="public">public</label></div>
    <div>
        <input type="radio" name="public" value="m" checked>Masculin
        <input type="radio" name="public" value="f" <?php if (isset($produit['public']) && $produit['public'] == 'F') echo 'checked'; ?>>Feminin
    </div>
    <div><label for="photo">Photo</label></div>
    <!-- 5-upload de photo --->
    <input type="file" name="photo" id="photo">
    <!---on oublie pas l'attribute enctype="multipart/form-data" sur la balise <form>-->


    <!---------- 9- Modification de la photo ----------------------->
    <?php
    if (isset($produit['photo'])) { //si nous somme entrain de modifier le produit, nous affichons la photo actuellement en BDD :

        echo '<p>Photo actuelle du produit</p>';
        echo '<img src="../' . $produit['photo'] . '" style="width:90px">';
        echo '<input type="hidden" name="photo_actuelle" value="' . $produit['photo'] . '">';
    }

    ?>


    <div> <label for="prix">Prix</label></div>
    <div><input type="text" name="prix" id="prix" value="<?php echo $produit['prix'] ?? ''; ?>"></div>

    <div> <label for="stock">Stock</label></div>
    <div><input type="text" name="stock" id="stock" value="<?php echo $produit['stock'] ?? ''; ?>"></div>

    <div><input type="submit" value="Enregistrer" class="btn btn-info"></div>





</form>



<?php
require_once '../inc/footer.php';
