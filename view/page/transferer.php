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
    <div class="row" id="bala-card">
        <div class="col s12">
            <div class="container">
                <form action="#" class="col s12 card z-depth-3 radius py2 " id="inscriptForm">
                    <div class="container">
                        <h5>Remplissez</h5>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="number" name="number" type="text" required>
                                <label for="number">Numéro du déstinaire</label>
                            </div>
                            <div class="input-field col s12">
                                <input id="pwd" name="pwd" type="password" required>
                                <label for="pwd">Mot de passe</label>
                            </div>
                            <div class="input-field col s8">
                                <input id="anount" type="text" required>
                                <label for="anount">Somme</label>
                            </div>
                            <div class="input-field col s4">
                                <select>
                                    <option value="1">CDF</option>
                                    <option value="2">USD</option>
                                </select>
                                <label>Devise</label>
                            </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
        });
    </script>
</body>

</html>