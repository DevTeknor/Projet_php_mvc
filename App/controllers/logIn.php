<?php 

require_once './App/models/Users.php';

function display_logIn(){
    require_once './config/twigConfig.php';

    echo $twig->render('logIn.twig');
}

function check_logs($name, $mdp){
    $userModel = new UsersModel();
    $user_mdp = $userModel->getLogs($name);
    // user_role pour vérifier si l'utilisateur a un rôle, s'il n'en a pas, error + ne rentre pas dans le site
    $user_role = $userModel->getRole();

    if($user_mdp === $mdp && $user_role !== null && $user_role !== ''){
        header('Location: /homepage');
        exit; 
    }
    else {
        header('Location: /login');
        exit;
    }
}