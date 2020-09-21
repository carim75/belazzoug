

<style> 
    h2{
        border-top: 1px solid navy;
        border-bottom: 1px solid navy;
        color: navy;
    }

    table {

    
border-collapse: collapse;



}

td {
border: thin solid #000000;

}
</style>

<?php

//----------------------------------
echo '<h2> Les balises PHP </h2>';
//----------------------------------

?>


<?php
// pour ouvrire un passage en PHP on utilisela balise precedente (<?php ligne 22) et pour la fermer c le contraire (ligne 19)?>

<p>Ici je suis en HTML </p>

<!-- en dehors de la balise d'ouverture et de fermeture de PHP, nous pouvons écrire du HTML quand on est dans un fichier ayant l'extention PHP.-->

<?php

// Vous n'estes pas obliger de ferme un passage PHP en FIN de </script>
 
// pour faire 1 ligne de commentaire
# pour fair 1 ligne de commentaire

/*
pour fair des commentaires sur plusieur ligne
*/



echo '<h2> Affichage </h2>';

echo 'bonjour <br>'; // echo permet d'effectuer un affichage dans le navigateur. Nous pouvons y mettre des balises HTML sous forme de strin( chaine de caractere). Notez que toutes les instructuion se terminent par un ";".

print 'Nous somme jeudi <br>'; // autre instruction d'affichage dans le navigateur.

//Autre instruction d'affichage que nous verron plus loin :

print_r('code');
echo'<br>';
var_dump('code');





//----------------------------------
echo '<h2> Variable </h2>';
//----------------------------------
// une variable est un espace memoire qui porte un nom et qui permet de conserver une valeur.
//en PHP on represente une variable avec le signe $.

$a = 127; // on déclare la valeur "a" est lui affecte la valeur 127.
echo  gettype($a); // gettype() est une fonction predefinnit qui permet de voir(ou afficher) le type de variable. ici il s'agit d'un INTEGER (entier).
echo '<br>';

$a = 1.5;
echo  gettype($a);
echo'<br>'; // ici nous avons un double = float ( nombre a virgule)

$a = 'une chaine de caractere';
echo  gettype($a); //ici nous avons un STRING
echo '<br>';

$a ='127'; // un nombre ecrit dans des Quote"" ou guillemets '' est interpreter comme un string.

$a = true; //ou false
echo  gettype($a);// ici nous avons un boolean (booléen)
echo '<br>';


// par convention un nom de variable commence par une minuscuile, pui on met une majuscule a chaque mot (camel case). il peut contenire des chiffre (jamais au debut)ou un _( pas au debut ni a la fin). EXample : $maVariable1




echo '<h2> Guillemets et quotes </h2>';

$message = "aujourd'hui"; //ou bien :
$message = 'aujourd\'hui'; // on echappe l'appostrophe dans les quotes simples \




$prenom ='Jhon';
echo"bonjour $prenom <br>"; // quand on ecrit une variable dans des ("") elle est evaluer: cest son contenue qui est afficher. ici "Jhon". 
echo'bonjour $prenom <br>'; // dans des (''), tout est du texte brut : c'est le nom de la variable qui est affiché. 


//----------------------------------
echo '<h2> Concaténation </h2>';
//----------------------------------
// en PHP on concatene les élement avec le .

$x ='bonjour';
$y ='tout le monde';
echo $x . $y . '<br>'; // concaténation( suivie de) de variables et d'un string. on peut traduire le "." de concaténation par "suivi de...". 



//----------------------------------

//Concatenation lors de l'affcetation avec l'operateur .=
$message ='<p> erreur sur le champs emeil</p>';
$message .='<p>erreur sur le champs telephone </p>'; // avec l'operateur combiné .= on ajoute la nouvelle valeur SANS remplacer la valeur precedente dans la variable $message.
echo $message; // pui ici du coup on affcihe les 2 message au dessus.




echo '<h2> constante </h2>';

// une constante permet de conserver une valeur sauf que cel-ci ne peut pas changer. C'est a dire quand ne poura pas la modifier durant l'exécution du script. Utile pour conserver par example les parametres de connexion a la BDD.

define('CAPITAL_FRANCE', 'paris'); //définie la constante appelée CAPITAL_FRANCE a laquelle on donne la valeur Paris. Par convention le nom de constantes est toujour en MAJUSCULE (CAPITAL_FRANCE)

echo CAPITAL_FRANCE. '<br>'; // affiche paris

//Autre Façon :

const TAUX_CONVERSION = 6.55957; //définie la constante TAUX_CONVERSTION
echo TAUX_CONVERSION .'<br>'; // ici se qui sera afficher sera 6.55957




// Quelque constantes magiques :
echo __DIR__ . '<br>'; // permet d'afficher le chemain complet de notre deossier (C:\xampp\htdocs\PHP\01-bases).
echo __FILE__. '<br>'; // contient le chemain complet dossier et  du fichier (C:\xampp\htdocs\PHP\01-bases\bases.php).






//-------------------------------------EXERCICES--------------------------
// 1 : afficher bleu-blanc-rouge en mettant le texte de chaque couleur de variable.

const BLEU = 'bleu-';
const BLANC = 'blanc-';
const ROUGE = 'rouge';
echo BLEU. BLANC. ROUGE ;


//----------------------------------
echo '<h2> Opérateur arithmétiques </h2>';
//----------------------------------
$a = 10;
$b = 2;

echo $a + $b .'<br>'; // sa affiche 12
echo $a - $b .'<br>'; // affiche 8
echo $a * $b .'<br>'; // affiche 20
echo $a / $b .'<br>'; // affiche 5
echo $a % $b .'<br>'; // modulo. affiche 0  
//module = le reste de la divison.   example  3%2 =1 car si on les repartie sur 3 billes, on les repartie sur 2 joueur , il me reste 1 bille


//--------
//-- Les opérateurs arithmetiques combinés :
$a += $b; // $a = $a + $b, soit $a =10 + 2. $a vaut donc a la fin 12
echo $a . '<br>';

$a -= $b; // équivaut à $a = $a - $b, soit $a = 12 - 2. $a vaut donc à la fin 10.
$a *= $b; // équivaut à $a = $a * $b, $a vaut donc à la fin 20.
$a /= $b; // équivaut à $a = $a / $b, $a vaut donc à la fin 10.
$a %= $b; // équivaut à $a = $a % $b, $a vaut donc à la fin 0.

// On utilisera le += et le -= dans les paniers d'achat.

//------
// Incrémenter et décrémenter :
$i = 0;

$i++; // incrementation de $i par ajout de 1 : $i vaut donc a la fin 1
$i--; // decrementation de $i par soustraction de 1: $i vaut a la fin 0 parceque il étéai a 1.


//----------------------------------
echo '<h2> structures conditionnelles</h2>';
//----------------------------------
$a = 10;
$b = 5;
$c = 2;

// if ... else :
    if ($a > $b){ // si la condition est vraie, c'est a dire que $a est bien superieur a $b, alors on entre dans les accolades qui suivent le if
        echo'$a est superieur a $b <br>';
    } else { // sinon, on éxecute le else
        echo 'Non, c\est $b qui est superieur ou égal a $a <br>';
    }

    //L'opérateur AND qui s'écrit &&:
    if($a > $b && $b > $c){ // si $a est superieu a $b et dansz le meme temps $b est superieu a $c, alors on entre dans les accolades
        echo 'vraie pour les 2 condition <br>';
    }

    //TRUE && TRUE => TRUE
    // FALSE && FALSE => FALSE
    //true && FALSE => FALSE

    //l'opérateur OR qui s'écrit || :

$a = 10;
$b = 5;
$c = 2;

    if($a == 9 ||$b > $c){ // si $a est egal (==) a 9 ou alors que $b est superieur a $c dans se cas on entre dans les acollade qui suivent
        echo 'vrai pour au moin une des 2 condition <br>';

    }else {
        echo'les 2 condition son fausses <br>';
    }

    //TRUE || TRUE => TRUE
    //FALSE || FALSE =>FALSE
    //TRUE || FALSE => TRUE




    //------
    // if ..... elseif .... else :
$a = 10;
$b = 5;
$c = 2;

if($a == 8){
    echo'reponse1 : $a est egale a 8';// si  $a est egale a 8
}elseif($a !=10){
    echo 'reponse 2 : $a est different de 10';//  sinnon si $a est different de 10
}else{ // si je n'entre pas dans le if ni le elseif, alors j'arive dans le else ( se qui est le cas)
    echo' reponse :3 $a est egale a 10 </br>';
}

//NOte : le else n'est pas obligatoire ( on ne le met pas quand on en a pas besoin). else n'est jamais suivi d'une condition.

//---------------
// L'opérateur XOR OU exclusif :
    $question1 ='mineur';
    $question2 ='je vote'; //exemple d'un questionnaire 

    // les reponses de l'internaute n'étant pas coherentes, on lui met un message :
    if ($question1 == 'mineur' XOR $question2 =='je vote'){ //XOR = OU exclusif. Seulement une des deux condition doit etre valide pour entrer dans le if.si nous avons TRUE XOR TRUE cela vaux FALSE.
        echo'Vos reponses sont cohérentes <br>';
    }else{
        echo 'Vos reponses ne son pas coherante <br>';
    }

    //--------
    //FORME dite ternaire de la condition (autre syntaxe du if) :
        $a = 10;
        echo ($a == 10) ? '$a est egale a 10 <br>' : '$a est different de 10 <br>'; //le "?" remplace if, et le ":" remplace else. ON affiche le premier string si la condition est vraie, sinnon le second.

        //----------

        // Comparaison == ou === :
        $varA = 1; //integer
        $varB = '1';//string

        if($varA == $varB){// avec le == on compare uniquement la valeur
            echo '$varA est egale $varB en valeur <br>';

        }

        if($varA === $varB){ // avec le triple === on compare les valeur et le type 
            echo 'les deux variable son egale en valeur et en type<br>';


        }else{
            echo 'les deux variables son differente en valeur OU en type <br>';
        }

        // Rappel : le simple = est le signe d'affectation.




        //----------------------------------------------

        //isset() et empty():
        //empty() : vérifie si la variable est vide, c'est a dire  0, '', NULL, false,non definie

        //isset() : vérifie si la variable existe et a  une valeur non  NULL.

        $var1 = 0;
        $var2 = '';

        if (empty($var1)) echo '$var1 contient 0, string vide, NULL, false ou nest pas definite <br>';// VRAIE car la variable contient 0

        if (isset($var2)) echo 'le variable existe et est non NULL <br>'; //VRAI car la variable existe bien et ne contient pas NULL

        //contexte : empty pour verifier les champs de formulaire, isset pour verifier l'existence d'un indice dans un tableau avant d'y acceder.

        //----

        //L'opérateur NOT qui s'ecrit "!": 
        $var3 = 'quelque chose';
        if (!empty($var3)){ // le ! correspond a une négation : il intervertit le sens du booléen : true(vraix) devient false(faux) et !false devient true.ici cela signifie "$var3 n'est pas vide".  
            echo 'la variable nest pas vide <br>';
        }

        //----------
        //L'operateur ?? appelé "NULL coalescent"(PHP7) :

        echo $variable_inconnue ?? 'valeur par defaut';



//----------------------------------
echo '<h2> switch </h2>';
//----------------------------------

//la condition switch est une autre syntaxe pour ecrire un if elseif else quand on veut comparer une variable  a une multitude de valeurs.

$langue ='chinois';

switch ($langue){
    case 'francais' : // on compare $langue a la valeur des "case" et execute le code qui suit si elle correspond :
        echo'bonjour !';
    break;// obligatoir pour quitter le switch une fois un "case" exécuté

    case'italien' :
        echo 'ciao !';
    break;

        case'espagnole' :
            echo 'hola !';
        break;
        default : // cas par default qui est executer si on entre pas dans la des case (dans la condition)
        echo'hello !<br>';
        break;
        
}




//       exercie : vous réecriver ce switch sous forme de conditions if... pour obtenir exactement le meme resultat.

if ($langue == 'français') {
    echo 'Bonjour !';
} elseif ($langue == 'italien') {
    echo 'Buongiorno !';
} elseif ($langue == 'espagnol') {
    echo 'Hola !';
} else {
    echo 'Hello ! <br>';
}


//----------------------------------
echo '<h2>Fonction utilisateur </h2>';
//----------------------------------

//Une fonction est un morceau de code encapsulé dans des accolades et qui porte un nom. On appelle cette fonction au besoin pour executer le code qui s'y trouve. le fait de définnir des fonction pour ne pas se répeter  s'appelle "factoriser" son code . 

//on définit puis on exécute une fonction :
function separation() { // declaration d'une fonction prévue pour ne pas recevoir d'arguments
    echo '<hr>';
}

separation(); // on appelle notre fonction pas son nom suivie d'une paire de ()

//---------
// fonction avec parametres et return :

function bonjour($prenom, $nom) {// $prenom er $nom son des parametre de la fonction. Ils permettent de recevoir une valeur car il s'agit de variable de réception.
   return 'bonjour ' .$prenom . ' ' . $nom . ' ! <br>';//return renvoie la chaine de caractere "bonjour.." a l'endroit ou la fonction est appelée.
   //...
}
 echo bonjour('john', 'doe');// si la fonction attend des valeur , il faut lui envoyer dans le meme ordre de réception. Les valeur envoées s'appellent "arguments". Quand on souhaite afficher le resultat, et qu'il n'y a pas de "echo" dans la fonction, il faut le faire en meme temps que l'appel de la fonction. 


 //----
 $prenom = 'pierre';
 $nom = 'quiroule';
 echo bonjour($prenom, $nom); // on peut mettre des variables  a la place des valeur dans l'appel d'une fonction (example : quand on voudra recuperer les valeur d'un formulaire )

 //----------


 //EXERCICE :
 // -
 // Exercice :
// - Ecrivez la fonction factureEssence() qui calcule le coût total de votre facture en fonction du nombre de litres d'essence que vous indiquez lors de l'appel de la fonction. Cette fonction retourne la phrase "Votre facture est de X euros pour Y litres d'essence." où X et Y sont des variables. Pour cela, on vous donne une fonction prixLitre() qui vous retourne le prix du litre d'essence. Vous l'utilisez donc pour calculer le total de la facture.



function prixLitre() {
    return rand(100, 200)/100;// (rand (100, 200)/100!  nous sere a donnez un prix aleatoire entre 1 et 2$ prix litre)
    
} 



 function essence($litre){
          return  'votre facture est de ' . prixLitre() *$litre. ' euro pour 20L d\'essence'; 
 }
 echo essence(20); 




 //---------------- en PHP7 on peut préciser le type des valeur entrantes dans une fonction :
 
 function identite(string $nom, int $age){  // array, bool, floeat,int, string

    echo gettype($nom) . '<br>'; // string
    echo gettype($age) . '<br>'; // integer
    echo $nom . ' a ' . $age . ' ans <br>';

 }


 identite('asterix', 60); // le type attendu dans la fonction est respecter il n'y a pas d'erreur.
 identite('asterix', '60'); //ici il n'y a pas d'erreur pourtant le string '60' a été casté en integer ( Note si nous etion en mode strict, il y aurait une erreur).

 //identite('asterix','soixante');// fatal erreur car on demande un string qui ne peut pas etre transformer en integer


 //PHP7 on peut aussi préciser la valeur de retour que doit sortire la fonction:
 function adulte(int $age) : bool{ // array, bool, float, int, string

    if ($age >= 18){
        return true;
    }else{
        return false;
    }
     
 }
 var_dump(adulte(7));  //ici la fonction nous retourne bien un booléen, il n'y a donc pas d'erreur.nous faison un var_dump car il permet d'afficher le false qui retourne a la fonction, "echo fals" n'affichant rien.

 //-----------

 //variable local et variable globale:

 //de l'espace local vers l'espace global :
 function jourSemaine(){
     $jour = 'vendredi'; // variable local

     return $jour;
 }
 echo '<br>' . jourSemaine(); // on affiche se que nous retourne la fonction grace a son "return"

// echo $jour; // ne fonctione pas car cette variable n'est connue qu'a l'interieur de ma fonction

// de l'espace global vers le local :
$pays = 'france';// variable globale
function affichePays(){
    global $pays; // le mot cle global permet de recuperer la variable "$pays" au sein de au sein de l'espace locale de la fonction. on peu donc l'afficher
    echo '<br> ' .$pays;
}
affichePays();






//----------------------------------
echo '<h2>structures iteratives : les boucles </h2>';
//----------------------------------

// les boucles son destinéé a répeter des ligne de code de façon automatique.

// boucle while :
    $i = 0;// on initialise une variable qui sert de compeur"$i"

    while ($i < 3) { // tant que  $i est inferieur (<)   a 3 nous rentrons dans la boucle  
        echo $i . '<br>';
        
        for ($i = 0; $i < 3; $i++){
            echo $i . '<br>';
        } // on incremente $i a chaque tour de boucle afin de ne pas avoir une boucle  infinie (a 3 condition étant fausse, on quitte la boucle)
        // du coup $i ira jusqua 2 ariver a 3 il ne sera plus inferieur donc la boucle sarretera 
    }

    // Exercice : à l'aide d'une boucle while, afficher un sélecteur avec les années depuis 1920 jusqu'à 2020.
// rappel :

echo '<select>';
$i = 1920;
while($i < 2021){
   
   
    echo '<option> '. $i .'</option>';
     $i++;
}

echo '</select>'; 

echo '<select>';
$i = 1920;
while($i <= date(Y)){
   
   
    echo '<option> '. $i .'</option>';
     $i++;
}

echo '</select>'; 





///---------
// la boucle do while :
//la boucle do while a la particularité de s'éxécuter au moin une fois, puis tant que la condition de fin est vraie.

$j = 0;

do{
    echo ' <br> je fait un tour <br>';
    $j++;

}while ($j > 10);// la condition est false et pourtant la boucle a tourné 1 fois.

echo'<br>';

//--------------
//La boucle for est une autre syntaxe de la boucle while.
for ($i = 0; $i < 3; $i++){ // nous trouvon dans les parenthese de for  : la valeur de départ; la condition d'entré dans la boucle; la variation de $i
    echo $i . '<br>';
} // pour allez de 2 en 2 on remplace $i++ par $i+=2.

//exercice : 

echo '<select>';// on cree une zone de selection 
for ($i = 1; $i < 13; $i++){// on dit que $i est = 1; et $i est inferieur 13 et i++ rajoute de 1en 1
       echo '<option> ' . $i . '</option>' . '<br>'; // il nous affiche les chiffres de 1 a 12 dans l'option


}

 echo '</select>';

 //il existe aussi la boucle foreach que nous verrons un peu plus loin. elle sert a parcourir les tableaux ou les objet.

 //-------

 //exercie

 echo '<table>';
 echo'<tr>';
 
 for ($i = 0; $i < 10; $i++){

 echo '<td>'. $i .'<td>';




 }

echo'</tr>';
 echo '</table>';




 echo '<table>';// une boucle imbriquer est une boucle dans une boucle
 
 for ($o = 0; $o < 10; $o++){// en demande a 'tr' qui cree des colone de se repeter 10foi le for se place souvent en haut de se que on veut fair repeter

 
    echo'<tr>';
    
    for ($i = 0; $i < 10; $i++){ // on demande  a  'td' de se repeter 10foi dans la meme ligne le for se place souvent en haut de se que on veut fair repeter

    echo '<td>'. $i .'<td>';




    }
    echo'</tr>';
}
 echo '</table>';



 //----------------------------------
echo '<h2>quelque fonction prédéfinies</h2>';
//----------------------------------

// Une fonction prédéfinie permet de réaliser un traitement spécifique prédéterminé dans le language PHP.

//strlen

$phrase = "mettez une phrase ici";
echo strlen($phrase) . '<br>'; // affiche le nombre d'octets occupés par ce string, 1 caractere accentué comptant pour 2, les autre pour 1, il compte trou les tirer espace ext la phrase en hau "mettez une phrase ici" a 21.



//substr
$texte = 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Saepe temporibus optio deleniti. Doloribus id suscipit aut numquam rem. Suscipit modi recusandae blanditiis quod ducimus. Ab doloribus voluptatum perspiciatis modi quia!';
echo substr($texte, 0, 20) . '...<a href=""> lire la suite</a>'.'<br>'; //coupe le texte de la position 0 et sur 20 caracteres. avec (.<a href=""> lire la suite</a>') nous dira cliquez ici pour  la suite de lorem.




//strtlolwer, strtoupper, trim :
$message = '          Hello World  !                   ';
echo strtolower($message).'<br>'; // affiche tout en minuscules
echo strtoupper($message).'<br>';// affiche tout en majuscules

echo strlen($message) . '<br>';// on compte la longueur y comprit les espace
echo strlen(trim($message)) .'<br>';// trim supprime les espaces au début et a la fin de la chainne de caractaire. puis ici on compte le resultat sans les espace paceque il y a (strlen)


// la documentation PHP en ligue :
// voici la Doc https://www.php.net/


//---------------------------------------------------
echo'<h2> Tableau (arrays) </h2>';
//----------------------------------------------
// Un tableau ou encore array en anglais, est déclaré comme une variable ameliorée dans la quelle on stocke une multitude de valeur. Ces valeurs peuvent etre de n'importe quel type et possede un indice par defaut dont la numérotation commence a 0.

//Utilisation : Souvent quand on récupere des information de la BDD nous les retrouvons sous forme de tableau. 

//Déclarer un tableau ( méthode 1) : 
$liste = array('grégoire','nathalie','emilie','françois','george');

echo gettype($liste) .'<br>'; // type array

//echo $liste; //erreur de type "array to string conversion" car on ne peut pas afficher directement un tableau

echo 'var_dump et print_r:';
echo'<pre>';
var_dump($liste); // affcihe le contenue du tableau avec le type des valeurs
echo'</pre>';


echo'<pre>';
print_r($liste);// affiche le contenue du tableau sans le type des valeurs
echo'</pre>'; // la balise <pre> permet de formater l'affichage du print_r ou du var_drump. elle permet de mieux afficher le tableau.


//declaration de notre fonction d'affichage :
function debug($var){
    echo '<pre>';
    print_r($var);
    echo '</pre>';

}
debug($liste);

// autre methode pour declarer un tableau (méthode 2):
$tab = ['france','italie','espagne','portugal'];
debug($tab);

echo $tab [1] . '<br>'; //pour afficher italie on ecrite le nom du tableau '$tab' suivie de l'indice ecrit entre crocher "[1]" vue que france est l'indice [0] et litalie [1] ainsi de suite..



//----Ajouter une valeur a la fin de notre tableau $tab :
$tab[] = 'suisse'; // les [] vides permettes d'ajouter une valeur (pays suisse) a la fin du tableau.
debug($tab);

//---------
// tableau associatif :
// dans un tableau associatif, on peut choisir les indices.
$couleur = array(

    'j' => 'jaune',
    'b' => 'bleu',
    'v' => 'vert'


);

// pour affciher un élément du tableau associatif
echo 'la seconde couleur de notre tableau est le' . $couleur['b'] . '<br>';
echo "la seconde couleur est le $couleur[b] <br>"; // un tableau associatif écrit dans des guillemets perd les quotes autour de son indice

//-----
//----- Mesurer le nombre d'element dans un tableau :
echo 'taille du tableau :' . count($couleur) . '<br>'; // compte le nombre d'élement dans le tableau, ici c 3.

echo 'taille du tableau :' . sizeof($couleur) . '<br>'; // sizeof(taille de) fait la meme chose de count dans il est un alias.








//---------------------------------------------------
echo'<h2>boucle foreach </h2>';
//----------------------------------------------
// foreach est un moyen simple de parcourire un tableau de façon automatique. Cette boucle fonctionne uniquement sur les tableau et les objets. elle retourne une erreur si vous l'utiliser sur une variable d'un autre type ou non initialisée.

debug($tab);
foreach ($tab as $pays) {// la variable $pays vien parcourire la colone des valeurs : elle prend chaque valeur sccessivement a chaque tour de boucle . le mot AS (par) est obligatoir et fait partit de la syntaxe.
    echo $pays . '<br>';// affiche successivement les valeurs des tableau.
}
echo '<br>';

foreach ($tab as $indice => $pays){ //quand il y a 2 variable celle de gauche de la => parcour la conlonne des indices, et cel de droite parcourt la colonne des valeurs (pays).
    echo $indice . $pays . '<br>';

}

// Exercice : 
// - Ecrivez un tableau associatif avec les INDICES prenom, nom, email et telephone, auquels vous associez des valeurs pour 1 contact.
// - Puis avec une boucle foreach, affichez les valeurs dans des <p>, sauf le prénom qui doit être dans un <h3>.





$contact = array(// voici un tableau contacte nommé array

    'prenom' => 'carim',// a gauche nous avon l'indice et a droite la valeur
    'nom' => 'belazzoug',
    'email' => 'azzougk5@gmail.com',
    'telephone' => '06-18-19-17-12'

);
debug($contact);

foreach ($contact as $indice =>  $array ){
if($indice == 'prenom'){
    echo '<h3>' . 'bonjour' . ' ' . $array . '</h3>';
   

}
else{
      echo '<p>'. $array .'</p>';
}


}





//---------------------------------------------------
echo'tableau multidimensionnel </h2>';
//---------------------------------------------------

// nous parlons de tableaux multidimensionnels quand un tableau contient lui meme d'autre tableau. chaque tableau represente une dimension.

//Déclaration d'un tableau multidimensionnel :

$tab_multi = array(
    array(
        'prenom'=> 'julien',
        'nom' => 'dupon',
        'telephone' => '06-10-12-13-12'


    ),
    array(
        'prenom'=> 'nicola',
        'nom' => 'duran',
        'telephone' => '06-10-20-13-99'

    ),

    array(
        'prenom'=> 'pierre',
        'nom' => 'dulac'
       

    )




);// il est possible de choisire le nom des indices dans un tableau multidimensionnel
debug($tab_multi);



//Afficher la valeur "julien" :
echo $tab_multi[0]['prenom']. '<br>'; // pour afficher julien nous entrons dans le tableau $tab_multi, puis nous allons a son indice [0], dans lequel nous allons a l'indice ['prenom'] (les crochets son succesif)

echo '<br>';

//Parcourir le tableau multidimenssionel avec une boucle for :
    for ($i = 0; $i < sizeof($tab_multi); $i++){ // tant que $i est infferieur au nombre d'element $tab_multi(ici 3) on entre dans la boucle  (sizeof est la longueur du tableau)
        echo $tab_multi[$i]['prenom'] . '<br>';// on passe successivement par 0 puis 1 puis 2 pour afficher les 3 prenom

    }

    echo '<hr>';

    //exercice : afficher les 3 prenom avec une boucle foreach.

   foreach($tab_multi as $indice => $contact ){
       echo $tab_multi[$indice]['prenom'].'<br>';
    

   }

   //autre version :
   foreach ($tab_multi as $contact){
       //debug($contact);on voi que  $contact est un array qui contient l'indice "prenom". On accede donc aux prenom en mettant cette indice dans les [] :
       echo $contact['prenom'].'<br>';
   }

   //------
   // Exercice (option) : vous declarez un tableau contenant les taille S,M,L,XL. puis vous les affichez dans un menu deroulant (select/option) a laide d'une boucle foreach.
  

   
 


 

//---------------------------------------------------
echo'<h2>inclusion de fichier </h2>';
//---------------------------------------------------

echo 'Premiere inclusion : ';
include 'exemple.inc.php'; // le fichier est inclus, c'est-a-dire que son code s'execute ici. en cas d'erreur lors de l'inclusion, include genere une erreur de type "warnig" et continue l'éxecution du script.

echo '<br>seconde inclusion:';
include_once 'exemple.inc.php'; // le "once" est la pour verifier si le fichier a deja été inclus,auquel cas il ne le réinclut pas.

echo '<br> Ttoisieme inclusion :';
require 'exemple.inc.php'; // le fichier est "requis", donc obligatoire : en cas d'erreur lors de l'inclusion, require genere une erreur de type fatal error" qui stoppe l'exécution du code 


echo '<br> Quatrime inclusion :<br> ';
 require_once 'exemple.inc.php'; // le "once" est la pour verifier si le fichier a deja été inclus,auquel cas il ne le réinclut pas.


 echo '<br>' . $inclusion; // comme le fichier exemple.inc.php est inclus, on accede au elements qui sont déclarés a l'interieur de celui-ci, comme les variable, les fonctions ext..

 // la mention "inc" dans le nom du fichier precise au developpeur qu'il s'agit d'un fichier d'inclusion, et non pas d'une page a part entière.


 //---------------------------------------------------
echo'<h2> introduction aux objets </h2>';
//---------------------------------------------------
// Un objet est un autre type de donné(object en anglais). il represente un objet reel ( par exemple voiture, membre, panier d'achat, produit...) auquel on peut associer des variables, appelées PROPRIETE, des fonction apellées METHODE.

// Pour créer des objet, il nous faut "un plan de construction " : cest le role de la classe.
//Nous ncréons ici une classe pour fair des objets "meubles" :
class Meuble{ // ave une majuscule pour le nom de la classe 
     
   public $marque ='ikea'; //marque est une propriété. "publique" precise quelle sera accesible partout pas juste en local.

   public function prix(){ //prix() est une methode
       return rand(50,100). '€'; // rand entre = 50et100€

    
   }



}//---------------

$table =   new meuble(); //new est un mot cle qui permet d'instancier la classe pour en fair un objet. l'interet est que notre $table benificie de la propriete "ikea" et de la methode prix() definie dans la classe.
debug($table); // nous observons le type object, le nom de sa classe 'Meuble' et sa prop^rieté "marque". 

echo' Marque du meuble :' .$table->marque .'<br>';// pour accéder a la proprieté d'un objet , on ecrit cet objet suivi de la fleche-> puis du nom de la propriété sans le $
echo 'prix du meuble :' .$table->prix() . '<br>'; // pour acceder a la methode d'un objet, on l'ecrit apres la fleche-> a laquelle on ajoute une paire de ()

//*************************************************FIN *********************************************************************************************************************************/

