<?php
    if (isset($_SESSION['user_id'])) {
        require_once('../../db_config/connection_manager.class.php');
        require_once('../../db_config/db_params.class.php');
        require_once('../../model/structure/project.class.php');
        require_once('../../model/dao/project.dao.php');
        
        $user_id = htmlspecialchars($_SESSION['user_id']); 
        $project = new Project(null,$user_id,null,null,null,null,null,null);
        $project_dao = new ProjectDAO();
        $proj = $project_dao->getProjectByDevId($user_id);
    }
?>