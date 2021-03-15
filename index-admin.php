<?php
include 'koneksi.php';
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING)); 

session_start();

if (!isset($_SESSION["login"])) {
    header ("Location: login.php");

    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Point of Sale</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">Point of Sales</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

            <!-- Navbar Search-->
<!--             <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form> -->

            <!-- Navbar-->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <!-- <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a> -->
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION["nama_user"]; ?></span>
                    <img class="rounded-circle" src="assets/img/undraw_profile.svg" style="height: 2rem; width: 2rem;">
                    </a>
<!--                     <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="?page=setting">Akun</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div> -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="?page=user_profile">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                        </a>
                        <a class="dropdown-item" href="?page=setting">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Main Menu</div>
                            <a class="nav-link" href="index-admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Home
                            </a>

<!--                             <a class="nav-link" href="?page=user_profile">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Informasi Profile
                            </a> -->

                            <a class="nav-link" href="?page=informasi_toko">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Informasi Toko
                            </a>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#datamaster" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Data Master
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="datamaster" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="?page=vendor">Data Vendor</a>
                                    <a class="nav-link" href="?page=barang">Data Barang</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaksipenjualan" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Transaksi Penjualan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="transaksipenjualan" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="?page=penjualan">Penjualan</a>
                                    <a class="nav-link" href="?page=laporan_penjualan">Laporan Penjualan</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaksipembelian" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Transaksi Pembelian
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="transaksipembelian" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="?page=pembelian">Pembelian</a>
                                    <a class="nav-link" href="?page=laporan_pembelian">Laporan Pembelian</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="?page=kelola_user">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Kelola User
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?= $_SESSION["nama_user"]; ?>
                    </div>
                </nav>
            </div>

            <!-- sisi kanan -->
            <div id="layoutSidenav_content">
                <?php 
                	$page = $_GET['page'];
                	$aksi = $_GET['aksi'];


                	if ($page == "barang") {
                		if ($aksi == "") {
                			include "page/barang/barang.php";
                		}

                		if ($aksi == "tambah") {
                			include "page/barang/tambah.php";
                		}

                		if ($aksi == "edit") {
                			include "page/barang/edit.php";
                		}

                		if ($aksi == "delete") {
                			include "page/barang/delete.php";
                		}
                	}

                    if ($page == "vendor") {
                        if ($aksi == "") {
                            include "page/vendor/vendor.php";
                        }

                        if ($aksi == "tambah") {
                            include "page/vendor/tambah.php";
                        }

                        if ($aksi == "edit") {
                            include "page/vendor/edit.php";
                        }

                        if ($aksi == "delete") {
                            include "page/vendor/delete.php";
                        }
                    }

                	if ($page == "kelola_user") {
                		if ($aksi == "") {
                			include "page/kelola_user/kelola_user.php";
                		}

                		if ($aksi == "tambah") {
                			include "page/kelola_user/tambah.php";
                		}

                		if ($aksi == "edit") {
                			include "page/kelola_user/edit.php";
                		}

                		if ($aksi == "delete") {
                			include "page/kelola_user/delete.php";
                		}
                	}

                	if ($page == "penjualan") {
                		if ($aksi == "") {
                			include "page/penjualan/penjualan.php";
                		}

                		if ($aksi == "tambah") {
                			include "page/penjualan/tambah.php";
                		}

                		if ($aksi == "edit") {
                			include "page/penjualan/edit.php";
                		}

                		if ($aksi == "delete") {
                			include "page/penjualan/delete.php";
                		}
                	}

                    if ($page == "pembelian") {
                        if ($aksi == "") {
                            include "page/pembelian/pembelian.php";
                        }

                        if ($aksi == "tambah") {
                            include "page/pembelian/tambah.php";
                        }

                        if ($aksi == "edit") {
                            include "page/pembelian/edit.php";
                        }

                        if ($aksi == "delete") {
                            include "page/pembelian/delete.php";
                        }
                    }

                    if ($page == "laporan_penjualan") {
                        if ($aksi == "") {
                            include "page/laporan_penjualan/laporan.php";
                        }
                        if ($aksi == "view-detail") {
                            include "page/laporan_penjualan/view-detail.php";
                        }
                        
                    
                    }

                    if($page == "laporan_pembelian") {
                        if ($aksi == "") {
                            include "page/laporan_pembelian/laporan_pembelian.php";
                        }
                        if ($aksi == "view") {
                            include "page/laporan_pembelian/view.php";
                        }

                    }

                    if($page == "setting"){
                        include "page/setting/setting.php";
                    }

                    if($page == "informasi_toko"){
                        include "page/informasi_toko/informasi_toko.php";
                    }

                    if($page == "user_profile"){
                        include "page/user_profile/user_profile.php";
                    }

                    if ($page == "") {
                        include "home.php";
                    }
                ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>