<?php

include'koneksi.php';

$id_user_login=@$_SESSION['id_user'];
$q_data_user_login=mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user_login'");
$data_user_login=mysqli_fetch_array($q_data_user_login);

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ThriftShop-Jogja</title>

    <link rel="icon" type="image/x-icon" href="asset/logo/logo_thriftshopp-removebg-preview.png" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- Core CSS -->
    <link rel="stylesheet" href="dashboard/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="dashboard/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="dashboard/assets/css/demo.css" />
    <link rel="stylesheet" href="style.css">
  </head>
  <body class="bg-white">

    <!-- Navbar -->
    <nav class="navbar border-bottom navbar-expand-lg fixed-top navbar-light bg-white ">
        <div class="container">
            <a class="navbar-brand h1 mb-0 " href="index.php"><h5 class="mb-0">ThriftShop-Jogja</h5></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex mt-3 ms-lg-3 mt-lg-0" method="post" action="?page=produk" role="search">
                <div class="input-group border-search">
                    <input type="text" name="pencarian" class="form-control border-0" placeholder="Search">
                    <button name="cari" class="btn bg-white border-0 text-primary" type="button" id="button-addon2"><i class="fa-solid fa-search"></i></button>
                </div>
            </form> 
            <ul class="navbar-nav me-auto mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link ms-lg-2" aria-current="page" href="index.php#">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ms-lg-2" aria-current="page" href="index.php#profil">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ms-lg-2" aria-current="page" href="?page=produk">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ms-lg-2 " aria-current="page" href="?page=keranjang">
                        Keranjang
                        <?php if(!empty($id_user_login)){ ?>
                        <span class=" badge rounded-pill bg-primary">
                            <?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM keranjang WHERE id_user='$id_user_login'")) ?>
                            <span class="visually-hidden">unread messages</span>
                        </span>
                        <?php }?>
                    </a>
                </li>
            </ul>
            
            <ul class="navbar-nav ms-auto">
                
                <?php
                if (@$_SESSION['login']=='login') {
                ?>
                <li class="nav-item">
                    <a class="btn btn-outline-primary btn-hover px-3 me-3 mb-3 mb-lg-0 " aria-current="page" href="dashboard/">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <div class="nav-link dropdown-toggle hide-arrow py-0 " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="img-user" style="background-image: url('<?php if(!empty($data_user_login['foto'])){ echo "asset/img/user/".$data_user_login['foto'];}else{?>https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__480.png<?php } ?>') ;"></div> 
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar ">
                                    <div class="img-user-2" style="background-image: url('<?php if(!empty($data_user_login['foto'])){ echo "asset/img/user/".$data_user_login['foto'];}else{?>https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__480.png<?php } ?>') ;"></div> 
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
                        <a class="dropdown-item text-secondary py-2" href="dashboard/?page=setting">
                            <i class="fa-solid fa-gear me-2"></i>
                            <span class="">Settings</span>
                        </a>
                        </li>
                        
                        <li>
                        <a class="dropdown-item text-secondary py-2"  href="dashboard/page/logout.php">
                            <i class="fa-solid fa-power-off me-2"></i>
                            <span class="">Log Out</span>
                        </a>
                        </li>
                    </ul>
                    
                </li>
                
                <?php
                }else{
                ?>
                <li class="nav-item">
                <a class="btn btn-outline-primary btn-hover px-3 mb-2 mb-lg-0" aria-current="page" href="login.php">Masuk</a>
                </li>
                <li class="nav-item">
                <a class="btn btn-primary bg-orange text-white ms-lg-2 px-3 " aria-current="page" href="registrasi.php">Daftar</a>
                </li>
                
                <?php } ?>
            </ul>
            </div>
        </div>
    </nav>

    
    <?php

    if ($page=='produk') {
        include"produk.php";
    }
    elseif ($page=='kategori') {
        include"kategori.php";
    }
    elseif ($page=='deskripsi') {
        include"deskripsi.php";
    }
    elseif ($page=='keranjang') {
        include"keranjang.php";
    }
    else{
        include'beranda.php';
    }

    ?>



    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/89104220c0.js" crossorigin="anonymous"></script>
  </body>
</html>