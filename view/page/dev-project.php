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
    <title>Mes projets</title>
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
                        <h5 class="white-text">Mes projets</h5>
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

    <div class="row back-top">
        <div class="col s12">
            <div class="card z-depth-3 radius">
                <?php for ($i = 0; $i < 3; $i++) { ?>
                    <div class="card-content row">
                        <div class="col s2">
                            <a class="btn-floating btn-flat waves-effect waves-light red"><i class="lettre">L</i></a>
                        </div>
                        <div class="col s10">
                            <p class="grey-text right">
                                <small>
                                    20/06/18
                                </small>
                            </p>
                            <h6 class="truncate no-margin bolder">LibTarta</h6>
                            <p class="truncate grey-text">
                                clé: TDDV50F06XDV5D06V1D0
                            </p>
                        </div>
                    </div>
                    <?php if ($i != 3 - 1) { ?>
                        <div class="divider"></div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>

    <a id="adding-button" class="btn-floating z-depth-3 btn-large waves-effect waves-light yetu-orange modal-trigger" href="#adding_project"><i class="material-icons">add</i></a>
    <div id="adding_project" class="modal radius">
        <form action="#" method="post">
            <div class="modal-content">
                <h5>Ajouter un projet</h5><br>
                <div class="row">
                    <div class="input-field col s12 m8 offset-m2">
                        <input id="name" type="text">
                        <label for="name">Nom</label>
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

</html>