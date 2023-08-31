<?php

class ConnexionBaseDeDonnees {
    private $hote = "localhost";
    private $nomUtilisateur = "root";
    private $motDePasse = "";
    private $nomBaseDeDonnees = "passdoc";
    private $connexion;

    public function __construct() {
        try {
            $dsn = "mysql:host=$this->hote;dbname=$this->nomBaseDeDonnees";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];
            $this->connexion = new PDO($dsn, $this->nomUtilisateur, $this->motDePasse, $options);
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }

    public function fermerConnexion() {
        $this->connexion = null;
    }
}

?>







