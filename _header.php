<!DOCTYPE html>
<html lang="in">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>RIKI BAKERY</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

        <link rel="stylesheet" href="../assets/css/select2.min.css" />

        <!-- page specific plugin styles -->
        <link rel="stylesheet" href="assets/css/colorbox.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.css">

		<!-- dataTables -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>

		<!-- gritter notification -->
		<link rel="stylesheet" href="assets/css/jquery.gritter.min.css" />

        <?php
		function Tanggal($tanggal) {
			$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
			$tahun = substr($tanggal, 0, 4);
			$bulan = substr($tanggal, 5, 2);
			$tgl = substr($tanggal, 8, 2);

			$hasil = $tgl . " " . $BulanIndo[(int) $bulan - 1] . " " . $tahun;
			return ($hasil);
		}

		function Rupiah($rupiah) {
			//format rupiah
			$jumlah_desimal = "0";
			$pemisah_desimal = ",";
			$pemisah_ribuan = ".";

			$hasil = number_format($rupiah, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
			return ($hasil);
		}
		?>
	</head>

	<body class="skin-1">

        <div id="navbar" class="navbar navbar-default navbar-collapse h-navbar ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<div class="navbar-header pull-left">
                    <a href="./" class="navbar-brand">
                        <small>
                            <i class="fa fa-leaf"></i>
                            Riki Bakery
                        </small>
                    </a>

					<button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
						<span class="sr-only">Toggle user menu</span>

						<img src="assets/images/avatars/user.jpg" alt="Jason's Photo" />
					</button>

					<button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar">
						<span class="sr-only">Toggle sidebar</span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>
					</button>
				</div>

				<div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
                    <ul class="nav ace-nav">

                        <?php
                        if(isset($_SESSION['id_pelanggan'])){ ?>

                            <li class="transparent dropdown-modal">
                                <a data-toggle="" class="dropdown-toggle" href="./index.php?menu=keranjang">
                                    <i class="ace-icon fa fa-shopping-cart icon-animated-bell"></i>
                                </a>
                            </li>

                            <li class="light-blue dropdown-modal user-min">
                                <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                    <img class="nav-user-photo" src="assets/images/user.png" alt="User" />
                                    <span class="user-info">
                                        <small>Welcome,</small>
                                        <?= $_SESSION['nama_lengkap'] ?>
                                    </span>

                                    <i class="ace-icon fa fa-caret-down"></i>
                                </a>

                                <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

                                    <li>
                                        <a href="./index.php?menu=profil">
                                            <i class="ace-icon fa fa-user"></i>
                                            Profile
                                        </a>
                                    </li>

                                    <li class="divider"></li>

                                    <li>
                                        <a href="action/logout.php">
                                            <i class="ace-icon fa fa-power-off"></i>
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php
                        }else{ ?>
                            <li class="light-blue dropdown-modal user-min">
                                <a href="./index.php?menu=login"><i class="fa fa-user"></i> Login</a>
                            </li>
                            <?php
                        } ?>
                    </ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

            <div id="sidebar" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                <script type="text/javascript">
                    try{ace.settings.loadState('sidebar')}catch(e){}
                </script>

                <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                    <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                        <!-- <img src="assets/images/logo.jpg" alt="" class="img-responsive"> -->

                        <!-- <span class="btn btn-success"></span>

                        <span class="btn btn-info"></span>

                        <span class="btn btn-warning"></span>

                        <span class="btn btn-danger"></span> -->
                    </div>
                </div><!-- /.sidebar-shortcuts -->

                <ul class="nav nav-list">
                    <li class="<?php if($menu=='') echo "active hover"; ?>">
                        <a href="./">
                            <i class="menu-icon fa fa-cubes"></i>
                            <span class="menu-text"> Produk </span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="<?php if($menu=='konfirmasi') echo "active hover"; if(empty($_SESSION['id_pelanggan'])) echo "disabled" ?>">
                        <a href="./index.php?menu=konfirmasi">
                            <i class="menu-icon fa fa-money"></i>
                            <span class="menu-text"> Konfirmasi Pembayaran </span>
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <!-- <li class="open hover">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-desktop"></i>
                            <span class="menu-text">
                                UI &amp; Elements
                            </span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="active open hover">
                                <a href="#" class="dropdown-toggle">
                                    <i class="menu-icon fa fa-caret-right"></i>

                                    Layouts
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>

                                <b class="arrow"></b>

                                <ul class="submenu">
                                    <li class="active hover">
                                        <a href="top-menu.html">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Top Menu
                                        </a>

                                        <b class="arrow"></b>
                                    </li>

                                    <li class="hover">
                                        <a href="two-menu-1.html">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Two Menus 1
                                        </a>

                                        <b class="arrow"></b>
                                    </li>
                                </ul>
                            </li>

                            <li class="hover">
                                <a href="typography.html">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Typography
                                </a>

                                <b class="arrow"></b>
                            </li>

                        </ul>
                    </li> -->
                </ul><!-- /.nav-list -->
            </div>
