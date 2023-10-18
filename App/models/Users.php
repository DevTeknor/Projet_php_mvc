<?php 


class UsersModel {
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

    //############ Fonction obsolète #############
    // public function getUsers() {
    //     try {
    //         $query = "SELECT * FROM users";
    //         $results = $this->pdo->query($query);
    //         return $results;
    //     } catch (PDOException $err) {
    //         die($err->getMessage());
    //     }  
    // }

    public function getName():string{
        return $_SESSION['user_name'];
    }
    
    public function getLogs($name){
        // Requête et réponse au controller
        $query = "SELECT user_mdp FROM users WHERE user_name = :name";
        $request = $this->pdo->prepare($query);
        $request->execute([':name' => $name]);
        $results = $request->fetch(PDO::FETCH_ASSOC);

        // Je ne suis pas parvenu à faire un try catch propre ici
        if ($results) {
            return $results['user_mdp'];
        } else {
            echo '<h1>Aucun utilisateur ne possède ce nom.</h1>';
            return;
        }
    }

    public function deleteUser(int $id){
        // Obligé de découper en 3 requêtes dû à l'organisation de la DB
        $query = "DELETE FROM affecter WHERE id_user = :id";
        $request = $this->pdo->prepare($query);
        $request->execute([':id' => $id]);

        $query = "DELETE FROM missions WHERE id_user = :id";
        $request = $this->pdo->prepare($query);
        $request->execute([':id' => $id]);

        $query = "DELETE FROM users WHERE id_user = :id";
        $request = $this->pdo->prepare($query);
        $request->execute([':id' => $id]);
    }

    //Pour l'utilisateur connecté
    public function getRole():string {
        $query = "SELECT roles.role_name FROM roles INNER JOIN affecter ON roles.id_role = affecter.id_role INNER JOIN users ON users.id_user = affecter.id_user WHERE users.user_name = :name";
        $request = $this->pdo->prepare($query);
        $request->execute([':name' => $_SESSION['user_name']]);
        $result = $request->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['role_name'];
        } else {
            echo '<h1>getRole ERROR</h1>';
            exit;
        }
    }

    //Pour tous les rôles lors de l'affichage des utilisateurs
    public function getUsersWithRoles() {
        $query = "SELECT users.id_user, users.user_name, users.user_mdp, roles.role_name, users.user_publication_number, users.user_account FROM users INNER JOIN affecter ON affecter.id_user = users.id_user INNER JOIN roles ON affecter.id_role = roles.id_role";
        $results = $this->pdo->query($query);
        return $results;
    }

    public function addUser($add_user_name, $add_user_mdp){
        $add_date = date('Y-m-d');
        $query = "INSERT INTO users(user_name, user_mdp, user_publication_number, user_account) VALUES (:name, :mdp, 0, :date)";
        $request = $this->pdo->prepare($query);
        $request->execute([
            ':name' => $add_user_name,
            ':mdp' => $add_user_mdp,
            ':date' => $add_date
        ]);
    }
}