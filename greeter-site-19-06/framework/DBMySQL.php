<?php

class DBMySQL implements DB {

    private static $instance; // (instance unique)
    private static $DSN; // DSN)
    private static $log; //(identifiant utilisateur)
    private static $mdp; //(mot de passe)
    private static $opt = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]; // (options de connexion)
    private $db; //(instance de PDO)
    private $jeu; //(recordset après une requête SELECT)
    private $nb; //(nombre de lignes affectées par la dernière requête)

    private function __construct() {
        if (!self::$DSN)
            exit("DSN non défini.");

        try {
            $this->db = new PDO(self::$DSN, self::$log, self::$mdp, self::$opt);
        } catch (PDOException $e) {
            echo "{$e->getMessage()}<br/>";
            exit("Connexion DB impossible.");
        }
    }

    public static function getInstance() {
        if (!self::$instance)
            self::$instance = new DBMySQL();
        return self::$instance;

        // Retourne un instance de ccnnexion
        // Design Pattern Singleton pour garantir une unique instanciation de DBMySQL donc une unique connexion PDO
    }

    public static function setDSN($dbName, $log, $mdp, $host = 'localhost') {
        // Définir définiivement le DSN.

        if (self::$DSN)
            exit("DSN déjà défini.");
        self::$DSN = "mysql:dbname={$dbName};host={$host};charset=utf8mb4";
        self::$log = $log;
        self::$mdp = $mdp;
    }

    public function esc($exp) {
        // Protéger l'expression $exp pour protéger (échappée) pour l'utilisr dans un requête SQL.
        // Retourne 'NULL' si $exp=null
        return $exp === null ? 'NULL' : $this->db->quote($exp);
    }

    function xeq($req) {
        // Exécuter la requête $req selon son type
        // Retourne $this pour chaînage.
        try {
        if (mb_stripos(trim($req), 'SELECT') === 0) {
            $this->jeu = $this->db->query($req);
            $this->nb = $this->jeu->rowCount();
        } else {
            $this->jeu = null; // securité.
            $this->nb = $this->db->exec($req);
        } 
        } catch(PDOException $e){
            exit("{$req}<br/>{$e->getMessage()}");
        }
        return $this;
    }

    function nb() {
        return $this->nb;
    }

    function tab($class = 'stdClass') {
        // A n'utiliser après l'exécution d'une requête SELECT.
        // Retourne un tableau d'instances de $class correspondant aux enregistrement sélectionnées (fetchall)
        if(!$this->jeu)
            return [];
        $this->jeu->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $class);
        return $this->jeu->fetchALL();
    }

    function prem($class = 'stdClass') {
        // A n'utiliser après l'exécution d'une requête SELECT ne selectionnant à priori qu'un unique enregistrement.
        // Retourne le premier des enregistrements sélectionnés sous la forme d'une instance de $class (fetch)if(!$this->jeu)
        if(!$this->jeu)    
        return null;
        $this->jeu->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $class);
        return $this->jeu->fetch() ?: null;
        
    }

    function ins($obj) {
        // Hydrate $obj à partir du premier enregistrement présent dans le jeu en cours
        // Retourne true ou false selon que l'hydratation a réussie ou pas.
        if(!$this->jeu)    
        return false;
        $this->jeu->setFetchMode(PDO::FETCH_INTO, $obj);
        return (bool)$this->jeu->fetch();
    }

    function pk() {
        // Retourne la dernière PK auto-incrémentée
       return $this->db->lastInsertId();
    }

    function start() {
        // Débute une transaction
        // Retourne true ou false.
       return $this->db->beginTransaction();
    }

    function savepoint($label) {
        // créer un point de restauration nommé $label.
        // Retourne this
        $req = "SAVEPOINT {$label}";
        $this->xeq($req);
    }

    function rollback($label = null) {
        // Restaurer la DB à son état en début de transaction ou au point de restauration $label.
        // Retourne $this.
        $req = $label ? "ROLLBACK TO{$label}" : "ROLLBACK";
        return $this->xeq($req);
        
    }

    function commit() {
        // Valider la transaction
        // Retourne true ou false.
        return $this->db->commit();
    }

}
