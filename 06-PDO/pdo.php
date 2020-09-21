<?php
//-------------------------------------------
//                 PDO
//-------------------------------------------
//L'extension PDO, pour PHP Data Object, definie une interface pour acceder a une base de données depuis PHP, et permet d'y exécuter des requetes SQL

function debug($var){
    echo'<pre>';
    print_r($var);
    echo'</pre>';



}

//--------------------------------------------------------------
echo '<h2>Connection a la BDD</h2>';
//--------------------------------------------------------------

$pdo = new PDO('mysql: host=localhost;dbname=entreprise',// driver mysql, serveur de la BDD (host), nom de la BDD(dbname) a changer
               'root',// pseudo de la BDD
               '',// root pour MAC 'mot de passe de la BDD
               array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,  // option1 : on affiche les erreurs SQL
                PDO:: MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'  // option2: on definnit le jeu de caracteres des echanges avec la BDD
                



               )



);
//$pdo est un objet qui provient de la classe predefinie PDO et qui represente la connection a la base de donné






//--------------------------------------------------------------
echo '<h2> Requetes avec exec() </h2>';
//--------------------------------------------------------------
// Nous inséron un employé:

if(empty($contenu))


*/

echo "nombre d'enregistrement affectés par L'INSERT : $resultat <br>";
echo "dernier ID généré en BDD : " . $pdo->lastInsertId();

//------
$resultat = $pdo->exec("DELETE FROM employes WHERE prenom ='test'");
echo " nombre d'enregistrements affectés par le DELETE : $resultat <br>";



//--------------------------------------------------------------
echo '<h2> Requetes avec query() et fetch() pour un seul resulat </h2>';
//--------------------------------------------------------------

$resultat = $pdo->query("SELECT * FROM employes WHERE  prenom ='daniel'");//Au contraire de exec(), query() est utilisé pour la formulation de requetes qui retournent un ou plusieurs resultat : SELECT.
//Valeur de retour
//    succes: query() retourne un OBJET qui provient de la classe PDOstatement
//    echec : false 
debug($resultat); // $resultat est le resultat de la requete de selection sous forme inexploitable directement. en effet nous ne voyons pas les information de Daniel. POur acceder a ces information il nous faut utiliser la methode fetch()'va checher' 

$employe = $resultat->fetch(PDO::FETCH_ASSOC); // la methode fetch() avec le parametre PDO::FETCH_ASSOC retourne un tableau associatif exploitable dans les indice corespende aux nom des champs de la requete, se tableau contient les données de Daniel.
debug($employe);
echo'je suis' . ' ' . $employe['prenom'] . ' ' . $employe ['nom'] . 'du service' . ' ' . $employe['service'] . '<br>';

// On peut aussi utiliser les methodes suivantes :
// 1
$resultat = $pdo->query("SELECT * FROM employes WHERE  prenom ='daniel'");
$employe = $resultat->fetch(PDO::FETCH_NUM); // ici pour obtenir un tableau indexé numeriquement
debug($employe);
echo'je suis' . $employe[1] . ' ' . $employe[2] . 'du service' .$employe[4] . '<br>';

//2
$resultat = $pdo->query("SELECT * FROM employes WHERE  prenom ='daniel'");
$employe = $resultat->fetch();// pour obtenir un melange de tableau assosiatif et numerique 
debug($employe);

// 3
$resultat = $pdo->query("SELECT * FROM employes WHERE  prenom ='daniel'");
$employe = $resultat->fetch(PDO::FETCH_OBJ);//retourne un objet avec le nom des champs comme proprieté publiques
debug($employe);
echo'je suis' . ' ' . $employe->prenom . ' ' . $employe->nom .' '. 'du service' . ' ' . $employe->service . '<br>';

//Note : vous ne pouvez pas fair plusieur fetch() sur le meme resultat, ce pourquoi nous répétons ici la requete.
//Exercice:
//Afiichez le service de lemployes dont l'id_employes est 417.
$resultat = $pdo->query("SELECT service FROM employes WHERE  id_employes = 417");
$service = $resultat->fetch(PDO::FETCH_OBJ);
debug($service);
echo $service->service;






//--------------------------------------------------------------
echo '<h2> Requetes avec query() et fetch() pour plusieur resultats </h2>';
//--------------------------------------------------------------

$resultat = $pdo->query("SELECT * FROM employes");
echo"nombre d'employes : " . $resultat->rowCount() . '<br>'; // compte le nombre de ligne dans l'objet $resultat (contexte : nombre de produits dans une boutique).

debug($resultat);

//comme nous avons plusieur lignes dans $resultat, nous devons faire une boucle pour les parcourir :
while($employe = $resultat->fetch(PDO::FETCH_ASSOC)){//fetch() va chercher la ligne "suivante" du jeux de resulat qui retourne en tableau associatif. la boucle while permet de fir avancé le curseur dans la table et s'arrete quand le curseur a fait un tour complet( quand fetch retourne false).

           debug($employe);//$employe est un tableau associatif qui contient les données de 1 employé par tour de boucle. 

           echo '<div>';
           echo '<div>' . $employe['prenom'] .'</div>';
           echo '<div>' . $employe['nom'] .'</div>';
           echo '<div>' . $employe['service'] .'</div>';
           echo '<div>' . $employe['salaire'] .'</div>';
           echo '</div><hr>';


}









//--------------------------------------------------------------
echo '<h2> La méthode fetchAll()</h2>';
//--------------------------------------------------------------
$resultat = $pdo->query("SELECT * FROM employes");

$donnees =$resultat->fetchAll(PDO::FETCH_ASSOC);// fetchAll() retourne toute les lignes de $resultat dans un tableau multidimensionnel : on a 1 tableau associatif 'par employé' rangé a chaque indice numérique. pour info, on peut aussi faire FETCH_NUM pour un sous tableau numérique, ou un fetcchAll() sans parametre pour un sous tableau numerique et associatif.

debug($donnees);// il s'agit d'un tableau multidimentionnelle
echo'<hr>';

//on parcourt le tableau $donnees avec une boucle foreach pour en afficher le contenu :
foreach($donnees as $indice => $employe){//$employeest lui meme un tableau. On accede donc a ses valeur par les indices entre [].
    //debug($employe);

    
    echo '<div>';
    echo '<div>' . $employe['prenom'] .'</div>';
    echo '<div>' . $employe['nom'] .'</div>';
    echo '<div>' . $employe['service'] .'</div>';
    echo '<div>' . $employe['salaire'] .'</div>';
    echo '</div><hr>';



}

//--------------------------------------------------------------
echo '<h2> Exercice </h2>';
//--------------------------------------------------------------
//affichez la liste des DIFFERENTS service dans une seule liste <ul> et avec un <li>. 

$resultat = $pdo->query("SELECT DISTINCT service FROM employes");
$service =$resultat->fetchAll(PDO::FETCH_ASSOC);
debug($service);

echo '<ul>';// on met le <ul> en dehors de la boucle pour ne pas le répéter car on veut qu'une seul liste
foreach($service as  $value){


   echo '<li>' . $value['service'] .'</li>';
    
   

 





}
 echo '</ul><hr>';

 //version en while

echo '<ul>';
$resultat = $pdo->query("SELECT DISTINCT service FROM employes");// ne pas oublier de refaire la requete avant un nouveau fetch, sinon on est deja hors du jeux de resultat et donc il n'y a plus rien a recuperer.
 while($employe = $resultat->fetch(PDO::FETCH_ASSOC)){
   echo '<li>' . $employe['service'] . '</li>';

 }
 echo '</ul>';

 //--------------------------------------------------------------
echo '<h2> table HTML </h2>';
//--------------------------------------------------------------
//on veut afficher dynamiquement le jeu de résultat sous forme de table HTML.

$resultat =$pdo->query("SELECT * FROM employes");// $ resulutat est un objet PDOStatement qui est retourné par la methode query. il contient le jeux de resultat qui represente tout les employe.


?>

<style>
table,th,tr,td{
    border: 1px solid;
}
table{
    border-collapse: collapse;
}



</style>





<?php
echo'<table>';
//Affichage de la ligne d'entete :
echo'<tr>';

echo '<th>Id</th>';
echo '<th>prenom</th>';
echo '<th>nom</th>';
echo '<th>sexe</th>';
echo '<th>service</th>';
echo '<th>date embauche</th>';
echo '<th>salaire</th>';
echo'</tr>';

//Affichage des lignes :
while($employe = $resultat->fetch(PDO::FETCH_ASSOC)){//a chaque tour de boucle de while, fetch()va chercher la ligne suivante qui correspond a 1 employé et retourne ses information sous forme de tableau assosiatif.comme il sagit d'un tableau, nous feson une boucle foreach pour le parccourir

    echo'<tr>';
    foreach($employe as $donnee){// forech parcour les donné de l'employé, et les affiche en colonne(dans les <td>).

        echo'<td>' . $donnee . '</td>';
    }
       
    
    echo'</tr>';
     
}

echo'</table>';














 //----------------------------------
 echo '<h2>Requetes préparées </h2>';
 //----------------------------------

 //les requetes préparées sont préconisées si vous executez plusieur fois la meme requete et ainsi éviter de répéter le cycle complet analyse / interpretatiion/ éxecution réalisé par la SGBD (gain de performence).
 // les requetes préparées sont aussi utilisé pour assainir les données( se prémunir des injections SQL) => chapitre suivent.

 $nom ='Sennard';

 //une requete preparer se realise en 3 étapes:
 //1- on prepare la requete :
 $resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom");//prepare() permet de preparer la requete mais ne l'execute pas. :nom est un marqueur nominatifqui est vide et attand une valeur.

 //2-On relie le marqueur a sa valeur :
 $resultat->bindParam(':nom', $nom);// binParam() lie le marqueur :nom a la variable $nom. Remarque : cette méthode reçois exclusivement une variable en secon argument. On ne peu pas y mettre une valeur directement.

 //ou alors:
 $resultat->bindValue(':nom','Sennard');// bindValue() relie le marqueur :nom a la valeur 'Sennard'.contrairement a bindParam(), bindValue() reçoit au choix une valeur ou une variable.


 //3- on éxecute la requete :
 $resultat->execute(); //permet d'éxecuter une requete préparer avec prepare()

 debug($resultat);


 $employe = $resultat->fetch(PDO::FETCH_ASSOC);
 echo $employe['prenom']. ' ' . $employe['nom'] . ' du service' .$employe ['service'] . '<br>';

 /*
 Valeur de retour :

          prepare() retourne toujours un objetPDOStatement
          execute():
                  succès : true
                  echec : false

 */




 







  //----------------------------------
  echo '<h2>Requetes préparées : poin complementaire </h2>';
  //----------------------------------




  echo'<h3>le marqueur sous forme de "?""</h3>';
  $resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = ? AND prenom = ?");// on prepare la requete avec les partit variable representer avec des marqueurs sous forme de "?"

  $resultat->bindValue(1,'durand'); // 1 represente le premier "?"
  $resultat->bindValue(2,'damien'); // 2 represente le second "?"
  $resultat->execute();

  //OU encore directement dans le execute():
  $resultat->execute(array('durand','damien'));//dans lordre, "durand" remplace le premier "?"et "Damien" le second.

  /*
  la fleche -> caracterise les objets : $objet->methode();
  les crochets [] caractérisent les tableaux : $tableau['indice'];
  */
  $employe = $resultat->fetch(PDO::FETCH_ASSOC);
  debug($employe);
  echo ' le service est ' .$employe [ 'service' ] . '<br>';

  //





  echo '<h3>lies les marqueur nominatif directement dans execute()<h3>';





  $resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom AND prenom = :prenom");
  $resultat->execute(array(':nom' => 'chevel' ,':prenom' => 'Daniel'));// on associe chaque marqueur a sa valeur directement dans un tableau. note : nous ne somme pas obliger de remettre les ':' devant les marqueur dans ce tableau.

  $employe = $resultat->fetch(PDO::FETCH_ASSOC);
  echo ' le service est ' .$employe [ 'service' ] . '<br>';






  //*********************************************************************FIN   *******************************************************************************************************/












