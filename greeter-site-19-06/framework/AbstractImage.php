<?php

abstract class AbstractImage {

    public $tabErreur = []; //(renseigné si erreur)
    protected $chemin; //(chemin du fichier)
    protected $largeur; //(largeur en px)
    protected $hauteur; //(hauteur en px)

    const CONTAIN = 'CONTAIN';
    const COVER = 'COVER';

    public function copier($largeurCadre, $hauteurCadre, $cheminCible, $mode = self::CONTAIN) {
        if ($this->largeur <= $largeurCadre && $this->hauteur <= $hauteurCadre) {
            if (!copy($this->chemin, $cheminCible)) {
                $this->tabErreur[] = "Copie image impossible.";
            }
            return;
        }
        $ratioSource = $this->largeur / $this->hauteur;
        $ratioCadre = $largeurCadre / $hauteurCadre;
        if ($mode === self::CONTAIN) {
            if ($ratioSource >= $ratioCadre) {
                $largeurCible = $largeurCadre;
                $hauteurCible = $largeurCible / $ratioSource;
            } else {
                $hauteurCible = $hauteurCadre;
                $largeurCible = $hauteurCible * $ratioSource;
            }
        } elseif ($mode === self::COVER) {
            if ($ratioSource < $ratioCadre) {
                $largeurCible = $largeurCadre;
                $hauteurCible = $largeurCible / $ratioSource;
            } else {
                $hauteurCible = $hauteurCadre;
                $largeurCible = $hauteurCible * $ratioSource;
            }
        }
        if (!$source = $this->from()) {
            return $this->tabErreur[] = "Lecture image source impossible";
        }
        if (!$cible = imagecreatetruecolor($largeurCible, $hauteurCible)) {
            return $this->tabErreur[] = "Mémoire insiffisante";
        }
        if (!imagecopyresampled($cible, $source, 0, 0, 0, 0, $largeurCible, $hauteurCible, $this->largeur, $this->hauteur)) {
            return $this->tabErreur[] = "Mémoire insuffisante.";
        }
        imagedestroy($source);
        if (!$this->to($cible, $cheminCible)) {
            return $this->tabErreur[] = "Ecriture image cible impossible.";
        }
        imagedestroy($cible);
    }

    protected abstract function from();

    protected abstract function to($cible, $cheminCible);
}
