<?php
session_start();
if(isset($_POST['name'],$_POST['pseudo'],$_POST['email'])){
    require_once('../../db_config/connection_manager.class.php');
    require_once('../../db_config/db_params.class.php');
    require_once('../../model/structure/user.class.php');
    require_once('../../model/dao/user.dao.php'); 
    
    $user_id = $_SESSION['user_id'];
    $full_name = $_POST['name'];
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];

    $user = new User($user_id,$full_name,$pseudo,$email,null,null,null,null,null,null,null,null,null,null);
    $userDAO = new UserDAO();
    if($userDAO->update_fullname($user) && $userDAO->update_pseudo($user) && $userDAO->update_email($user)){
        $_SESSION['full_name'] = $full_name;
        $_SESSION ['pseudo'] = $pseudo;
        $_SESSION ['email'] = $email;
        header ('location: ../../view/page/info-perso.php');
    } header('location: ../../view/page/info-perso.php?m=une erreur s\'est produite');

}