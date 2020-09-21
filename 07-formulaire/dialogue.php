<?php
//---------------------------------------------
//Cas pratique :Formulaire pour poster des commentaires
//---------------------------------------------
//Objectif : proteger la requete SQL dont les données viennent de l'internaute.

/*creation de la BDD:
      Nomde la BDD :dialogue
      Nom de la table :commentaire
      Colonnes(champs): id_commentaire INT PK AI
                        pseudo VARCHAR(50)
                        message TEXT
                        date_enregistrement DATETIME

*/
//print_r($_POST);






// 2.connection a la BDD et traitement de $_POST :
$pdo = new PDO('mysql: host=localhost;dbname=dialogue',// driver mysql, serveur de la BDD (host), nom de la BDD(dbname) a changer
               'root',// pseudo de la BDD
               '',// root pour MAC 'mot de passe de la BDD
               array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,  // option1 : on affiche les erreurs SQL
                PDO:: MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'  // option2: on definnit le jeu de caracteres des echanges avec la BDD
                
               )

);

if(!empty($_POST)){//si le formulaire a été envoyé

    //5. traitement contre les failles XSS(javScript) et les faille CSS :on parle d'échapper les données.
    //pour l'exemple on injecte ce CSS : <style>body{display:none;}</style>

    //pour s'en proteger nous faison :
    $_POST['pseudo'] = htmlspecialchars($_POST['pseudo'], ENT_QUOTES);
    $_POST['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES);//cette fonction prédéfinie convertit les caracteres spéciaux (<,>,&,et les ") en entités HTML (le<devient &lt; le > devient &gt; les guillement"" deviennent &quot)

    // Nous insérons le message en BDD avec une requete qui n'est pas proteger contre les injection et qui n'accepte pas les apostrophes:
    //$resultat = $pdo->query("INSERT INTO commentaire (pseudo,date_enregistrement,message) VALUES ('$_POST[pseudo]', NOW(), '$_POST[message]')");//ici on insere directement dans la requete des données qui viennent d'un formulaire sans avoir prit des precaution. ")



    //4.Nous faison l'injection SQL suivante  '); DELETE FROM commentaire; #
    //cette injection a pour effet de VIDER la table.

    //pour s'en proteger nous faisons la requète préparér suivante (en commentant la requete precedente):
    $resultat =$pdo->prepare("INSERT INTO commentaire (pseudo,date_enregistrement,message) VALUES (:pseudo, NOW(), :message)  ");

    $resultat->execute(array(
        ':pseudo'=>$_POST['pseudo'],
        ':message'=>$_POST['message']
    ));

    //avec la requete preparer , on constate que l'injection sql est neutralisée. Par ailleur on peut mettre des apostrophe dans le formulaire.
    //Comment ça marche ? le fait de mettre des marqueurs dans la requéte evite que les instruction SQL d'origine injectées se concatenent. Ces instruction ne s'execute donc plus ensemble. en liant les marqueurs vide a leur valeur dans exécute(), les instruction SQL injectés son neutraliser par cette methode qui les rend inoffensives. la BDD ne les execute donc pas.
    
    
}// fin du if (!empty($_POST))















//1.formulaire
?>

<h1>Votre Message</h1>

<form method="post" action="">

    <div><label for="pseudo">Pseudo</label></div>
    <div><input type="text" name="pseudo" id="pseudo" value="<?php echo $_POST['pseudo'] ?? ''; ?>"></div>

    <div><label for="message">Message</label></div>
    <div><textarea name="message" id="message" cols="30" rows="10"><?php echo $_POST['message'] ?? ''; ?> </textarea></div>

    <div><input type="submit"></div>

</form>

<?php
//3.affichage des commentaire
$resultat = $pdo->query("SELECT pseudo, message, DATE_FORMAT(date_enregistrement, '%d/%m/%Y') AS datefr,DATE_FORMAT(date_enregistrement,'%H-%i-%s') AS heurefr FROM commentaire ORDER BY date_enregistrement DESC");   
//DATE_FORMAT() en SQL permet de reformater une date et l'heure.

echo '<h2>' . $resultat->rowCount() . 'commentaires</h2>';
while($commentaire = $resultat->fetch(PDO::FETCH_ASSOC)){

    //print_r($commentaire);//on retrouve les alias dans la requete sous forme d'indice dans le tableau $commentaire

    echo '<div>Par ' . $commentaire['pseudo'] . 'le' . $commentaire['datefr'] . ' a ' . $commentaire['heurefr'] . '</div>';

    echo '<div>' . $commentaire['message'] . '</div> <hr>';




}