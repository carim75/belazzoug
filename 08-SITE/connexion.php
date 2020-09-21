<?php

require_once 'inc/init.php';
//---------------------------------------TRAITEMENT PHP---------------------------------------------------------------------
$message = ''; // pour afficher le message de déconnexion 

// 2- Déconnection de l'internaute :
//debug($_GET);


if(isset($_GET['action']) && $_GET['action'] == 'deconnexion'){// si le membre a cliqué sur la "deconnexion"
    //debug($_SESSION);
    unset($_SESSION['membre']); // on ne fait pas un session_destroy() qui suprimerait toute la session car on veut pouvoir conserver le panier de l'internaute.

    $message = '<div class="alert alert-info">Vous etes déconnecté.</div>';

}


//3- Le membre déjà connecter est rediriger vers son profil :
if (estConnecte()){
    header('location:profil.php');// Nous affichon le formulaire de connexion qu'aux membre non connectés. les autre sont redirigés vers le profil.
    exit();//pour quitter le script

}






//1- Traitement du formulaire
//debug($_POST);

if(!empty($_POST)){// si le formulaire a était envoyé

    //controle du formulaire
    if (empty($_POST['pseudo']) || empty($_POST['mdp'])) {//empty = vide ! ici on verifi si pseudo et mdp  son soi null ou false ou non definis
        $contenu .= '<div class="alert alert-danger">Les identifiant son obligatoires.</div>';
    }

    //S'il n'y a pas de message d'erreur a l'internaute, on cherche le pseudo en BDD :
    if(empty($contenu)){// si c'est vide c'est qu'il n'y a pas d'erreur
        $resultat = executeRequete("SELECT * FROM  membre WHERE pseudo = :pseudo",array(':pseudo'=> $_POST['pseudo']));

        if($resultat->rowCount() == 1){// si il y a 1 ligne  de resultat, alors le pseudo existe: on peut vérifier le mdp
            $membre =$resultat->fetch(PDO::FETCH_ASSOC);// on "fetche" l'objet $resulat pour en extraire les donné du membre( pas de boucle car le pseudo est unique.)
            debug($membre);

            //on verifie le mdp
            if(password_verify($_POST['mdp'],$membre['mdp'])){// si le mdp du formulaire correspond au hach du mdp en BDD alors cette fonction retourne true
                //On connecte le membre
                $_SESSION['membre']= $membre;// nous remplissons la session (ouverte avec le session_start() dans le init.php) avec les info du membre qui proviennent de la BDD

                //puis on redirige vers la page de profil:
                header('location:profil.php');
                exit(); // et on quitte le script
                

            }else{//sinon c'est que les mdp ne correspondent pas 
                $contenu .= '<div class="alert alert-danger">erreur sur le mdp.</div>';


            }


        }else{//si il ny a pas de ligne de resultat c'est que le pseudo n'existe pas en BDD

            $contenu .= '<div class="alert alert-danger">erreur sur le pseudo.</div>';
            
        }
        
    }// fin du if (empty($contenu))



}// fin du if (!empty($_POST))










//------------------------------------------AFFICHAGE-------------------------------------------------------------------------------

require_once 'inc/header.php';
?>
<h1 class="mt-4">Connexion</h1>

<?php
echo $message; //pour le message de deconnexion
echo $contenu; // pour les message de connexion
?>
<form action="" method="post">

  <div><label for="pseudo">pseudo</label></div>
  <div><input type="text" name="pseudo" id="pseudo"></div>

  <div><label for="mdp">Mot de passe</label></div>
  <div><input type="password" name="mdp" id="mdp"></div>

  <input type="submit" value="se connecter" class="btn btn-info">




</form>






<?php
require_once 'inc/footer.php';
