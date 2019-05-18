<?php
    session_start();
    if (isset($_SESSION['user_id'], $_POST['type'], $_POST['name'])) {
        require_once('../../db_config/connection_manager.class.php');
        require_once('../../db_config/db_params.class.php');
        require_once('../../model/structure/project.class.php');
        require_once('../../model/dao/project.dao.php');
        
        $user_id = htmlspecialchars($_SESSION['user_id']); 
        $project = new Project(null,$user_id,$_POST['name'],null,$_POST['type'],null,null,null);
        $project_dao = new ProjectDAO();
        $project_dao->add($project);
        header('location: ../../view/page/dev-project.php');
    }
?>