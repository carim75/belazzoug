<?php
/*
   1- Vous affichez le détail complet du contact demandé, y compris la photo. Si le contact n'existe pas, vous laissez un message. 

*/
function debug($var)
{
    echo '<pre>';
    print_r($var);// fonction debug
    echo '</pre>';
}

$pdo = new PDO(
	'mysql: host=localhost;dbname=repertoir', //la base de donné sapelle repertoir
	'root',
	'',
	array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'


	)

);
debug($_GET);

if(isset($_GET['id_contact'])){//si id_contact est dans l'URl c'est quand a demander le detaille du contact

   // echappement des donné
   $_GET['id_contact'] = htmlspecialchars($_GET['id_contact'],ENT_QUOTES); //POUR SE prémunir des risque xss et css (les chevrons sont transformés en entiés HTML)


   //requete preparer car le $_GET vien de l'internaute

   $resultat = $pdo->prepare("SELECT * FROM contact WHERE id_contact = :id_contact");// marqueur vide

   $resultat->execute(array("id_contact" => $_GET['id_contact']));// on associe le marqueur a la valeur  qui passe par l'URl donc dans $_GET

   $contact = $resultat->fetch(PDO::FETCH_ASSOC); // on "fetch" l'objet $resultat pour aller chercher les données du contact qui sy trouve

   debug($contact);

}


?>


<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Detail de contacte</title>
</head>
<body>

<?php 

 echo'<h1 style="color: blue;">salut<h1>';

if(empty($contact)){// si $contact est vide on affiche le message en dessu
   echo'<p>contact inexitant</p>';



}else{// sinnon on affiche les information du contact

echo '<div><img src="../'. $contact['photo'] .'"></div>';
echo '<h1>' . $contact['prenom']. ' ' . $contact['nom'] . '</h1>';
echo '<h2> téléphone :' . $contact['telephone'].'</h2>';
echo '<h2>Email:' . $contact['email'].'</h2>';
echo '<h2>Type:' . $contact['type_contact'].'</h2>';

}




?><!--fermeture du php-->


   
</body>
</html>