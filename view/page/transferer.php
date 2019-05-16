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
    <link rel="stylesheet" href="../asset/css/input.css">
    <title>Transferer</title>
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
                                <span class="left">Transferer</span>
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
                <form action="../../controller/user/transfer.php" method="post" class="col s12 card z-depth-3 radius py2 " id="inscriptForm">
                    <div class="container">
                        <h5>Remplissez</h5>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="number" name="receiver_login" type="text" required>
                                <label for="number">Numéro du déstinaire</label>
                            </div>
                            <div class="input-field col s12">
                                <input id="pwd" name="password" type="password" required>
                                <label for="pwd">Mot de passe</label>
                            </div>
                            <div class="input-field col s8">
                                <input id="anount" name='amount' type="text" required>
                                <label for="anount">Somme</label>
                            </div>
                            <div class="input-field col s4">
                                <select name='currency'>
                                    <option value="CDF">CDF</option>
                                    <option value="USD">USD</option>
                                </select>
                                <label>Devise</label>
                            </div>
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                            <div class="col s12">
                                <button class="waves-effect waves-light btn right yetu-blue btn-action tuma" id="Flogin" type="submit" name="action">
                                    Transferer
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../asset/js/sidenav-initer.js"></script>
    <script src="../asset/js/select-initer.js"></script>
    <script src="../asset/js/dropdown-initer.js"></script>

    <script>
        <?= isset($_GET['m']) ? "M.toast({html: '" . $_GET['m'] . "'})" : "" ?>
    </script>
</body>

</html>