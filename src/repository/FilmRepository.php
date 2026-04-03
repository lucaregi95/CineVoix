<?php

class FilmRepository
{
    private $connexionBdd;

    public function __construct()
    {
        $this->connexionBdd = (new Bdd())->getConnexionBdd();
    }

    public function getFilm($film)
    {
        $sql = "SELECT * FROM film WHERE id_film = :idfilm";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':idfilm', $film);
        $req->execute();
        $result = $req->fetch();
        $film = new Film($result["id_film"], $result["nom"], $result["description"], $result["duree"],$result["affiche"],$result["genre"],$result["age_min"],$result["realisateur"],$result["date_sortie"],$result["bande_annonce"]);
        return $film;
    }

    public function getAllFilm()
    {
        $sql = "SELECT * FROM Film";
        $req = $this->connexionBdd->prepare($sql);
        $req->execute();
        $results = $req->fetchAll();
        $tabFilm = array();
        foreach ($results as $result) {
            $film = new Film($result["id_film"], $result["nom"], $result["description"], $result["duree"],$result["affiche"],$result["genre"],$result["age_min"],$result["realisateur"],$result["date_sortie"],$result["bande_annonce"]);
            $tabFilm[] = $film;
        }
        return $tabFilm;
    }

    public function ajouterFilm(Film $film)
    {
        $sql = "";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':codePromo', $film->getFilm());
        $req->bindValue(':codePromo', $film->getCodePromo());
        $req->bindValue(':codePromo', $codePromo->getCodePromo());
        $req->execute();
    }
}
