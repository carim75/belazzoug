<h1>Les commerciaux et leur salaire</h1>


<?php


$pdo = new PDO('mysql: host=localhost;dbname=entreprise',// driver mysql, serveur de la BDD (host), nom de la BDD(dbname) a changer
               'root',// pseudo de la BDD
               '',// root pour MAC 'mot de passe de la BDD
               array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,  // option1 : on affiche les erreurs SQL
                PDO:: MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'  // option2: on definnit le jeu de caracteres des echanges avec la BDD
                



               )



);


function debug($var){
    echo'<pre>';
    print_r($var);
    echo'</pre>';

//Exercice :
//1-affichez dans  une liste <ul><li>le prenom,le nomm et le salaire des commerciaux( 1 commercial par <li>).pour cela , vous faites une requete preparée.



}
$service = 'commercial';




$resultat = $pdo->prepare("SELECT prenom, nom, salaire FROM employes WHERE service =:service");

$resultat->bindParam(':service', $service);

$resultat->execute();


$service =$resultat->fetchAll(PDO::FETCH_ASSOC);
debug($resultat);

echo '<ul>';// on met le <ul> en dehors de la boucle pour ne pas le répéter car on veut qu'une seul liste
foreach($service as  $value){


   echo '<li>' . $value['prenom'] .' '. $value['nom'] .' '.$value['salaire'] .'</li>';
    
   

}
 echo '</ul><hr>';

//2-affichez le nombre de commerciaux.
echo'Nombre de comercieaux : ' .$resultat->rowCount() . '<br>';






