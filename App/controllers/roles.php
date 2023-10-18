<?php

require_once './App/models/Roles.php';
require_once './App/models/Users.php';

function displayAllRoles(){
    require_once './config/twigConfig.php';

    $rolesModel = new RolesModel();
    $roles = $rolesModel->getAllRoles();

    $usersModel = new UsersModel();
    $user_name = $usersModel->getName();
    $role_name = $usersModel->getRole();

    $view = $twig->load('roles/roles.twig');
    echo $view->render([
        'roles' => $roles,
        'user_name' => $user_name,
        'role_name' => $role_name
    ]);   
}

function deleteRole(int $id){
    $rolesModel = new RolesModel();
    $rolesModel->deleteRole($id);
    displayAllRoles();
}

function addRole(string $name){
    $rolesModel = new RolesModel();
    $rolesModel->addRole($name);
    header('Location: /menuAdmin/addRole');
}

function displayAffectRole(){
    require_once './config/twigConfig.php';

    $usersModel = new UsersModel();
    $user_name = $usersModel->getName();
    $role_name = $usersModel->getRole();

    $view = $twig->load('roles/affectRole.twig');
    echo $view->render([
        'user_name' => $user_name,
        'role_name' => $role_name
    ]);
}

function affectRole(int $id_user, int $id_role){
    $rolesModel = new RolesModel();
    $rolesModel->affectRole($id_user, $id_role);
    displayAffectRole();
}
