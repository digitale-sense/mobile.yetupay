<?php
    setcookie('user_id',$user->getId(),time()+30*24*3600,null,null,false,true);
    $_SESSION['user_id'] = $user->getId();
    $_SESSION['user_pass'] = $user->getPass();
    $_SESSION['full_name'] = $user->getFullname();
    $_SESSION['pseudo'] = $user->getPseudo();
    $_SESSION['email'] = $user->getEmail();
    $_SESSION['tel_airtel'] = $user->getTelAirtel();
    $_SESSION['tel_orange'] = $user->getTelOrange();
    $_SESSION['tel_vodacom'] = $user->getTelVodacom();
    $_SESSION['tel_africell'] = $user->getTelAfricell();
    $_SESSION['sign_in_datetime'] = $user->getSignInDatetime();
    $_SESSION['last_connection_datetime'] = $user->getLastConnectionDatetime();
    $_SESSION['last_connection_device'] = $user->getLastConnectionDevice();
    $_SESSION['developer_id'] = $developer->getId();
?>