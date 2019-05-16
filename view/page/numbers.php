<?php 
    session_start();
    require_once('../../controller/user/sold.php');
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
    <link rel="stylesheet" href="../asset/css/input.css">
    <title>Mes numéros</title>
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
                        <h5 class="white-text">Mes numéros</h5>
                    </div>
                    <?php
                    include_once('account-dropdown.php');
                    ?>
                </div>
            </div>
        </nav>
    </header>

    <!-- Screen off transaction -->
    <div class="row back-top">
        <div class="col s12">
            <div class="card z-depth-3 radius">
                <?php 
                    $i=0;
                    foreach ($message['PHONE_NUMBER'] as $value) {
                        $operator='';
                        switch ($user->getOperator($value)) {
                            case '0':
                                $operator = 'airtel';
                                break;
                            case '1':
                                $operator = 'orange'; 
                                break;
                            case '2':
                                $operator = 'm-pesa';
                            default:
                                $operator = 'africell';
                                break;
                        }
                        if(!empty($value)){?>
                            <div class="card-content row">
                                <div class="col s2">
                                    <img src="../asset/images/<?php echo $operator ?>.png" alt="airtel" width="100%" class="circle">
                                </div>
                                <div class="col s10">
                                    <p class="grey-text right">
                                        <small>
                                            <?php echo $user->getSignInDatetime(); ?>.
                                        </small>
                                    </p>
                                    <h6 class="truncate no-margin bolder"><?php echo $operator ?></h6>
                                    <p class="truncate grey-text"><?php echo $value ?></p>
                                </div>
                            </div><?php 
                        }
                        if ( !empty($value) && $i != 3 - 1) { ?>
                            <div class="divider"></div><?php
                        } ?><?php 
                    } ?>
            </div>
        </div>
    </div>
    <!-- End Screen off transaction -->

    <a id="adding-button" class="btn-floating z-depth-3 btn-large waves-effect waves-light yetu-orange modal-trigger" href="#adding_number"><i class="material-icons">add</i></a>
    <div id="adding_number" class="modal radius">
        <form action="#" method="post">
            <div class="modal-content">
                <h5>Ajouter un numéro</h5><br>
                <div class="row">
                    <div class="input-field col s12 m8 offset-m2">
                        <select class="icons">
                            <option value="" disabled selected>Opérateur</option>
                            <option value="" data-icon="../asset/images/airtel.png" class="left">Airtel Money</option>
                            <option value="" data-icon="../asset/images/m-pesa.jpg" class="left">M-Pesa</option>
                            <option value="" data-icon="../asset/images/orange.png" class="left">Orange Money</option>
                        </select>
                        <label>Opérateur</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m8 offset-m2">
                        <input id="numero" type="text">
                        <label for="numero">Numéro</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <a href="#!" class="waves-effect right yetu-blue white-text btn-action btn-flat">Ajouter</a>
                        <a href="#!" class="modal-close right waves-effect red-text btn-action btn-flat">Fermer</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="../asset/js/sidenav-initer.js"></script>
<script src="../asset/js/modal-initer.js"></script>
<script src="../asset/js/select-initer.js"></script>
<script src="../asset/js/dropdown-initer.js"></script>

</html>