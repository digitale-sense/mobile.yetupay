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
    <title>Mode développeur</title>
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
                        <h5 class="white-text">Mode développeur</h5>
                    </div>
                    <?php
                    include_once('account-dropdown.php');
                    ?>
                </div>
            </div>
        </nav>
    </header>

    <div class="row back-top">
        <div class="col s12">
            <div class="card z-depth-3 radius">
                <div class="row">
                    <div class="col s4 right-align">
                        <i class="material-icons medium">android</i>
                    </div>
                    <div class="col s4 center">
                        <i class="material-icons large">code</i>
                    </div>
                    <div class="col s4 left-align">
                        <i class="material-icons medium">public</i>
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