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
                <img src="../asset/images/yetupay.png" alt="YetuPay" id="main-logo">
            </div>
            <div class="row">
                <div class="col s12 card m6 offset-m3 radius z-depth-3 py-2">
                    <div class="container">
                        <div id="log">
                            <form action="#" class="col s12" id="connectForm">
                                <div class="row">
                                    <div class="col s12">
                                        <h5 style="margin-top:0">Connectez-vous</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="number" type="text" required>
                                        <label for="number">Numéro de téléphone</label>
                                        <i class="material-icons logicon tooltipped" data-position="top" data-tooltip="Le numéro de votre compte mobile money">info_outline</i>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="mdp" type="password" required>
                                        <label for="mdp">Mot de passe</label>
                                        <i class="material-icons logicon pass" title="Afficher le mot de passe" id="mdpi">visibility</i>
                                    </div>
                                </div>
                                <?php if (!isset($_GET['dev_key'])) { ?>
                                    <div class="row">
                                        <div class="col s12">
                                            <label>
                                                <input type="checkbox" id="stay_connected_log" />
                                                <span>Rester connecté</span>
                                            </label>
                                        </div>
                                    </div>
                                <?php } ?>
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
<script>
    var instance = M.Tabs.init(document.querySelectorAll('.tabs'), {
        swipeable: true
    });
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.tooltipped');
        var instances = M.Tooltip.init(elems, {
            position: 'top'
        });
        passicons = document.querySelectorAll('.pass');
        passicons.forEach(passicon => {
            passicon.addEventListener('click', function(e) {
                passID = e.target.id.substring(0, e.target.id.length - 1);
                if (e.target.innerText == 'visibility') {
                    e.target.innerText = 'visibility_off';
                    e.target.title = "Cacher le mot de passe";
                    document.querySelector('#' + passID).type = 'text';
                } else {
                    e.target.innerText = 'visibility';
                    e.target.title = "Afficher le mot de passe";
                    document.querySelector('#' + passID).type = 'password';
                }
            });
        });
    });
    document.querySelector('.carousel').style.height = '340px';
    <?php if (isset($_GET['dev_key'])) { ?> DEV_KEY = '<?= $_GET['dev_key'] ?>';
    <?php } ?>
</script>

</html>