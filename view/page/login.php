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
    <title>Connexion</title>
</head>

<body>
    <section>
        <div class="row container">
            <div class="col s12 center-align">
                <object class="my-1-2" data="../asset/images/yetupay.svg" height="150" type="image/svg+xml">
                    <embed class="my-1-2" src="../asset/images/yetupay.svg" height="150" type="image/svg+xml" />
                </object>
            </div>
            <div class="row">
                <div class="col s12 card m6 offset-m3 radius z-depth-3 py-2">
                    <div class="container">
                        <div id="log">
                            <form action="../../controller/user/log_in.php" method='post'class="col s12" id="connectForm">
                                <div class="row">
                                    <div class="col s12">
                                        <h5 style="margin-top:0">Connectez-vous</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="number" type="text" name='phone_number' required>
                                        <label for="number">Numéro de téléphone</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="mdp" type="password" name='password' required>
                                        <label for="mdp">Mot de passe</label>
                                        <i class="material-icons logicon pass" data-input="mdp" title="Afficher le mot de passe" id="mdpi">visibility</i>
                                    </div>
                                </div>
                                <?php if (!isset($_GET['dev_key'])) { ?>
                                    <div class="row">
                                        <div class="col s12">
                                            <label>
                                                <input type="checkbox" name="stay_connected" id="stay_connected_log" />
                                                <span>Rester connecté</span>
                                            </label>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="row">
                                    <div class="col s12">
                                        <a href="sigin.php">vous n'avez pas de compte?</a>
                                    </div>
                                </div>
                                <div class="col s12">
                                    <button class="waves-effect waves-light btn right tuma yetu-blue btn-action" id="Fsignin" type="submit" name="action">
                                        Se connecter
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="../asset/js/pass-view.js"></script>
<script>
    <?php if(isset($_GET['code'])){
        if($_GET['code']== -4) echo "M.toast({html: 'L\'identifiant et le mot de passe ne correspondent pas'})";
    } ?>
    <?= isset($_GET['m']) ? "M.toast({html: '" . $_GET['m'] . "'})" : "" ?>
    <?php if (isset($_GET['dev_key'])) { ?> DEV_KEY = '<?= $_GET['dev_key'] ?>';
    <?php } ?>
</script>

</html>