<?php
namespace App\Entity; 

class Recherche {
    private $titre;

    public function getTitre(): ? string {
        return $this->titre;
    }

    public function setTitre(string $titre){
        $this->titre = $titre;
        return $this;
    }
}
?>