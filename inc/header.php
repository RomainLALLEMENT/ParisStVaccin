<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
				content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Accueil - ParisStVaccin</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poiret+One&family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
	<!-- STYLE.CSS -->
	<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<header id="header">
	<div class="wrap0">
		<nav>
			<ul>
				<li class="logo"><a href="#"><img src="https://blog-fr.orson.io/wp-content/uploads/2020/07/logostarbuck.png" alt=""></a></li>
				<li><a href="index.php">accueil</a></li>
				<li><a href="vaccins.php">Vaccins</a></li>
			</ul>
		</nav>
		<ul class="login">
        <?php if(isAdmin()) { ?>
					<li><a href="admin/index.php"><div class="icon_menu icon_admin"></div></a></li>
        <?php } ?>
        <?php if(isLogged()) { ?>
					<li><a href="add_vaccin_user.php"><div class="icon_menu icon_seringue"></div></a></li>
					<li><a href="#"><div class="icon_menu icon_carnet"></div></a></li>
					<li><a href="profil.php"><div class="icon_menu icon_user"></div></a></li>
					<li><a href="logout.php"><div class="icon_menu icon_logout"></div></a></li>
        <?php } else { ?>
					<li><a href="register.php">Inscription</a></li>
					<li><a href="login.php">Connexion</a></li>
        <?php } ?>
		</ul>
	</div>
</header>