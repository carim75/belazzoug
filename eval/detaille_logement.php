<?php

function debug($var)
{
    echo '<pre>';
    print_r($var);// fonction debug
    echo '</pre>';
}

$pdo = new PDO(
	'mysql: host=localhost;dbname=immobilier', //la base de donné sapelle repertoir
	'root',
	'',
	array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'


	)

);
//debug($_GET);

if(isset($_GET['id_logement'])){

   
   $_GET['id_logement'] = htmlspecialchars($_GET['id_logement'],ENT_QUOTES); 


   

   $resultat = $pdo->prepare("SELECT * FROM logement WHERE id_logement = :id_logement");

   $resultat->execute(array("id_logement" => $_GET['id_logement']));

   $contact = $resultat->fetch(PDO::FETCH_ASSOC); 

  // debug($resultat);

}


?>


<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Detail du logement</title>
</head>
<body>

<?php 

 

if(empty($contact)){// si $contact est vide on affiche le message en dessu
   echo'<p>logement inexitant</p>';



}else{

echo '<div><img src="../'. $contact['photo'] .'" style="width:200px"></div>';
echo '<h1>' . $contact['titre']. ' ' . $contact['adresse'] . '</h1>';
echo '<h2> ville :' . $contact['ville'].'</h2>';
echo '<h2>prix:' . $contact['prix'].'</h2>';
echo '<h2>Type:' . $contact['type'].'</h2>';
echo '<h2>surface:' . $contact['surface'].'</h2>';
echo '<h2>description:' . $contact['description'].'</h2>';
echo '<h2>code postal:' . $contact['cp'].'</h2>';

}




?><!--fermeture du php-->


   
</body>
</html>