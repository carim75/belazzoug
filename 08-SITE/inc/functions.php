<?php
//Fonction du site 

function debug($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

//---------------
//fonction qui indique si l'internaute est connecté
function estConnecte()
{
    if (isset($_SESSION['membre'])) { // si "membre" existe dans la session, c'est que l'internaute est passer par la page de connection avec les bon pseudo/ mdp

        return true; // il est connecté

    } else {
        return false; // il n'esp pa connecté
    }
}

// fonction qui induqye si le membre connecté est administrateur
function estadmin()
{
    if (estConnecte() && $_SESSION['membre']['statut'] == 1) { // si le membre est connecté alors on regarde son statut dans la session. S'il vaut 1 alors il est bien admin.
        return true; // le membre est admin connecté
    } else {
        return false; // il ne l'est pasF
    }
}



//-------------------------
// fonction qui exécute les requetes
//$resultat = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo",array(':pseudo' => $_POST['pseudo']));

function executeRequete($requete, $param = array()){// le parametre $requete reçoit une requete SQL. Le paramètre $param reçoit un tableau avec les marqueur associés a leur valeur. Dans le cas ou ce tableau n'est pas fourni, $param prend un array() vide par defaut.

    //Echappement des données avec htmlspecialchars() :

    foreach($param as $indice => $valeur) {
        //$param[$indice] est la boite et la $valeur le contenue
        $param[$indice] = htmlspecialchars($valeur);// on prend la valeur de $param que l'on passe dans htmlspecialchars() pour transformer les chevrons en entités HTML qui neutralisent les balises <style> et <script> éventuellement injectées dans le formulaire. Evite les risques XSS et CSS. Puis on range cette valeur échappée dans son emplacement d'origine qui est $param[$indice].

    }

    global $pdo; //permet d'acceder a la variable $pdo qui est déclarée dans init.php autrement dit dans l'espace global ( nous somme ici dans un espace local)
    $resultat = $pdo->prepare($requete);// on prepare la requete reçu dans $requete
    $succes = $resultat->execute($param);// puis on l'execute en lui donnant le tableau qui associe les marqueur a leur valeur

    var_dump($succes);//execute() renvoie toujour un booléen : true quand la requete a marché, sinon false.

    if($succes){// si $succes contient true ( la requete a marché), je retourne alores $resultat qui contient le jeux de resultat du SELECT(objet PDOStatement)
        return $resultat;

    }else{
        return false;//sinon,si erreu sur la requete, on retourne false.
    }
}

//-----

//--------    FONCTION QUI CALCULE  le total du panier (panier.php)
function montantTotal(){
    $total = 0;

    for ($i = 0; $i < count($_SESSION['panier']['id_produit']);   $i++) {
        $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i]; //on multiplie la quantite par le prix a chaque tour de boucle que l'on ajoute dans $total avec l'operateur += pour ne pas écraser la derniere valeur.  
        
        
    }
return $total;// pour sortire la valeur $total de la fonction et la retourner a l'endroit ou on appelle cette fonction (dans le panier)

}
