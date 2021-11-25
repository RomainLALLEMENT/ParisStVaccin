<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
				content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Vaccinez-nous avec ParisStVaccin ! Soyez toujours protégé grâce à nous !</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poiret+One&family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon//favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon//favicon-16x16.png">
    <link rel="manifest" href="assets/img/favicon//site.webmanifest">
    <!-- STYLE.CSS -->
	<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<header id="header">
	<div class="wrap0">
		<nav>
			<ul>
				<li class="logo"><a href="index.php"><img src="assets/img/logo.png" alt="Logo Paris St Vaccin"></a></li>
				<li><a href="index.php">accueil</a></li>
				<li><a href="vaccins.php">Vaccins</a></li>
			</ul>
		</nav>
		<ul class="login">
        <?php if(isAdmin()) { ?>
					<li><a href="admin/index.php" title="Accéder à l'administration de Paris St Vaccin"><div class="icon_menu icon_admin"></div></a></li>
        <?php } ?>
        <?php if(isLogged()) { ?>
					<li><a href="add_vaccin_user.php" title="Ajouter un vaccin"><div class="icon_menu icon_seringue"></div></a></li>
					<li><a href="listVaccinsUser.php" title="Voir mon carnet"><div class="icon_menu icon_carnet"></div></a></li>
					<li><a href="profil.php" title="Voir mon profil"><div class="icon_menu icon_user"></div></a></li>
					<li><a href="logout.php" title="Se déconnecter"><div class="icon_menu icon_logout"></div></a></li>
        <?php } else { ?>
					<li><a href="register.php" title="S'inscrire">Inscription</a></li>
					<li><a href="login.php" title="Se connecter">Connexion</a></li>
        <?php } ?>
		</ul>
	</div>
    <style>
        .topnav {
            display: none;
            overflow: hidden;
            background-color: #FFFFFF;
            width: 100%;
        }

        .topnav a {
            float: left;
            display: block;
            color: #000000;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a.active {
            background-color: #7EDBDB;
            color: white;
        }

        .topnav a.login {
            background-color: #73625C;
            color: white;
        }

        .topnav .icon {
            display: none;
        }

        @media screen and (max-width: 700px) {
            #header .wrap0 {
                display: none;
            }
            .topnav {
                display: block;
            }
            .topnav a:not(:first-child) {display: none;}
            .topnav a.icon {
                float: right;
                display: block;
            }
        }

        @media screen and (max-width: 700px) {
            .topnav.responsive {position: relative;}
            .topnav.responsive .icon {
                position: absolute;
                right: 0;
                top: 0;
            }
            .topnav.responsive a {
                float: none;
                display: block;
                text-align: left;
            }
        }
    </style>
    <div class="topnav" id="myTopnav">
        <a href="index.php" class="active">Accueil</a>
        <a href="vaccins.php">Vaccins</a>
        <?php if(isAdmin()) { ?>
        <a href="admin/index.php">Administration</a>
        <?php } ?>
        <?php if(isLogged()) { ?>
        <a href="add_vaccins_user.php">Ajouter un vaccin</a>
        <a href="listVaccinsUser.php">Mon carnet</a>
        <a href="profil.php">Mon profil</a>
        <a href="logout.php" class="login">Déconnexion</a>
        <?php } else { ?>
        <a href="register.php" class="login">Inscription</a>
        <a href="login.php" class="login">Connexion</a>
        <?php } ?>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>
</header>