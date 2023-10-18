<?php 

class MissionsModel {
    private $pdo;

    public function __construct() {
        $dsn = 'mysql:host=localhost;dbname=orbitWatch;charset=utf8mb4';
        $user = "root";
        // Pas besoin de password dans mon set up

        try {
            $this->pdo = new PDO($dsn, $user);
        } catch (PDOException $err) {
            die($err->getMessage());
        }
    }

    public function getMissions() {
        $query = "SELECT * FROM missions";
        $results = $this->pdo->query($query);
        return $results;
    }

    public function deleteMission(int $id){
        $query = "DELETE FROM missions WHERE id_mission = :id";
        $request = $this->pdo->prepare($query);
        $request->execute([':id' => $id]);
    }

    public function addMission($mission_name,$mission_obj,$mission_date,$mission_agency,$mission_publication){
        //Récupération de l'ID user du plublieur
        $query = "SELECT id_user FROM users WHERE user_name = :name";
        $request = $this->pdo->prepare($query);
        $id_user = $request->execute([
            ':name' => $mission_publication
        ]);

        //Ajout de la mission avec toutes les données
        $pubDate = date('Y-m-d');
        $query = "INSERT INTO missions(mission_name,mission_obj,mission_date,mission_agency,mission_publication,mission_publication_date,id_user) VALUES (:name,:obj,:date,:agency,:publication,:pubDate,:id)";
        $request = $this->pdo->prepare($query);
        $request->execute([
            ':name' => $mission_name,
            ':obj' => $mission_obj,
            ':date' => $mission_date,
            ':agency' => $mission_agency,
            ':publication' => $mission_publication,
            ':pubDate' => $pubDate,
            ':id' => $id_user
        ]);
    }
}