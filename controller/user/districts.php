<?php
if(isset($_POST['user_id'],$_POST['town_id'])){
    require_once('../../db_config/connection_manager.class.php');
    require_once('../../db_config/db_params.class.php');
    require_once('../../m/structure/user.class.php');
    require_once('../../m/dao/user.dao.php');
    require_once('../../m/structure/town.class.php');
    require_once('../../m/structure/township.class.php');
    require_once('../../m/structure/district.class.php');
    $town = new Town($_POST['town_id'],null,null);
    $user_dao = new UserDAO();
    $districts = array();
    $townships = $user_dao->get_townships($town);
    for ($i=0; $i<count($townships); $i++){
        $township_districts = $user_dao->get_districts($townships[$i]);
        $township = array();
        for($j=0; $j<count($township_districts); $j++)
            $township[] = array($township_districts[$j]->getId(),$township_districts[$j]->getName());
        $districts[$townships[$i]->getName()] = $township;
    }
}
?>