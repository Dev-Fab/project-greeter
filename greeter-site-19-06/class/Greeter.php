<?php

// Pas besoin de require car on l'utilise dans d'autres fichiers comme l'index
Class Greeter implements ORM {

    public $id_greeter;
    public $id_lieu;
    public $nom;
    public $prenom;
    private $lieu = null;

    public function __construct($id_greeter = null, $id_lieu = null, $nom = null, $prenom = null) {
        $this->id_greeter = $id_greeter;
        $this->id_lieu = $id_lieu;
        $this->nom = $nom;
        $this->prenom = $prenom;
       
    }

    function charger() {
        // Hydrate $this en se basant sur sa PK.
        if (!$this->id_greeter)
            return false;
        $req = "SELECT * FROM greeter WHERE id_greeter={$this->id_greeter}";
        return DBMySQL::getInstance()->xeq($req)->ins($this);
    }

    function sauver() {
        // Persister $this en se basant sur sa  PK. 
        $db = DBMySQL::getInstance();
        $id_greeter = $this->id_greeter ?: 'DEFAULT';
        $req = "INSERT INTO greeter VALUES({$id_greeter}, {$this->id_lieu}, {$db->esc($this->nom)}, {$db->esc($this->prenom)}) ON DUPLICATE KEY UPDATE id_lieu={$this->id_lieu}, nom={$db->esc($this->nom)}, prenom={$db->esc($this->prenom)}";
        $db->xeq($req);
        $this->id_greeter = $this->id_greeter ?: $db->pk();
        return $this;
    }

    function supprimer() {
        // Supprimer l'enregistrement correspondant à $this.
        if (!$this->id_greeter)
            return false;
        $req = "DELETE FROM greeter WHERE id_greeter={$this->id_greeter}";
        return (bool) DBMySQL::getInstance()->xeq($req)->nb();
    }

    static function tab($where = 1, $orderBy = 1, $limit = null) {
        // Retourne un tableau d'enregistrement sous la forme d'instance. 
        $req = "SELECT * FROM greeter WHERE {$where} ORDER BY {$orderBy}" . ($limit ? " LIMIT {$limit}" : '');
        return DBMySQL::getInstance()->xeq($req)->tab(self::class);
    }

    

    public function get_Lieu() {

        if (!$this->lieu) {
            $req = "SELECT * FROM lieu WHERE id_lieu={$this->id_lieu}";
            $this->lieu = DBMySQL::getInstance()->xeq($req)->prem(Lieu::class);
        }
        return $this->lieu;
    }

    public function prenomExiste() {
        $db = DBMySQL::getInstance();
        $id_greeter = $this->id_greeter ?: 0;
        $req = "SELECT * FROM greeter WHERE prenom={$db->esc($this->prenom)} AND id_greeter !={$id_greeter}";

        return (bool) $db->xeq($req)->prem(self::class);
    }

    public function __get($nom) {
        $methode = "get_{$nom}";
        return $this->$methode();
    }

}
