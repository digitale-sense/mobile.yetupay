<?php session_start(); ?>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../asset/css/font.css">
    <link rel="stylesheet" href="../asset/css/materialise.css">
    <script src="../asset/js/materialize.js"></script>
    <link rel="stylesheet" href="../asset/css/style.css">
    <title>Recharger</title>
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
                        <a href="portefeuille.php">
                            <h5 class="white-text">
                                <i class="material-icons left">arrow_back</i>
                                <span class="left">Recharger</span>
                            </h5>
                        </a>
                    </div>
                    <?php
                    include_once('account-dropdown.php');
                    ?>
                </div>
            </div>
        </nav>
    </header>
    <div class="row" id="bala-card">
        <div class="col s12">
            <div class="container">
                <div class="row">
                    <div class="s12 col card z-depth-3 radius">
                        <h5>Choisissez un opérateur</h5>
                        <div class="col s6">
                            <a href="#">
                                <img src="../asset/images/m-pesa.jpg" width="100%" class="radius my-2 z-depth-1" alt="m-pesa">
                            </a>
                        </div>
                        <div class="col s6">
                            <a href="#">
                                <img src="../asset/images/airtel.png" width="100%" class="radius my-2 z-depth-1" alt="airtel-money">
                            </a>
                        </div>
                        <div class="col s6">
                            <a href="#">
                                <img src="../asset/images/orange.png" width="100%" class="radius my-2 z-depth-1" alt="orange-money">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../asset/js/sidenav-initer.js"></script>
<script src="../asset/js/dropdown-initer.js"></script>

</html>