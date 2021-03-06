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
    <title>Inscription</title>
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
                        <div id="sign">
                            <form action="../../controller/user/sign_in.php" class="col s12" method="post" id="connectForm">
                                <div class="row">
                                    <div class="col s12">
                                        <h5 style="margin-top:0">Inscrivez-vous</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="number" type="text" name="phone_number" required>
                                        <label for="number">Numéro de téléphone</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="mdp" type="password" name="password"required>
                                        <label for="mdp">Mot de passe</label>
                                        <i class="material-icons logicon pass" data-input="mdp" title="Afficher le mot de passe" id="mdpi">visibility</i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="cmdp" type="password" name="password" required>
                                        <label for="cmdp">Confirmez le mot de passe</label>
                                        <i class="material-icons logicon pass" data-input="cmdp" title="Afficher le mot de passe" id="mdpi">visibility</i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12">
                                        <a href="login.php">vous avez déjà un compte?</a>
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
        if($_GET['code']==0) echo "M.toast({html: 'Ce numéro exist déjà'})";
        else if($_GET['code']== -1) echo "M.toast({html: 'Mauvais format de numéro du téléphone'})";
        else if($_GET['code']== -2) echo "M.toast({html: 'Le mot de passe a moins de 8 caractères'})";
    } ?>
    <?php if (isset($_GET['dev_key'])) { ?> DEV_KEY = '<?= $_GET['dev_key'] ?>';
    <?php } ?>
</script>
</html>