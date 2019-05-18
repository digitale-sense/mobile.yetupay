<?php
    session_start();
    require_once('../../controller/user/sold.php');
    require_once('../../controller/user/transations.php');
?>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../asset/css/font.css">
    <link rel="stylesheet" href="../asset/css/materialise.css">
    <script src="../asset/js/materialize.js"></script>
    <link rel="stylesheet" href="../asset/css/style.css">
    <title>Mon portefeuille</title>
</head>

<body>
    <header class="yetu-orange">
        <?php
        include_once('navbar.php');
        ?>
        <nav class="z-depth-0 yetu-orange">
            <div class="nav-wrapper">
                <div class="row mt-1">
                    <div class="col s10">
                        <h5 class="white-text">Mon portefeuille</h5>
                    </div>
                    <?php
                    include_once('account-dropdown.php');
                    ?>
                </div>
            </div>
        </nav>
    </header>

    <!-- Screen balance -->
    <div class="row" id="bala-card">
        <div class="col s12">
            <div class="card z-depth-3 radius abstract">
                <div class="card-content">
                    <div class="row">
                        <h6 class="tranp-white col s8 center offset-s2 title-balance">Ma balance</h6>
                    </div>
                    <div class="row">
                        <div class="col s6" style="border-right:1px solid silver;">
                            <span class="card-title center bold-style"><?php   
                                if(empty($message['code']))
                                    echo $message['USD'].' '.'USD';
                                else
                                    echo '-4';
                            ?></span>
                        </div>
                        <div class="col s6">
                            <span class="card-title center bold-style"><?php
                                if(empty($message['code']))
                                    echo $message['CDF'].' '.'CDF';
                            ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End screen balance -->

    <!-- Controlle button -->
    <div class="row back-top">
        <div class="col s6 center">
            <a href="recharge.php" class="waves-effect btn-action waves-light yetu-blue btn">Recharger</a>
        </div>
        <div class="col s6 center">
            <a href="transferer.php"class="waves-effect btn-action waves-light yetu-blue btn">Transferer</a>
        </div>
        
    </div>
    <!-- End Controlle button -->

    <!-- Screen off transaction -->
    <div class="row back-top">
        <div class="col s12">
            <div class="card cr radius">
               <?php foreach ($transaction as $value) {?>
                <div class="card-content row">
                    <div class="col s2">
                        <a class="btn-floating waves-effect waves-light btn-small z-depth-0 white">
                            <i class="material-icons white-text violet">file_download</i>
                        </a>
                    </div>
                    <div class="col s10">
                        <p class="grey-text right">
                            <small>
                                <?php echo substr($value['datetime'],0,strpos($value['datetime'],' '))?>
                            </small>
                        </p>
                        <h6 class="truncate no-margin bolder">Recharge</h6>
                        <p><?php echo $value['amount'] .' '.$value['currency'] ?></p>
                        <p class="truncate grey-text"><?php echo $value['code']?></p>
                    </div>
                </div>
                <div class="divider"></div>              
               <?php }?>
            </div>
        </div>
    </div>
    <!-- End Screen off transaction -->
</body>
<script src="../asset/js/sidenav-initer.js"></script>
<script src="../asset/js/dropdown-initer.js"></script>

</html>