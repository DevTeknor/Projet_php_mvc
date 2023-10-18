<?php

require_once './App/models/Missions.php';
require_once './App/models/Users.php';

function displayUsers() {
    require_once './config/twigConfig.php';

    $usersModel = new UsersModel();
    // $users = $usersModel->getUsers();
    $users = $usersModel->getUsersWithRoles();
    $user_name = $usersModel->getName();
    $role_name = $usersModel->getRole();

    $view = $twig->load('users/updateUser.twig');
    echo $view->render([
        'users' => $users,
        'user_name' => $user_name,
        'role_name' => $role_name
    ]);
}

function deleteUser(int $id) {
    $usersModel = new UsersModel();
    $usersModel->deleteUser($id);
    displayUsers();
}


function displayAddUser(){
    require_once './config/twigConfig.php';

    $usersModel = new UsersModel();
    $user_name = $usersModel->getName();
    $role_name = $usersModel->getRole();

    $view = $twig->load('users/addUser.twig');
    echo $view->render([
        'user_name' => $user_name,
        'role_name' => $role_name
    ]);
}

function addUser(string $add_user_name, string $add_user_mdp){
    $usersModel = new UsersModel();
    // Sécurité : si l'utilisateur est Modérateur, il ne doit pas retomber sur la page updateUser qui permet de supprimer les users
    $role_name = $usersModel->getRole();
    $usersModel->addUser($add_user_name, $add_user_mdp);

    if($role_name === 'Admin'){
        header('Location: /menuAdmin/updateUser');
    }
    else {
        header('Location: /menuModerateur/addUser');
    }
}

function inscription(string $user_name, string $user_mdp){
    $usersModel = new UsersModel();
    $usersModel->inscription($user_name, $user_mdp);
    header('Location: /homepage');
}