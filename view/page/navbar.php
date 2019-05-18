<nav class="yetu-orange z-depth-0">
    <div class="nav-wrapper">
        <a href="home.php" class="brand-logo">
            <object class="my-1-2" data="../asset/images/yetupay_blanc.svg" height="50" type="image/svg+xml">
                <embed class="my-1-2" src="../asset/images/yetupay_blanc.svg" height="50" type="image/svg+xml" />
            </object>
        </a>
        <ul id="nav-mobile" class="right hide-on-small-only">
            <li><a href="portefeuille.php" class="waves-effect">Acceuil</a></li>
            <li><a href="<?php
                            if(isset($_SESSION['developer_id']))
                                echo "dev-project.php";
                            else 
                                echo "home-dev.php";?>" class="waves-effect"><i class="material-icons">code</i>Développeur</a></li>
            <li><a href="numbers.php" class="waves-effect">Mes numéros</a></li>
        </ul>
        <ul class="left hide-on-med-and-up">
            <li>
                <a data-target="slide-out" class="sidenav-trigger">
                    <i class="material-icons" id="icon-menu">menu</i>
                </a>
            </li>
        </ul>
        <ul id="slide-out" class="sidenav">
            <li>
                <div class="user-view">
                    <div class="background">
                        <img src="../asset/images/BBG.jpg" width="100%">
                    </div>
                    <img class="circle" src="../asset/images/airtel.png">
                    <h6 class="black-text name"><strong><?php echo $_SESSION['full_name'];?></strong></h6>
                    <span class="black-text email"><?php echo $_SESSION['email'];?></span>
                </div>
            </li>
            <li><a href="portefeuille.php" class="waves-effect"><i class="material-icons">home</i>Acceuil</a></li>
            <li><a href="<?php
                            if(isset($_SESSION['developer_id']))
                                echo "dev-project.php";
                            else 
                                echo "home-dev.php";?>" class="waves-effect"><i class="material-icons">code</i>Développeur</a></li>
            <li><a href="numbers.php" class="waves-effect"><i class="material-icons">sim_card</i>Mes numéros</a></li>
            <li><a href="info-perso.php" class="waves-effect"><i class="material-icons">info</i>Infos personnelles</a></li>
            <li>
                <div class="divider"></div>
            </li>
            <li><a class="waves-effect" href="../../controller/deconnexion.php">Déconnexion</a></li>
        </ul>
    </div>
</nav>