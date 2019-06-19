<?php

Class Lieu {

    public $id_lieu;
    public $nom;

    public function __construct($id_lieu = null, $nom = null) {
        $this->id_lieu = $id_lieu;
        $this->nom = $nom;
    }
    
    function charger() {
        // Hydrate $this en se basant sur sa PK.
        if (!$this->id_lieu)
            return false;
        $req = "SELECT * FROM lieu WHERE id_lieu={$this->id_lieu}";
        return DBMySQL::getInstance()->xeq($req)->ins($this);
    }

    function sauver() {
        // Persister $this en se basant sur sa  PK. 
        $db = DBMySQL::getInstance();
        $id_lieu = $this->id_lieu ?: 'DEFAULT';
        $req = "INSERT INTO lieu VALUES({$id_lieu}, {$db->esc($this->nom)}) ON DUPLICATE KEY UPDATE nom={$db->esc($this->nom)}";
        $db->xeq($req);
        $greeter->id_greeter = $this->id_greeter ?: $db->pk();
        return $this;
    }

    function supprimer() {
        // Supprimer l'enregistrement correspondant à $this.
        if (!$this->id_lieu)
            return false;
        $req = "DELETE FROM lieu WHERE id_lieu={$this->id_lieu}";
        return (bool) DBMySQL::getInstance()->xeq($req)->nb();
    }

    static function tab($where = 1, $orderBy = 1, $limit = null) {
        // Retourne un tableau d'enregistrement sous la forme d'instance. 
        $req = "SELECT * FROM lieu WHERE {$where} ORDER BY {$orderBy}" . ($limit ? " LIMIT {$limit}" : '');
        return DBMySQL::getInstance()->xeq($req)->tab(self::class);
    }

    public function getTabGreeter() {
        $req = "SELECT * FROM greeter WHERE id_lieu={$this->id_lieu} ORDER BY nom";
        return DBMySQL::getInstance()->xeq($req)->tab(Greeter::class);
    }

    

}
