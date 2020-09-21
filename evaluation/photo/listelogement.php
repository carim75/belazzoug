<?php


$contenu='';

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


$contenu .= '<table>';// debut table

echo'<tr>';

$contenu.= '<th>Id</th>';
$contenu.= '<th>titre</th>';
$contenu.= '<th>adresse</th>';
$contenu.= '<th>ville</th>';// en-tete
$contenu.= '<th>cp</th>';
$contenu.= '<th>surface</th>';
$contenu.= '<th>prix</th>';
$contenu.= '<th>photo</th>';
$contenu.= '<th>type</th>';
$contenu.= '<th class="overflow-clip">description</th>';
$contenu.= '</tr>';



$resultat = $pdo->query("SELECT * FROM logement");
$contenu .= "nombre contact : " . $resultat->rowCount() . '<br>';


debug($resultat);

while($contact = $resultat->fetch(PDO::FETCH_ASSOC)){
	 
	$contenu .= '<tr>';
	foreach ($contact as $indice => $donnee  ){ // $indice  est l'indice a gauche du tableau et $donnee est la veleur du tabealu a droite

		

//debug($contact);
		//traitement de la photo

		if($indice == 'photoss'){//si indice = valeur "photo" 
    
			$contenu .='<td><img src="/'.$donnee.'" style="width:80px"></td>'; // affiche la valeur donné avec la photo attantion ici mon dossier photop est dans le dossier parent donc../ a coter du dossier sujet
			
	
		  }else{// pas de balise img pour les autre colonnes
			  $contenu .= '<td>' . $donnee . '</td>';
		   }
		   
		
		   


        
	}

   // $contenu .= '<td><a href="detail_contact.php?id_contact='. $contact['id_contact'].''. '">modifier</a></td>'; //id_contact est l'indice qui se trouvant dans le tableau $contenu qui contient les valeur de nos contacte quand a insere

	$contenu.=  '</tr>';




}
$contenu .='</table>';// fin table


?>


<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>liste des logement</title>


<style>

table,th,tr,td{
    border: 1px solid;
}
table{
    border-collapse: collapse;
}

</style>



</head>

<body>


	<h1>Liste des logement</h1>

	
<?php echo $contenu;?>






	
</body>
</html>


<?php