<?php
include'../koneksi.php';
if($_SESSION['login']=='login'){

    $id_user_login=@$_SESSION['id_user'];
    $q_data_user_login=mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user_login'");
    $data_user_login=mysqli_fetch_array($q_data_user_login);
    
    $status=@$_GET['status'];
?>
<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard - ThriftShop Jogja</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../asset/logo/logo_thriftshopp-removebg-preview.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">

    
    <!-- Page CSS -->
    <link rel="stylesheet" href="../style.css">

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>

    
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-text demo menu-text text-primary fw-bolder ms-2">ThriftShop</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item <?php if($page=='dashboard' || empty($page)){echo'active';} ?>">
              <a href="?page=dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

            <!-- Layouts -->
            
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Produk</span>
            </li>

            <li class="menu-item <?php if($page=='tambah_produk'){echo'active';} ?>">
              <a href="?page=tambah_produk" class="menu-link">
                <i class="menu-icon tf-icons bx bx-navigation"></i>
                <div data-i18n="Analytics">Posting Produk</div>
              </a>
            </li>
            
            <li class="menu-item <?php if($page=='produk' || $page=='deskripsi' || $page=='edit_produk'){echo'active';} ?>">
              <a href="?page=produk" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cart"></i>
                <div data-i18n="Account Settings">produk</div>
              </a>
              
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>
            
            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <ul class="navbar-nav flex-row align-items-center me-auto">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                  <?php
                    if ($page=='produk') {
                      echo"<li class='breadcrumb-item active'><a href='?page=produk'>Produk</a></li>";
                    }
                    elseif($page=='tambah_produk'){
                      echo"<li class='breadcrumb-item active'><a href='?page=tambah_produk'></a>Posting Produk</li>";
                    }
                    if ($page=='edit_produk') {
                      echo"<li class='breadcrumb-item'><a href='?page=produk'>Produk</a></li>";
                      echo"<li class='breadcrumb-item active'><a href=''>Edit Produk</a></li>";
                    }
                    if ($page=='deskripsi') {
                      echo"<li class='breadcrumb-item'><a href='?page=produk'>Produk</a></li>";
                      echo"<li class='breadcrumb-item active'><a href=''>Info Produk</a></li>";
                    }
                  ?>
                  
                </ol>
              </nav>
                
              </ul>
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                
                <li class="nav-item dropdown">
                    <div class="nav-link dropdown-toggle hide-arrow py-0 " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="img-user" style="background-image: url('<?php if(!empty($data_user_login['foto'])){ echo "../asset/img/user/".$data_user_login['foto'];}else{?>https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__480.png<?php } ?>') ;"></div> 
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                          <a class="dropdown-item" href="#">
                              <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                  <div class="avatar ">
                                      <div class="img-user-2" style="background-image: url('<?php if(!empty($data_user_login['foto'])){ echo "../asset/img/user/".$data_user_login['foto'];}else{?>https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__480.png<?php } ?>') ;"></div> 
                                  </div>
                              </div>
                              <div class="flex-grow-1">
                                  <span class="fw-semibold d-block pe-5"><?php echo @$data_user_login['nama_user'];?></span>
                                  <small class="text-muted">Pengguna</small>
                              </div>
                              </div>
                          </a>
                        </li>
                        <li>
                        <div class="dropdown-divider"></div>
                        </li>
                        <li>
                          <a class="dropdown-item text-secondary py-2" href="../">
                              <i class="bx bx-undo me-2"></i>
                              <span class="">Kembali</span>
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item text-secondary py-2" href="?page=setting">
                              <i class="fa-solid fa-gear me-2"></i>
                              <span class="">Settings</span>
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item text-secondary py-2"  href="page/logout.php">
                              <i class="fa-solid fa-power-off me-2"></i>
                              <span class="">Log Out</span>
                          </a>
                        </li>
                    </ul>
                    
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              
            <?php

            if($page=='produk'){
                include'page/produk.php';
            }
            elseif($page=='tambah_produk'){
              include'page/tambah_produk.php';
            }
            elseif($page=='deskripsi'){
              include'page/deskripsi.php';
            }
            elseif($page=='setting'){
              include'page/setting.php';
            }
            elseif($page=='edit_produk'){
              include'page/edit_produk.php';
            }
            else{
                include'page/dashboard.php';
            }

            ?>

            </div>
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- datatables -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
      $(document).ready(function () {
          $('#datatable').DataTable();
      });
      $(document).ready(function () {
          $('#datatable_2').DataTable();
      });
    </script>
    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/89104220c0.js" crossorigin="anonymous"></script>
    

  </body>
</html>
<?php
}else{
    header('location:../login.php');
}
