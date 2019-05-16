<?php
    session_start();
    $tab_info= ["Name" => $_SESSION['full_name'],'Pseudo' => $_SESSION['pseudo'], "Mail" =>$_SESSION['email']];
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
    <title>Infos personnelles</title>
</head>

<body>
    <header class="yetu-orange second">
        <?php
        include_once('navbar.php');
        ?>
        <nav class="z-depth-0 yetu-orange">
            <div class="nav-wrapper">
                <div class="row mt-1">
                    <div class="col s10">
                        <h5 class="white-text">Infos personnelles</h5>
                    </div>
                    <?php
                    include_once('account-dropdown.php');
                    ?>
                </div>
                <div class="row center-align">
                    <div class="col s4 offset-s4 center">
                        <div class="carre second circle">
                            <h4>L</h4>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="row back-top">
        <div class="col s12">
            <div class="card z-depth-3 radius">
                <a class="btn-floating right half-top z-depth-3 btn-large waves-effect white modal-trigger" href="#edit_account">
                    <i class="material-icons blue-text">edit</i>
                </a>
                <?php 
                    $i= 0;
                    foreach ($tab_info as $key => $value) { ?>
                        <div class="card-content row">
                            <div class="col s2">
                                <a class="btn-floating btn-flat waves-effect waves-light red"><i class="lettre">L</i></a>
                            </div>
                            <div class="col s10">
                                <h6 class="truncate no-margin bolder"><?php echo $key; ?></h6>
                                <p class="truncate grey-text">
                                    <?php if(!empty($value)){ echo $value; }?>
                                </p>
                            </div>
                        </div>
                    <?php if ($i != 3 - 1) { ?>
                        <div class="divider"></div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="card z-depth-3 radius">
                <div class="card-content row">
                    <div class="col s10">
                        <h6 class="truncate no-margin bolder mt-1">Mot de passe</h6>
                    </div>
                    <div class="col s2">
                        <a class="btn-floating btn-flat waves-effect white modal-trigger" href="#edit_pwd"">
                            <i class=" material-icons blue-text">edit</i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="edit_account" class="modal radius">
        <form action="../../controller/user/update_profile.php" method="post">
            <div class="modal-content row">
                <h6>Modifier mon compte</h6><br>
                <div class="input-field col s12 m8 offset-m2">
                    <input id="name" name = 'name'type="text">
                    <label for="name">Nom</label>
                </div>
                <div class="input-field col s12 m8 offset-m2">
                    <input id="pseudo" type="text" name="pseudo">
                    <label for="speudo">Pseudo</label>
                </div>
                <div class="input-field col s12 m8 offset-m2">
                    <input id="mail" type="email" name="email">
                    <label for="mail">Mail</label>
                </div>
                <div class="row">
                    <div class="col s12">
                        <button class="waves-effect right yetu-blue white-text btn-action btn-flat" type="submit" name="action">Modifier</button>
                        <a href="#!" class="modal-close right waves-effect red-text btn-action btn-flat">Fermer</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="edit_pwd" class="modal radius">
        <form action="../../" method="post">
            <div class="modal-content row">
                <h6>Modifier le mot de passe</h6><br>
                <div class="input-field col s12 m8 offset-m2">
                    <input id="old" type="text">
                    <label for="old">Ancien</label>
                </div>
                <div class="input-field col s12 m8 offset-m2">
                    <input id="new" type="text">
                    <label for="new">Nouveau</label>
                </div>
                <div class="input-field col s12 m8 offset-m2">
                    <input id="confirm" type="email">
                    <label for="confirm">Confirmer nouveau</label>
                </div>
                <div class="row">
                    <div class="col s12">
                        <button class="waves-effect right yetu-blue white-text btn-action btn-flat" type="submit" name="action">Modifier</button>
                        <button class="modal-close right waves-effect red-text btn-action btn-flat">Fermer</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="../asset/js/sidenav-initer.js"></script>
<script src="../asset/js/modal-initer.js"></script>
<script src="../asset/js/dropdown-initer.js"></script>

</html>