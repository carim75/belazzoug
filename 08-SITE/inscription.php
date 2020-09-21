<?php
require_once 'inc/init.php';
$affiche_formulaire =true; // pour afficher le formulaire tant que le membre n'est pas inscrit.


//-------------------TRAITEMENT PHP --------------------------------------------------------------------//
//debug($_POST);

if(!empty($_POST)){//si $_POST n'est pas vide c'est que le formulaire a été envoyé
//validation du formulaire :
    if(!isset($_POST['pseudo']) || strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 20){ // si le pseudo n'éxiste pas dans $_POST c'est que la formulaire est altéré, ou si sa valeur est < 4 ou si sa valeur est  > 20 (pour la BDD), on met un message d'erreur a l'internaute.
          $contenu .= '<div class="alert alert-danger"> le pseudo doit contenir entre 4 et 20 caracteres.</div>';
    }

  
            if(!isset($_POST['mdp']) || strlen($_POST['mdp']) < 4 || strlen($_POST['mdp']) > 20){ // si le mdp n'éxiste pas dans $_POST c'esy que la formilaire est altéré, ou si sa valeur est < 4 ou si sa valeur est  > 20 (pour la BDD), on met un message d'erreur a l'internaute.
                  $contenu .= '<div class="alert alert-danger"> le mot de passe doit contenir entre 4 et 20 caracteres.</div>';
            }


            if(!isset($_POST['nom']) || strlen($_POST['nom']) < 1 || strlen($_POST['nom']) > 20){ // si le nom n'éxiste pas dans $_POST c'esy que la formilaire est altéré, ou si sa valeur est < 1 ou si sa valeur est  > 20 (pour la BDD), on met un message d'erreur a l'internaute.
                $contenu .= '<div class="alert alert-danger"> le nom doit contenir entre 4 et 20 caracteres.</div>';
          }


          if(!isset($_POST['prenom']) || strlen($_POST['prenom']) < 1 || strlen($_POST['prenom']) > 20){ // si le prenom n'éxiste pas dans $_POST c'esy que la formilaire est altéré, ou si sa valeur est < 1 ou si sa valeur est  > 20 (pour la BDD), on met un message d'erreur a l'internaute.
            $contenu .= '<div class="alert alert-danger"> le prenom doit contenir entre 4 et 20 caracteres.</div>';
      }
            if(!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || strlen($_POST['email']) > 50){ // LA FONCTION predefinie filter_var() avec l'argument FILTER_VALIDATE_EMAIL vérifie que le string fourni est un email
                $contenu .= '<div class="alert alert-danger"> l\'email n\'est pas valide</div>';
            }
     

      if(!isset($_POST['ville']) || strlen($_POST['ville']) < 1 || strlen($_POST['ville']) > 20){ // si le prenom n'éxiste pas dans $_POST c'esy que la formilaire est altéré, ou si sa valeur est < 1 ou si sa valeur est  > 20 (pour la BDD), on met un message d'erreur a l'internaute.
        $contenu .= '<div class="alert alert-danger"> le ville doit contenir entre 4 et 20 caracteres.</div>';
      }

      if(!isset($_POST['adresse']) || strlen($_POST['adresse']) < 1 || strlen($_POST['adresse']) > 50){ // si le prenom n'éxiste pas dans $_POST c'esy que la formilaire est altéré, ou si sa valeur est < 1 ou si sa valeur est  > 20 (pour la BDD), on met un message d'erreur a l'internaute.
        $contenu .= '<div class="alert alert-danger"> l\'adresse doit contenir entre 4 et 20 caracteres.</div>';
      }

      if(!isset($_POST['civilite']) || ($_POST['civilite'] !='m' && $_POST['civilite'] !='f')){
        $contenu .= '<div class="alert alert-danger"> la civilité n\'est pas valide.</div>';

      }

      if(!isset($_POST['code_postal']) || !preg_match('#^[0-9]{5}$#',$_POST['code_postal']) ){
        $contenu .= '<div class="alert alert-danger"> le code postal n\'est pas valide.</div>';
      }


      //-----------
      //S'il n'y a plus d'erreur sur le formulaire, on verifie si le pseudo exsiste ou pas avant d'inscrir l'internaute en BDD :
        if(empty($contenu)) {// si la variable est vide c'est qu'il ny a pas de message d'erreur
            //On vérifie le pseudo en BDD :
                $resultat = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo",array(':pseudo' => $_POST['pseudo']));

                if($resultat->rowCount() > 0) {// si la requete retourne 1 ou plusieur ligne c'est que le pseudo est deja en BDD
                    $contenu .= '<div class="alert alert-danger"> pseudo indisponible veuillez en choisir un autre.</div>';

                }else{
                    //sinon on fait l'inscription en BDD
                    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);//Nous hachons le mot de passe avec l'algorithme bcrypt par défaut qui nous retourne une clé de hachage. nous allons l'insérer en BDD
                    //debug($mdp);
                    $succes = executeRequete(
                      "INSERT INTO membre(pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse, statut) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, :ville, :code_postal, :adresse, :statut)",

                      array(':pseudo'      => $_POST['pseudo'],
                            ':mdp'         => $mdp, // on prend le mot de passe haché
                            ':nom'         => $_POST['nom'],
                            ':prenom'      => $_POST['prenom'],
                            ':email'       =>$_POST['email'],
                            ':civilite'    =>$_POST['civilite'],
                            ':ville'       =>$_POST['ville'],
                            ':code_postal' =>$_POST['code_postal'],
                            ':adresse'     =>$_POST['adresse'],
                            ':statut'        =>0 // 0 pour un membre admin

                    ));

                    $contenu .= '<div class=" alert alert-success">Vous etes inscrit.<a href="connexion.php">Cliquez ici pour vous connecter.</a></div>';
                    $affiche_formulaire = false; // pour ne plus afficher le formulaire d'inscription ci-dessous



                }


        }//fin du if empty contenue

}// fin de if (!empty($_POST))

//-------------------------------------------------------------------------------------------------------//

require_once 'inc/header.php';
?>
<h1 class="mt-4">Inscription</h1>
<?php
echo $contenu; // pour les message a l'internaute
if ($affiche_formulaire) : // syntaxe en if (): ... endif; ou le ":" correspond a l'accolade ouvrante et endif a la fermante.si le membre n'est pas inscit, on lui affiche le formulaire.
 ?>
 <form method="post" action="">

 <div><label for="pseudo">Pseudo</label></div>
 <div><input type="text" name="pseudo" id="pseudo" value="<?php echo $_POST['pseudo'] ?? '';?>"></div>

 <div><label for="mdp">Mot de passe</label></div>
 <div><input type="password" name="mdp" id="mdp" value="<?php echo $_POST['mdp'] ?? '';?>"></div>

 <div><label for="nom">nom</label></div>
 <div><input type="text" name="nom" id="nom" value="<?php echo $_POST['nom'] ?? '';?>"></div>

 <div><label for="prenom">prénom</label></div>
 <div><input type="text" name="prenom" id="prenom" value="<?php echo $_POST['prenom'] ?? '';?>"></div>

 <div><label for="email">Email</label></div>
 <div><input type="text" name="email" id="email" value="<?php echo $_POST['email'] ?? '';?>"></div>

 <div><label>Civilité</label></div>

 <div>
 <input type="radio" name="civilite" value="m" checked>Masculin
 <input type="radio" name="civilite" value="f" <?php if (isset($_POST['civilite']) && $_POST['civilite'] == 'f')echo 'checked';  ?> >Feminin<!--cheked permet de cocher une case--->
</div>


<div><label for="ville">ville</label></div>
 <div><input type="text" name="ville" id="ville" value="<?php echo $_POST['ville'] ?? '';?>"></div>

 <div><label for="code_postal">code postal</label></div>
 <div><input type="text" name="code_postal" id="code_postal" value="<?php echo $_POST['code_postal'] ?? '';?>"></div>

 <div><label for="adresse">Adresse</label></div>
 <div><textarea name="adresse" id="adresse" cols="30" rows="10"> <?php echo $_POST['adresse'] ?? '';?> </textarea></div>

 <div><input type="submit" value="S'inscrire" class="btn btn-info"></div>

 
 </form>


<?php
endif; // ferme le if()
require_once 'inc/footer.php';
