<?php

require_once './App/models/Users.php';

function display_menuAdmin(){
    require_once './config/twigConfig.php';

    $usersModel = new UsersModel();
    $role_name = $usersModel->getRole();
    $user_name = $usersModel->getName();

    echo $twig->render('menuAdmin.twig',[
        'role_name' => $role_name,
        'user_name' => $user_name
    ]);
}