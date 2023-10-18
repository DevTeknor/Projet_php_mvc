<?php

require('./App/controllers/users.php');
require('./App/controllers/menuAdmin.php');
require('./App/controllers/menuModerateur.php');
require('./App/controllers/menuVisiteur.php');
require('./App/controllers/missions.php');
require('./App/controllers/logIn.php');
require('./App/controllers/homePage.php');
require('./App/controllers/roles.php');

//Le if est là par sécurité pour s'assurer que la session n'est pas encore lancée.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function route_request(){
    $route = $_SERVER['REQUEST_URI'];

    if ($route === '/login'){
        display_logIn();
    }
    // Utilité lors de la déconnexion, si un utilisateur se déconnecte et reste sur la page de login, personne ne pourra faire retour et ainsi être à nouveau connecté (en tant qu'Admin par exemple)
    else if ($route === '/newlogin'){
        $_SESSION['user_name'] = null;
        display_logIn();
    }
    else if ($route === '/login/check'){
        // Mise en mémoire de l'utilisateur qui se connecte
        $_SESSION['user_name'] = $_POST['user_name'];
        // Puis check des logs de connexion
        check_logs($_POST['user_name'],$_POST['user_mdp']);
    }
    else if ($route === '/inscription'){
        $_SESSION['user_name'] = $_POST['user_name'];
        inscription($_POST['user_name'],$_POST['user_mdp']);
    }
    else if ($route === '/homepage'){
        display_homePage();
    }

    // Menu Admin
    else if ($route === '/menuAdmin'){
        display_menuAdmin();
    }
    else if ($route === '/menuAdmin/addUser' || $route === '/menuModerateur/addUser'){  
        displayAddUser();
    }
    else if ($route === '/menuAdmin/sendAddUser'){
        addUser($_POST['add_user_name'],$_POST['add_user_mdp']);
    }
    else if ($route === '/menuAdmin/updateUser'){  
        displayUsers();
    }
    else if ($route === '/menuAdmin/deleteUser'){
        deleteUser($_POST['id_user']);
    }
    else if ($route === "/menuAdmin/addMission" || $route === "/menuModerateur/addMission"){  
        displayAddMission();
    }
    else if ($route === "/menuAdmin/sendAddMission"){  
        addMission($_POST['add_mission_name'],$_POST['add_mission_obj'],$_POST['add_mission_date'],$_POST['add_mission_agency']);
    }
    else if ($route === '/menuAdmin/updateMission' || $route === '/menuModerateur/updateMission'){  
        displayMissions();
    }
    else if ($route === '/menuAdmin/deleteMission'){
        deleteMission($_POST['id_mission']);
    }
    else if ($route === '/menuAdmin/addRole'){
        displayAllRoles();
    }
    else if ($route === '/menuAdmin/sendAddRole'){
        addRole($_POST['add_role_name']);
    }
    else if ($route === '/menuAdmin/affectRole'){
        displayAffectRole();
    }
    else if ($route === '/menuAdmin/sendAffectRole'){
        affectRole($_POST['affect_id_user'],$_POST['affect_id_role']);
    }
    else if ($route === '/menuAdmin/deleteRole'){
        deleteRole($_POST['id_role']);
    }

    // Menu modérateur (comme admin mais moins complet)
    else if ($route === '/menuModerateur'){
        displayMenuModerateur();
    }

    // Menu visiteur (aucune fonctionnalité)
    else if ($route === '/menuVisiteur'){
        displayMenuVisiteur();
    }


    //########### Traces de recherches (tentatives images) ############
    // else if ($route === "/App/views/images/logoOrbitWatch.png") {
        // $image = require_once('./App/views/images/logoOrbitWatch.png');
    //     return $image;
    // }
    else {
        echo '<h1>404 NOT FOUND</h1>';
    }
}

route_request();


