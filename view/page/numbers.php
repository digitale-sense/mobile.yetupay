<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../asset/css/font.css">
    <link rel="stylesheet" href="../asset/css/materialise.css">
    <script src="../asset/js/materialize.js"></script>
    <link rel="stylesheet" href="../asset/css/style.css">
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
                    <div class="col s2">
                        <ul class="right">
                            <li>
                                <a class="btn-floating waves-effect btn-small z-depth-0 white">
                                    <i class="material-icons grey-text white">person</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Screen off transaction -->
    <div class="row back-top">
        <div class="col s12">
            <div class="card z-depth-3 radius">
                <?php for ($i = 0; $i < 5; $i++) { ?>
                    <div class="card-content row">
                        <div class="col s2">
                            <a class="btn-floating waves-effect waves-light btn-small z-depth-0 white">
                                <i class="material-icons white-text violet">file_download</i>
                            </a>
                        </div>
                        <div class="col s10">
                            <p class="grey-text right">
                                <small>
                                    20/06/18
                                </small>
                            </p>
                            <h6 class="truncate no-margin bolder">Recharge</h6>
                            <p>20.000 FC</p>
                            <p class="truncate grey-text"># PP784575-1643-B46396</p>
                        </div>
                    </div>
                    <?php if ($i != 5 - 1) { ?>
                        <div class="divider"></div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- End Screen off transaction -->

    <a id="adding-button" class="btn-floating z-depth-3 btn-large waves-effect waves-light yetu-orange"><i class="material-icons">add</i></a>
    <div id="adding_number" class="modal">
        <div class="modal-content">
            <h4>Modal Header</h4>
            <p>A bunch of text</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
        </div>
    </div>
</body>
<script src="../asset/js/sidenav-initer.js"></script>

</html>