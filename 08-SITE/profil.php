<?php

require_once 'inc/init.php';
/*EXERCICE:
1-si le visiteur accede a cette page  et qu'il n'est pas connecter vous le rediriger(headerlocation)vers la page de connexion.

2-Dans cette page , vous affichez toutes les informations de son profil. Par ailleur vous ajouter un message de bienvenue juste apres le <h1>:"bonjour[prenom] [nom] !"</h1>

3- ajoutez un lien"supprimer mon compte". Quand on clique vous supprimez le membre en BDD ( delete) apres avoir demandé confirmation de la suppression en JavaScript.Une foi le profil suprimé, vous détruisez la session et le redirigez le membre vers la page inscription.php.
require_once 'inc/header.php';

*/


if (!estConnecte()) {
    header('location:connexion.php'); // on envoi dans le header du texte HTTp qui transite entre serveur et client le "message" 'location:connexion.php'. Celui-ci spécifie au navigateur qu'il doit demander la page connexion.php.
    exit();
}

//debug($_SESSION);//des lors que l'on fait un seesion_start()( il est dans init.php), les données stockées dans cette session sur le serveur sont disponible partout sur le site.Ici il s'agit d'un tableau multidimentionnel, ce pourquoi nous ecrivons $_SESSION['membre']['ville'] pour acceder a la ville du membre.

//3- suppression du compte
if (isset($_GET['action']) && $_GET['action'] == 'supprimer') { // le isset est necessaire car si "action" n'existe pas dans l'URL, donc dans $_GET, la conditon s'arrete immédiatement sans regarder si "action" contient "supprimer". dans le cas contraire(si on ne met pas isset), nous aurions une erreur "undefined index"
    $id_membre = $_SESSION['membre']['id_membre']; // je vais chercher mon id_membre dans la session $_SESSION car je suis connecté. 

    $supprimer = executeRequete("DELETE FROM membre WHERE id_membre = $id_membre");
    session_destroy(); // on déconnecte le membre en supprimant sa session
    header('location:inscription.php'); // redirection vers inscription
    exit(); // on quitte le script

}







require_once 'inc/header.php';
?>
<h1 class="mt-4">profil</h1>
<h2>Bonjour <?php echo $_SESSION['membre']['prenom'] . ' ' . $_SESSION['membre']['nom']; ?> !</h2>

<?php
if (estAdmin()) {
    echo '<p> Vous etes ADMINISTRATEUR.</p>';
}
?>

<hr>
<h3>Vos coordonnées</h3>
<ul>
    <li> Email: <?php echo $_SESSION['membre']['email']; ?></li>
    <li> adresse: <?php echo $_SESSION['membre']['adresse']; ?></li>
    <li> code postal: <?php echo $_SESSION['membre']['code_postal']; ?></li>
    <li> ville: <?php echo $_SESSION['membre']['ville']; ?></li>

</ul>

<hr>

<p><a href="profil.php?action=supprimer" onclick="return(confirm('etes-vous sur de bien vouloir supprimer votre compte?'))">supprimer mon compte</a></p>
<!--"confirm" retourne true quand on valide : return true déclanche le lien. en revanche quand on annule, confirm retourne false: return false bloque le lien (équivaut a e.preventDefault()).-->





<?php
require_once 'inc/footer.php';
