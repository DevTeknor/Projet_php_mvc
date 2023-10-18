<?php

require_once './App/models/Missions.php';
require_once './App/models/Users.php';

function display_homePage(){
    // Lorsque le require est à l'extérieur, $twig n'est pas reconnue
    require_once './config/twigConfig.php';  

    $missionsModel = new MissionsModel();
    $missions = $missionsModel->getMissions();

    $usersModel = new UsersModel();
    $role_name = $usersModel->getRole();
    $user_name = $usersModel->getName();

    $view = $twig->load('homePage.twig');
    echo $view->render([
        'missions' => $missions,
        'role_name' => $role_name,
        'user_name' => $user_name
    ]);
    
    // ########### Tests ###########
    // echo $twig->render('homePage.twig');
    // echo $twig->load('homePage.twig')->render(['missions' => $missions]);
    // echo $twig->render('homePage.twig', [
    //     'missions' => $missions
    // ]);
}