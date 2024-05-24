<?php
include 'conn.php';

class ArticleManager{

    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function getArticle($id = null){
        if (!empty($id)) {
            // If $id is provided, fetch a specific record
            $sql = "SELECT nom_article, libelle_categorie, quantite, prix_unitaire, date_expiration, date_fabrication, id_categorie, a.id 
                    FROM article AS a, categorie_article AS c 
                    WHERE a.id_categorie=c.id AND a.id=?";
            $req = $this->conn->prepare($sql);
            $req->execute(array($id));
            return $req->fetch();
        } else {
            // If $id is not provided, fetch all records
            $sql = "SELECT nom_article, libelle_categorie, quantite, prix_unitaire, date_expiration, date_fabrication, id_categorie, a.id 
                    FROM article AS a, categorie_article AS c 
                    WHERE a.id_categorie=c.id";
            $req = $this->conn->prepare($sql);
            $req->execute();
            return $req->fetchAll();
        }
    }
}

class ClientManager {
   private $conn;

   public function __construct($conn) {
      $this->conn = $conn;
   }

   public function getClient($id = null) {
      try {
         if (!empty($id)) {
            $sql = "SELECT * FROM client WHERE id=?";
            $req = $this->conn->prepare($sql);
            $req->execute(array($id));
            return $req->fetch();
         } else {
            $sql = "SELECT * FROM client";
            $req = $this->conn->prepare($sql);
            $req->execute();
            return $req->fetchAll();
         }
      } catch (PDOException $e) {
         // Handle database errors
         return "Error: " . $e->getMessage();
      }
   }
}

class VenteManager{

    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function getVente($id = null)
    {
        if (!empty($id)) {
            // If $id is provided, fetch a specific record
            $sql = "SELECT nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, prix_unitaire, adresse, telephone
                    FROM client AS c, vente AS v, article AS a 
                    WHERE v.id_article=a.id AND v.id_client=c.id AND v.id=? AND etat=?";
            $req = $this->conn->prepare($sql);
            $req->execute(array($id, 1)); // Assuming etat is a placeholder for a specific condition
            return $req->fetch();
        } else {
            // If $id is not provided, fetch all records
            $sql = "SELECT nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, a.id AS idArticle
                    FROM client AS c, vente AS v, article AS a 
                    WHERE v.id_article=a.id AND v.id_client=c.id AND etat=?";
            $req = $this->conn->prepare($sql);
            $req->execute(array(1)); // Assuming etat is a placeholder for a specific condition
            return $req->fetchAll();
        }
    }
}

class CommandeManager{

    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function getCommande($id = null)
    {
        if (!empty($id)) {
            // If $id is provided, fetch a specific record
            $sql = "SELECT nom_article, nom, prenom, co.quantite, prix, date_commande, co.id, prix_unitaire, adresse, telephone
                    FROM fournisseur AS f, commande AS co, article AS a 
                    WHERE co.id_article=a.id AND co.id_fournisseur=f.id AND co.id=?";
            $req = $this->conn->prepare($sql);
            $req->execute(array($id));
            return $req->fetch();
        } else {
            // If $id is not provided, fetch all records
            $sql = "SELECT nom_article, nom, prenom, co.quantite, prix, date_commande, co.id, a.id AS idArticle
                    FROM fournisseur AS f, commande AS co, article AS a 
                    WHERE co.id_article=a.id AND co.id_fournisseur=f.id";
            $req = $this->conn->prepare($sql);
            $req->execute();
            return $req->fetchAll();
        }
    }
}

class FournisseurManager{

    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function getFournisseur($id = null)
    {
        if (!empty($id)) {
            // If $id is provided, fetch a specific record
            $sql = "SELECT * FROM fournisseur WHERE id=?";
            $req = $this->conn->prepare($sql);
            $req->execute(array($id));
            return $req->fetch();
        } else {
            // If $id is not provided, fetch all records
            $sql = "SELECT * FROM fournisseur";
            $req = $this->conn->prepare($sql);
            $req->execute();
            return $req->fetchAll();
        }
    }
}

class CategorieManager{

    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function getCategorie($id = null)
    {
        if (!empty($id)) {
            // If $id is provided, fetch a specific record
            $sql = "SELECT * FROM categorie_article WHERE id=?";
            $req = $this->conn->prepare($sql);
            $req->execute(array($id));
            return $req->fetch();
        } else {
            // If $id is not provided, fetch all records
            $sql = "SELECT * FROM categorie_article";
            $req = $this->conn->prepare($sql);
            $req->execute();
            return $req->fetchAll();
        }
    }
}

class Allcommande {
    private $conn;

    // Constructor to set up the database connection
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to get the total number of records in the "commande" table
    public function getAllCommande() {
        $sql = "SELECT COUNT(*) AS nbr FROM commande";
        $req = $this->conn->prepare($sql);
        $req->execute();
        return $req->fetch();
    }
}

class Allvente {
    private $conn;

    // Constructor to set up the database connection
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to get the total number of records in the "vente" table with a specific state
    public function getAllVente() {
        $sql = "SELECT COUNT(*) AS nbr FROM vente WHERE etat=?";
        $req = $this->conn->prepare($sql);

        // Assuming you want to count records with etat=1, you can adjust the parameter accordingly
        $req->execute(array(1));

        return $req->fetch();
    }
}

class Allarticle {
    private $conn;

    // Constructor to set up the database connection
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to get the total number of records in the "article" table
    public function getAllArticle() {
        $sql = "SELECT COUNT(*) AS nbr FROM article";
        $req = $this->conn->prepare($sql);
        $req->execute();
        return $req->fetch();
    }
}

class CAManager {
    private $conn;

    // Constructor to set up the database connection
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to get the total cumulative amount (CA) from the "vente" table
    public function getCA() {
        $sql = "SELECT SUM(prix) AS prix FROM vente";
        $req = $this->conn->prepare($sql);
        $req->execute();
        return $req->fetch();
    }
}

class LastVente {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getLastVente() {
        $sql = "SELECT nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, a.id AS idArticle
                FROM client AS c
                JOIN vente AS v ON v.id_client=c.id
                JOIN article AS a ON v.id_article=a.id
                WHERE etat=?
                ORDER BY date_vente DESC LIMIT 10";

        $req = $this->conn->prepare($sql);
        $req->execute(array(1));

        return $req->fetchAll();
    }
}

class MostVente {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getMostVente() {
        $sql = "SELECT nom_article, SUM(prix) AS prix
                FROM client AS c
                JOIN vente AS v ON v.id_client = c.id
                JOIN article AS a ON v.id_article = a.id
                WHERE etat = ?
                GROUP BY a.id
                ORDER BY SUM(prix) DESC LIMIT 10";

        $req = $this->conn->prepare($sql);
        $req->execute(array(1));

        return $req->fetchAll();
    }
}

