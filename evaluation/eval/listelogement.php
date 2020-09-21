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
$contenu.= '<th> substr($lui, 0, 10)$lui=description</th>';// j'ai essayer, je revien dessu apres si le temps me le permet
$contenu.= '</tr>';



$resultat = $pdo->query("SELECT * FROM logement");
$contenu .= "nombre de logement : " . $resultat->rowCount() . '<br>';


//debug($resultat);

while($contact = $resultat->fetch(PDO::FETCH_ASSOC)){
	 
	$contenu .= '<tr>';
	foreach ($contact as $indice => $donnee  ){ // $indice  est l'indice a gauche du tableau et $donnee est la veleur du tabealu a droite

		

//debug($contact);
		//traitement de la photo

		if($indice == 'photo'){//si indice = valeur "photo" 
    
			$contenu .='<td><img src="../'.$donnee.'" style="width:80px"></td>'; 
			
	
		  }else{// pas de balise img pour les autre colonnes
			  $contenu .= '<td>' . $donnee . '</td>';
		   }
		   
		
           


        
	}

  $contenu .= '<td><a href="detaille_logement.php?id_logement='. $contact['id_logement'].''. '">voir</a></td>';
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

span {
  width: 200px;
  border: 1px solid;
  padding: 2px 5px;

  /* Nécessaires pour text-overflow */
  white-space: nowrap;
  overflow: hidden;
}

span overflow-visible {
  white-space: initial;
}

span overflow-clip {      /* jai essayer de couper avec le css mais je n'est pas u assez de temps pour trouver la bonne methode */
  text-overflow: clip;
}

span overflow-ellipsis {
  text-overflow: ellipsis;
}

span overflow-string {
  /* Cette forme n'est pas prise en charge
    par la plupart des navigateurs. cf. la 
    section Compatibilité ci-après */
  text-overflow: " [..]"; 
}





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