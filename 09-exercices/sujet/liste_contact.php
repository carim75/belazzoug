<?php
/*
	1- Afficher dans une table HTML la liste des contacts avec tous les champs.
	2- Le champ photo devra afficher la photo du contact en 80px de large.
	3- Ajouter une colonne "Voir" avec un lien sur chaque contact qui amène au détail du contact (detail_contact.php).

*/

$contenu='';

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








$contenu .= '<table>';// debut table

echo'<tr>';

$contenu.= '<th>Id</th>';
$contenu.= '<th>nom</th>';
$contenu.= '<th>prenom</th>';
$contenu.= '<th>telephone</th>';// en-tete
$contenu.= '<th>email</th>';
$contenu.= '<th>type</th>';
$contenu.= '<th>photo</th>';
$contenu.= '<th>voir</th>';
$contenu.= '</tr>';



$resultat = $pdo->query("SELECT * FROM contact");
$contenu .= "nombre contact : " . $resultat->rowCount() . '<br>';


debug($resultat);

while($contact = $resultat->fetch(PDO::FETCH_ASSOC)){
	 
	$contenu .= '<tr>';
	foreach ($contact as $indice => $donnee  ){ // $indice  est l'indice a gauche du tableau et $donnee est la veleur du tabealu a droite

		

//debug($contact);
		//traitement de la photo

		if($indice == 'photo'){//si indice = valeur "photo" 
    
			$contenu .='<td><img src="../'.$donnee.'" style="width:80px"></td>'; // affiche la valeur donné avec la photo attantion ici mon dossier photop est dans le dossier parent donc../ a coter du dossier sujet
			
	
		  }else{// pas de balise img pour les autre colonnes
			  $contenu .= '<td>' . $donnee . '</td>';
		   }
		   
		
		   


        
	}

    $contenu .= '<td><a href="detail_contact.php?id_contact='. $contact['id_contact'].''. '">modifier</a></td>'; //id_contact est l'indice qui se trouvant dans le tableau $contenu qui contient les valeur de nos contacte quand a insere

	$contenu.=  '</tr>';




}
$contenu .='</table>';// fin table


?>


<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>liste des contacte</title>


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


	<h1>Liste de contacte</h1>

	
<?php echo $contenu;?>






	
</body>
</html>


<?php
/*
	1- Afficher dans une table HTML la liste des contacts avec tous les champs.
	2- Le champ photo devra afficher la photo du contact en 80px de large.
	3- Ajouter une colonne "Voir" avec un lien sur chaque contact qui amène au détail du contact (detail_contact.php).


$pdo = new PDO('mysql:host=localhost;dbname=repertoire', 'root', '',  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' ));


function debug($var) {
    echo '<pre>';
        print_r($var);
    echo '</pre>';
}

// Requête
$resultat = $pdo->query("SELECT * FROM contact");


?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
    table, th, tr, td {
        border: 1px solid;
    }
    table {
        border-collapse: collapse;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

</style>
	<title>Liste des contacts</title>
</head>
<body>
	<h1>Mes contacts</h1>
	<table>
		<tr>
			<th>#</th>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Téléphone</th>
			<th>Email</th>
			<th>Type</th>
			<th>Photo</th>
			<th>Voir</th>
		</tr>
		
		<?php
		while ($contact = $resultat->fetch(PDO::FETCH_ASSOC)) {
			// debug($contact);
			
			echo '<tr>';
				foreach ($contact as $indice => $valeur) {

					if ($indice == 'photo') {
						echo '<td><img src="'. $valeur . '" style="width:80px"></td>';			
					} else {
						echo '<td>' . $valeur . '</td>';
					}
				}

				echo '<td><a href="detail_contact.php?id_contact='. $contact['id_contact'] .'">détail</a></td>'; // on envoie à la page detail_contact.php l'identifiant du contact "id_contact". Sa valeur se trouve dans le tableau $contact qui contient un indice "id_contact" d'après le debug fait ligne 63.

			echo '</tr>';
		}
		?>
	</table>
	
</body>
</html>
*/