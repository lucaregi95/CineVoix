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
        $sql = "INSERT INTO film VALUES :id_film,:nom,:description,:duree,:affiche,:genre,:age_min,:realisateur,:date_sortie,:bande_annonce):";
        $req = $this->connexionBdd->prepare($sql);
        $req->bindValue(':id_film', $film->getIdFilm());
        $req->bindValue(':nom', $film->getNom());
        $req->bindValue(':description', $film->getDescription());
        $req->bindValue(':duree', $film->getDuree());
        $req->bindValue(':affiche', $film->getAffiche());
        $req->bindValue(':genre', $film->getGenre());
        $req->bindValue(':age_min', $film->getAgeMin());
        $req->bindValue(':realisateur', $film->getRealisateur());
        $req->bindValue(':date_sortie', $film->getDateSortie());
        $req->bindValue(':bande_annonce', $film->getBandeAnnonce());
        $req->execute();
    }
}
