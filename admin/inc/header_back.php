<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>AdminWrap - Easy to Customize Bootstrap 4 Admin Template</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="fix-header card-no-border fix-sidebar">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label">Admin Wrap</p>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-light">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html">
                    <!-- Logo icon --><b>
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <img src="assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                        <!-- Light Logo icon -->
                        <img src="assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text --><span>
                         <!-- dark Logo text -->
                         <img src="assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                        <!-- Light Logo text -->
                         <img src="assets/images/logo-light-text.png" class="light-logo" alt="homepage" /></span> </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav mr-auto">
                    <!-- This is  -->
                    <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>
                    <!-- ============================================================== -->
                    <!-- Search -->
                    <!-- ============================================================== -->
                    <li class="nav-item hidden-xs-down search-box"> <a class="nav-link hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-search"></i></a>
                        <form class="app-search">
                            <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="fa fa-times"></i></a> </form>
                    </li>
                </ul>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <ul class="navbar-nav my-lg-0">
                    <!-- ============================================================== -->
                    <!-- Profile -->
                    <!-- ============================================================== -->
                    <li class="nav-item dropdown u-pro">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/1.jpg" alt="user" class="" /> <span class="hidden-md-down">Mark Sanders &nbsp;</span> </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li> <a class="waves-effect waves-dark" href="/" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Tableau de bord</span></a>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="table-basic.html" aria-expanded="false"><i class="fa fa-table"></i><span class="hide-menu">Tables</span></a>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="pages-blank.html" aria-expanded="false"><i class="fa fa-bookmark-o"></i><span class="hide-menu">Blank</span></a>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="list_user.php" aria-expanded="false"><i class="fa fa-bookmark-o"></i><span class="hide-menu">Utilisateurs</span></a>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="role_user.php" aria-expanded="false"><i class="fa fa-bookmark-o"></i><span class="hide-menu">Rôles des utilisateurs</span></a>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="list_vaccin.php" aria-expanded="false"><i class="fa fa-bookmark-o"></i><span class="hide-menu">Vaccins</span></a>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="add_vaccin.php" aria-expanded="false"><i class="fa fa-bookmark-o"></i><span class="hide-menu">Ajouter un vaccin</span></a>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="edit_vaccin.php" aria-expanded="false"><i class="fa fa-bookmark-o"></i><span class="hide-menu">Modifier un vaccin</span></a>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="list_carnet.php" aria-expanded="false"><i class="fa fa-bookmark-o"></i><span class="hide-menu">Carnets</span></a>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="details_carnet.php" aria-expanded="false"><i class="fa fa-bookmark-o"></i><span class="hide-menu">Détails carnets</span></a>
                    </li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>