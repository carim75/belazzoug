<?php

class Utilisateur
{
    /**
     * COMMENTAIRE DE DOCUMENTATION (EN DOUBLE ETOILE)
     *
     * attribut(ou proprieté) de la classe (= variable interne)
     *
     * @var string  le prénom de l'utilisateur
     */

    public $prenom = 'carim';

    /**
     * Un attribut sans valeur par defaut (=null)
     *
     * @var string|null
     */
    public $nom;

    /**
     *  Un attrinut privé
     * @var int
     */
    private  $age = 20;






    /**
     *
     */
    public function nomComplet()
    {
        //$this dans une méthode fait reference a l'objet qui apelle la methode
        return rtrim($this->prenom . ' ' . $this->nom);
    }


    

    public function infos()
    {// on  ne peut accéder a un attribut privé qu'a l'intérieur des méthode de la class
        return $this->nomComplet() . ', ' . $this->age . 'ans';
    }




    //écrire une méthode qui permet de fair vieillir un utilisateur d'un an
public function anniversaire()
{
      $this->age++;// on ajoute +1 a la function anniversaire()

}


}

// $prenom n'éxiste pas en dehors de la classe
//var_dump($prenom);


//instanciation de la classe = création d'un objet a partire de la classe
$moi = new Utilisateur();
// la fleche pour accéder a l'attribut de l'objet
echo $moi->prenom;

$toi = new Utilisateur();
//affectation d'une valeur a l'attributprenom et l'objet $toi
$toi->prenom = 'ben';

echo '<br>' . $moi->prenom; // carim
echo '<br>' . $toi->prenom;//ben

$toi->nom = 'hur';
var_dump($moi->nom);//null
var_dump($moi->nom);//hur

// la fonction nowComplet() n'existe pas :
// echo nomComplet(); // fatal error



echo $toi->nomComplet();// appel de la methode nomcomplet() depuis un objet Utilisateur


// fatal error : impossible d'acceder a un attribut privé depuis un objet Utilisateur
//echo $moi->age;

echo  '<br>' . $toi->infos();

//création d'un attribut a la volée :
// a éviter, si on a besoin d'un nouvel attribut, on l'ajoute a la classe
$toi->adresse = '10 rue la solo';


//std Class = la class de base (sans contenu) en PHP
$vide = new stdClass();
var_dump(($vide));
$vide->contenue = 'rien';
var_dump($vide);

$entier = 12;
$nombre = (string)$entier;
var_dump($entier);

$array =['prenom' => 'thomas', 'email' => 'azzougk@gmail.com'];

$obj =(object)$array;
var_dump($obj);


$moi->anniversaire();
var_dump($moi);

$moi->anniversaire();
var_dump($moi);




