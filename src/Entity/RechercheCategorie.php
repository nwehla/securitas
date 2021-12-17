<?php
namespace App\Entity;

class RechercheCategorie{
    private $categorie;

    public function getCategorie() : ? string{
        return $this->categorie;
    }

    public function setCategorie(string $categorie){
        $this->categorie = $categorie;
        return $this;
    }

}

?>