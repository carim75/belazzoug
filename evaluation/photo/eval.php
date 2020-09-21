<?php

use function PHPSTORM_META\type;

$contenu = '';// declaration de $contenu qui est relié a la ligne 169.


function debug($var)
{
    echo '<pre>';
    print_r($var);// fonction debug
    echo '</pre>';
}

//debug($_POST);


$pdo = new PDO(
	'mysql: host=localhost;dbname=immobilier',
	'root',
	'',
	array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'


	)

);

print_r($_POST);


if (!empty($_POST)) {//si le formulaire a été envoyé
	if (!isset($_POST['titre']) || strlen($_POST['titre']) < 2 || strlen($_POST['titre']) > 50) {

		$contenu .= '<div> le titre doit contenir minimum 2 caractere.</div>';
	}
    
	if (!isset($_POST['adresse']) || strlen($_POST['adresse']) < 2  || strlen($_POST['adresse']) > 50) {

		$contenu .= '<div> l\'adresse doit contenir minimum 2 caractere.</div>';
    }



if (!isset($_POST['ville']) || strlen($_POST['ville']) < 2  || strlen($_POST['ville']) > 50) {

   $contenu .= '<div> la ville doit contenir minimum 2 caractere.</div>';
}
    


     
	if (!isset($_POST['cp']) || strlen($_POST['cp']) < 2 || strlen($_POST['cp']) > 50) {
		$contenu .= '<div> le code postal n\'est pas valide.</div>';
    }
    
    if (!isset($_POST['surface']) || strlen($_POST['surface']) < 2  || strlen($_POST['surface']) > 50) {

        $contenu .= '<div> la suface doit contenir minimum 2 caractere.</div>';
     }

  
   if (!isset($_POST['prix']) || strlen($_POST['prix']) < 2 || ($_POST['prix']) > 255) {
    $contenu .= '<div> le prix n\'est pas valide.</div>';
}

  
	 
	//type contact
	if (!isset($_POST['type']) || ($_POST['type'] != 'location' && $_POST['type'] != 'vente')) {
		$contenu .= '<div> la type de contact n\'est pas valide.</div>';
	}


       //--------------------------------------On echape les caractere speciaux


	if (empty($contenu)) {

		$_POST['ville'] = htmlspecialchars($_POST['ville'], ENT_QUOTES);// transforme chevrons en entités HTML pour éviter les risques XSS et CSS.
		$_POST['adresse'] = htmlspecialchars($_POST['adresse'], ENT_QUOTES);
		$_POST['ville'] = htmlspecialchars($_POST['ville'], ENT_QUOTES);
		$_POST['cp'] = htmlspecialchars($_POST['cp'], ENT_QUOTES);
		$_POST['surface'] = htmlspecialchars($_POST['surface'], ENT_QUOTES);
		$_POST['prix'] = htmlspecialchars($_POST['prix'], ENT_QUOTES);
		$_POST['type'] = htmlspecialchars($_POST['type'], ENT_QUOTES);


		 
			
			}


		//------------------------------je traite la photo uniquement s'il n'y a pas derreur sur le formulaire---------------------------------


		$photo_bdd = '';//declaration de $photo_bdd
       debug($_FILES);
		if (!empty($_FILES['photo']['name'])) { //si un fichier est en cours d'upload

			

			$photo_bdd = 'photoss/' .  $_FILES['photo']['name']; // chemain + nom du fichier de la photo que l'on met en BDD. ne pas oublier de créer le dossier "photo"


			copy($_FILES['photo']['tmp_name'], '../' . $photo_bdd);//copie la photo qui est temporairement dans $_FILES['photo']['tmp_name'] vers l'emplacement d"finie par $photo_bdd

		}




		$resultat = $pdo->prepare("INSERT INTO logement (titre, adresse, ville, cp, surface, prix, photo, type, description ) VALUES (:titre, :adresse, :ville, :cp, :surface, :prix, :photo, :type, :description )"); // pour rentrer dans la table contacte phpmyadmine on mest contacte

		$succes = $resultat->execute(array(
			':titre'             => $_POST['titre'],
			':adresse'           => $_POST['adresse'],
			':ville'              => $_POST['ville'],
			':cp'          => $_POST['cp'],
			':surface'            =>$_POST['surface'], 
			':prix'              => $_POST['prix'],
			':photo'            => $photo_bdd,
			':type'            => $_POST['type'],
			':description'   => $_POST['description']

		));

		if ($succes) { // si executeRequete a retourné un objet PDOStatement, donc implicitement evalué a true, alors c que la requete a marcher
			$contenu .= '<div>Le logement a été enregistré.</div>';
		} else { //sinnon dans le cas contraire, executeRequete nous a retourné False
			$contenu .= '<div>erreur l\'hors de l\'enregistrement.</div>';
		}


    }//fermeture du if $_post
    
    ?>






    
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>logement</title>
</head>

<body>
<?php echo $contenu;?><!-- affcichage echo $contenu toujours apres le "<body>" d'ouverture-->

	<form method="post" enctype="multipart/form-data" > <!--enctype pour que le formulaire puisse envoyer les données du fichier uploadé-->
		<div>
			<label for="titre">titre :</label>
			<input type="text" id="name" name="titre">
		</div><br>
		<div>
			<label for="adresse">adresse :</label>
			<input type="text" id="adresse" name="adresse">


		</div><br>
		<div>
			<label for="ville">ville :</label>
			<input type="text" id="ville" name="ville">

		</div><br>
		<div>
			<label for="cp">code postal</label>
			<input type="text" id="cp" name="cp">
		</div><br>

		<div>

        <div>
			<label for="surface">surface:</label>
			<input type="text" id="surface" name="surface">
		</div><br>

		<div>

      
       <div>
        <label for="prix">prix:</label>

        <input type="text" id="prix" name="prix"
         min="100" max="100000000">
       </div></br>

        <div>

			<label for="type">type</label>
			<input type="text" id="type" name="type">

		</div><br>
		<div>

        <div>
			<label for="description">description</label>
			<input type="text" id="description" name="description">

		</div><br>
		<div>

        




			<label for="pet-select"></label>

			<select name="type" id="type">


				<option value="location">location</option>
				<option value="vente">vente</option>
			

			</select>



			<div><label for="photo">Photo</label></div>
			<input type="file" name="photo" id="photo">
            <input type="submit" value="enregistrer"><br>
            

	</form>

</body>

</html>