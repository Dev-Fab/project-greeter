<?php

class Upload {

    public $nomChamp;
    public $tabMIME = [];
    public $nomClient;
    public $extension;
    public $cheminServeur;
    public $codeErreur;
    public $octets;
    public $typeMIME;
    public $tabErreur = [];

    public function __construct($nomChamp, $tabMIME = []) {
        $this->nomChamp = $nomChamp;
        $this->tabMIME = $tabMIME = [];
        if (!isset($_FILES[$this->nomChamp])) {
            $this->tabErreur[] = "Aucun upload.";
            return;
        }
        $file = $_FILES[$this->nomChamp];
        $this->nomClient = $file['name'];
        $this->extension = (new SplFileInfo($this->nomClient))->getExtension();

        $this->cheminServeur = $file['tmp_name'];
        $this->codeErreur = $file['error'];
        $this->octets = $file['size'];
        $this->typeMIME = $file['type'];
        if ($this->codeErreur === UPLOAD_ERR_INI_SIZE || $this->codeErreur === UPLOAD_ERR_FORM_SIZE) {
            $this->tabErreur[] = "Fichier trop lourd.";
        } elseif ($this->codeErreur === UPLOAD_ERR_NO_FILE) {
            $this->tabErreur[] = "Aucun Fichier.";
        } elseif ($this->codeErreur) {
            $this->tabErreur[] = "Upload incorrect.";
        }
        if (!$this->codeErreur && !$this->octets) {
            $this->tabErreur[] = "Fichier vide.";
        }
        if ($this->tabMIME && !in_array($this->typeMIME, $this->tabMIME)) {
            // la fonction in_array permet de rechercher des valeurs dans un tableau qui est lui meme dans un tableau
            $this->tabErreur[] = "Type MIME incorrect.";
        }
    }

    public function sauver($chemin) {
        if (!move_uploaded_file($this->cheminServeur, $chemin)) {
            $this->tabErreur[] = "Enregistrement du fichier impossible.";
        }
    }

    public static function maxFileSize($enOctets = true) {
        $kmg = ini_get('upload_max_filesize');
        if (!$enOctets) {
            return $kmg;
        }
        $kmg = str_ireplace('G', '*1024**3+', $kmg);
        $kmg = str_ireplace('M', '*1024**2+', $kmg);
        $kmg = str_ireplace('K', '*1024+', $kmg);
        $kmg .= '0';
        eval("\$octets = {$kmg};");
        return $octets;
    }

}
