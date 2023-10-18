<?php 

class RolesModel {
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

    public function getAllRoles(){
        try {
            $query = "SELECT * FROM roles";
            $results = $this->pdo->query($query);;
            return $results;
        } catch (PDOException $err) {
            die($err->getMessage());
        }  
    }

    public function deleteRole(int $id){
        $query = "DELETE FROM affecter WHERE id_role = :id";
        $request = $this->pdo->prepare($query);
        $request->execute([':id' => $id]);

        $query = "DELETE FROM roles WHERE id_role = :id";
        $request = $this->pdo->prepare($query);
        $request->execute([':id' => $id]);
    }

    public function addRole(string $name){
        $query = "INSERT INTO roles(role_name) VALUES (:name)";
        $request = $this->pdo->prepare($query);
        $request->execute([':name' => $name]);
    }

    public function affectRole(int $id_user, int $id_role){
        $query = "INSERT INTO affecter(id_user,id_role) VALUES (:user,:role)";
        $request = $this->pdo->prepare($query);
        $request->execute([
            ':user' => $id_user,
            ':role' => $id_role,
        ]);
    }
}