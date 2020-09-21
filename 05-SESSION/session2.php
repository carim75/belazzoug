<?php
 //Ouverture de la session :

 session_start();// elle cree ou ouvre une session dans ce cas elle ouvre une session deja existante

 echo 'Le fichier de session reste accessible dans tous les scripts du site comme ici : ';
 print_r($_SESSION);// permet d'afficher la session


 //Ce fichier session2 n'a pas de lien avec le precedent, il n'y a pas d'inclusion, il pourrait etre dans n'importe quelle dossier , avoir nimporte quelle nom, les donné contenue reste accesible grace a la session

 echo '<p><a href="session1.php">Aller page 1</a></p>';