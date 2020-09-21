<?php
/* 1- Créer une base de données "repertoire" avec une table "contact" :
	  id_contact PK AI INT
	  nom VARCHAR(50)
	  prenom VARCHAR(50)
	  telephone VARCHAR(10)
	  email VARCHAR(255)
	  type_contact ENUM('ami', 'famille', 'professionnel', 'autre')
	  photo VARCHAR(255)

	2- Créer un formulaire HTML (avec doctype...) afin d'ajouter un contact dans la bdd. 
	   Le champ type_contact doit être géré via un "select option".
	   On doit pouvoir uploader une photo par le formulaire. 
	
	3- Effectuer les vérifications nécessaires :
	   Les champs nom et prénom contiennent 2 caractères minimum, le téléphone 10 chiffres
	   Le type de contact doit être conforme à la liste des types de contacts
	   L'email doit être valide
	   En cas d'erreur de saisie, afficher des messages d'erreurs au-dessus du formulaire

	4- Ajouter les infos du contact dans la BDD et afficher un message en cas de succès ou en cas d'échec.
	5- Si une photo est uploadée, ajouter la photo du contact en BDD et uploader le fichier sur le serveur de votre site.

*/

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
	'mysql: host=localhost;dbname=repertoir', //la base de donné sapelle repertoir
	'root',
	'',
	array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'


	)

);




print_r($_POST);

if (!empty($_POST)) {//si le formulaire a été envoyé
	if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 50) {

		$contenu .= '<div> le nom doit contenir minimum 2 caractere.</div>';
	}
     //type prenom
	if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2  || strlen($_POST['prenom']) > 50) {

		$contenu .= '<div> le prenom doit contenir minimum 2 caractere.</div>';
	}

     //type telephone
	if (!isset($_POST['telephone']) || !preg_match('#^[0-9]{10}$#', $_POST['telephone'])) {// prreg_matche('#^[0-9]accepcte les chiffre de "0-9"{10}maximum "10chifre"$#')
		$contenu .= '<div> le numero n\'est pas valide.</div>';
	}

     //type email
	if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || strlen($_POST['email']) > 255) { // LA FONCTION predefinie filter_var() avec l'argument FILTER_VALIDATE_EMAIL vérifie que le string fourni est un email
		$contenu .= '<div> l\'email n\'est pas valide</div>';
	}
	 
	//type contact
	if (!isset($_POST['type_contact']) || ($_POST['type_contact'] != 'ami' && $_POST['type_contact'] != 'famille' && $_POST['type_contact'] != 'professionnel' && $_POST['type_contact'] != 'autre')) {
		$contenu .= '<div> la type de contact n\'est pas valide.</div>';
	}


       //--------------------------------------On echape les caractere speciaux


	if (empty($contenu)) {

		$_POST['nom'] = htmlspecialchars($_POST['nom'], ENT_QUOTES);// transforme chevrons en entités HTML pour éviter les risques XSS et CSS.
		$_POST['prenom'] = htmlspecialchars($_POST['prenom'], ENT_QUOTES);
		$_POST['telephone'] = htmlspecialchars($_POST['telephone'], ENT_QUOTES);
		$_POST['email'] = htmlspecialchars($_POST['email'], ENT_QUOTES);
		$_POST['type_contact'] = htmlspecialchars($_POST['type_contact'], ENT_QUOTES);


		    //ou alors avec une foreach :
			//foreach($_POST as $indice => $valeur){
			//$_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
			
			}


		//------------------------------je traite la photo uniquement s'il n'y a pas derreur sur le formulaire---------------------------------


		$photo_bdd = '';//declaration de $photo_bdd
        debug($_FILES);
		if (!empty($_FILES['photo']['name'])) { //si un fichier est en cours d'upload

			

			$photo_bdd = 'photop/' .  $_FILES['photo']['name']; // chemain + nom du fichier de la photo que l'on met en BDD. ne pas oublier de créer le dossier "photo"


			copy($_FILES['photo']['tmp_name'], '../' . $photo_bdd);//copie la photo qui est temporairement dans $_FILES['photo']['tmp_name'] vers l'emplacement d"finie par $photo_bdd

		}




		$resultat = $pdo->prepare("INSERT INTO contact (nom, prenom, telephone, email, photo, type_contact ) VALUES (:nom, :prenom, :telephone, :email, :photo, :type_contact )"); // pour rentrer dans la table contacte phpmyadmine on mest contacte

		$succes = $resultat->execute(array(
			':nom'            => $_POST['nom'],
			':prenom'         => $_POST['prenom'],
			':telephone'      => $_POST['telephone'],
			':email'          => $_POST['email'],
			':photo'          => $photo_bdd,//photo ne provient pas de $_POST  mais de $_FILES que l'on traire a part de  $_POST au deçu ligne110.
			':type_contact'   => $_POST['type_contact']
			

		));

		if ($succes) { // si executeRequete a retourné un objet PDOStatement, donc implicitement evalué a true, alors c que la requete a marcher
			$contenu .= '<div>Le contact a été enregistré.</div>';
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
	<title>contact</title>
</head>

<body>
<?php echo $contenu;?><!-- affcichage echo $contenu toujours apres le "<body>" d'ouverture-->

	<form method="post" enctype="multipart/form-data" > <!--enctype pour que le formulaire puisse envoyer les données du fichier uploadé-->
		<div>
			<label for="nom">Nom :</label>
			<input type="text" id="name" name="nom">
		</div><br>
		<div>
			<label for="prenom">prenom :</label>
			<input type="text" id="prenom" name="prenom">


		</div><br>
		<div>
			<label for="telephone">telephone :</label>
			<input type="text" id="telephone" name="telephone">

		</div><br>
		<div>
			<label for="email">email:</label>
			<input type="text" id="email" name="email">
		</div><br>

		<div>




			<label for="pet-select"></label>

			<select name="type_contact" id="type_contact">


				<option value="ami">ami</option>
				<option value="famille">famille</option>
				<option value="proffessionnel">proffessionnel</option>
				<option value="autre">autre</option>

			</select>



			<div><label for="photo">Photo</label></div>
			<input type="file" name="photo" id="photo">
			<input type="submit" value="enregistrer"><br>
	</form>

</body>

</html>