

<?php
if (!empty($_POST)){

    echo '<pre>';
    print_r($_POST);//permet de verifier l'affichage
    echo '</pre>';
    
    
    echo '<p>ville :' . $_POST['ville'] . '</p>';
    echo '<p>postal :' .$_POST['postal'] . '</p>';
    echo '<p>adresse :' .$_POST['adresse'] . '</p>';
    

    //-----------------------------------
    // ecrire dans un fichier txt
    //-----------------------------------

    //On va ecrire les adresse des interneautes dans un fichier texte crée dynamiquement  sur le serveur (en l'absance de BDD).

    $file = fopen('adresse.txt','a'); 
    // fopen() en mode 'a' crée le fichier si il n'exsiste pas encore sinnon ouvre le.


    $adresse = $_POST['ville'] . ' - ' . $_POST['postal'] . ' - ' .$_POST['adresse'] . "\n";
     //on concatene l'adresse de l'internaute avec un saut de ligne a la fin ("\n")


    fwrite($file,$adresse); 
    //Fwrite() écrit le comptenue de la variable adresse dans le fichier représenté par $file.
    
    
    fclose($file);
    //puis on ferme le fichier pour liberer  de la ressource .





}



