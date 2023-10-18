<?php

require_once './App/models/Missions.php';
require_once './App/models/Users.php';

function displayMissions() {
    $missionsModel = new MissionsModel();
    $missions = $missionsModel->getMissions();

    $usersModel = new UsersModel();
    $user_name = $usersModel->getName();
    $role_name = $usersModel->getRole();

    require_once './config/twigConfig.php';
    $view = $twig->load('missions/updateMission.twig');
    echo $view->render([
        'missions' => $missions,
        'user_name' => $user_name,
        'role_name' => $role_name
    ]);
}

function deleteMission(int $id) {
    $missionsModel = new MissionsModel();
    $missionsModel->deleteMission($id);
    displayMissions();
}

function displayAddMission(){
    $usersModel = new UsersModel();
    $user_name = $usersModel->getName();
    $role_name = $usersModel->getRole();

    require_once './config/twigConfig.php';
    $view = $twig->load('missions/addMission.twig');
    echo $view->render([
        'user_name' => $user_name,
        'role_name' => $role_name
    ]);
}

function addMission(string $mission_name, string $mission_obj, $mission_date, string $mission_agency){
    $usersModel = new UsersModel();
    $mission_publication = $usersModel->getName();

    $missionsModel = new MissionsModel();
    $missionsModel->addMission($mission_name,$mission_obj,$mission_date,$mission_agency,$mission_publication);
    displayMissions();
}