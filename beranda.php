<!-- banner -->
<div class="banner bg-light py-5">
    <div class="container py-5">
        <div class="row py-4">
            <div class="col-lg-7 py-5">
                <?php if (@$_SESSION['login']=='login') { ?>
                    <h2 class="mt-3 mt-lg-5">Hai,<br><?php echo @$data_user_login['nama_user'];?></h2>
                <?php }else{?>
                    <h5 class=" mt-3 mt-lg-5 text-primary">Fashionable and Affordable</h5>

                    <h2 >Bangun Usaha Thriftmu <br>Bersama ThriftShop-Jogja</h2>

                <?php } ?>
                <p>Mulai berjualan dengan posting pakaianmu</p>    
                <?php if(empty($id_user_login)){?>
                <a href="registrasi.php" class="btn btn-primary text-white px-4 py-2 mt-3">Daftar Sekarang</a>   
                <?php }else{?>                
                <a href="dashboard/?page=tambah_produk" class="btn btn-primary text-white px-4 py-2 mt-3" <?php if (empty($data_user_login['no_hp'])){?>data-bs-toggle="modal" data-bs-target="#lengkapi_data_diri"<?php } ?>>Posting Sekarang</a>
                <?php } ?>
                <div class="modal fade" id="lengkapi_data_diri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header text-dark">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Lengkapi data diri anda</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-dark">
                            Lengkapi data diri anda terlebih dahulu di halaman setting acount sebelum anda memposting produk anda
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="dashboard/index.php?page=setting" name="simpan_data_diri" class="btn btn-primary">Lanjutkan</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-flex">
                <div class="bg-img-banner">
                    <div class="img-banner"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- profil -->
<div class=" py-5 mb-3 " id="profil">
    <div class="container py-3">
        <div class="row">
            <div class="col-lg-6 mt-3 p-3">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <di class="d-block img-profil img-profil-1"></di>
                        </div>
                        <div class="carousel-item">
                        <di class="d-block img-profil img-profil-2"></di>
                        </div>
                        <div class="carousel-item">
                        <di class="d-block img-profil img-profil-3"></di>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-lg-6  p-3 p-lg-5">
                <div class="py-5">
                    <p class="display-6 text-primary">ThriftShop-Jogja</p>
                    <p class="mb-4">Thriftshop Jogja merupakan wadah transaksi jual beli barang thrift dengan harga miring, kualitas terjamin serta sistem yang aman dan nyaman</p>
                    
                    <hr>
                    <p class="display-6 text-primary">Kenapa Harus ThriftShop-Jogja</p>
                    <p>Belanja barang thrift dimana saja, mudah dan aman dengan pilihan yang beragam, Thriftshop Jogja membantu kamu untuk tampil fashionable meski budget affordable</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class=" py-5 bg-light">
    <div class="container mb-3">
        <h4 class="text-center mb-5">Kategori Produk</h4>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="row justify-content-center">
                    <?php 
                        $q_kategori=mysqli_query($koneksi, "SELECT * FROM kategori LIMIT 6");
                        while ($data_kategori=mysqli_fetch_array($q_kategori)) {
                    ?>
                    <div class="col-lg-4 col-6">
                        <div class="card mb-3 card-kategori">
                            <a href="?page=kategori&&id_kategori=<?php echo$data_kategori['id_kategori'] ?>" class="card-body text-center text-decoration-none">
                                <?php echo $data_kategori['nama_kategori'] ?>
                            </a>
                        </div>
                    </div>
                    <?php }?>
                </div>
                <div class="row justify-content-end">
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link text-dark p-0 mt-3" href="#" data-bs-toggle="modal" data-bs-target="#pilih_kategori">Semua Kategori <i class="fa-solid fa-arrow-right"></i></a>
                            <div class="modal fade" id="pilih_kategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Kategori</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-4 col-6">
                                                    <div class="card mb-3 card-kategori">
                                                        <a href="?page=produk" class="card-body text-center text-decoration-none">
                                                            Semua Kategori
                                                        </a>
                                                    </div>
                                                </div>
                                                <?php 
                                                    $q_kategori=mysqli_query($koneksi, "SELECT * FROM kategori ");
                                                    while ($data_kategori=mysqli_fetch_array($q_kategori)) {
                                                ?>
                                                <div class="col-lg-4 col-6">
                                                    <div class="card mb-3 card-kategori">
                                                        <a href="produk.php?page=kategori&&id_kategori=<?php echo$data_kategori['id_kategori'] ?>" class="card-body text-center text-decoration-none">
                                                            <?php echo $data_kategori['nama_kategori'] ?>
                                                        </a>
                                                    </div>
                                                </div>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- produk -->
<div class="container mb-3 mt-5">
    <h4 class="text-center">Produk</h4>
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <p class="text-secondary">Jelajahi produk yang ada di ThriftShop-Jogja dan dapatkan barang impianmu secara mudah </p>
        </div>
    </div>
    <div class="row mt-4"> 
    <?php
            $pecarian=@$_GET['pencarian'];
            if(!empty($pecarian)){
                $q=mysqli_query($koneksi, "SELECT * FROM produk a LEFT JOIN user b ON a.id_user=b.id_user WHERE tinjauan='disetujui' and nama_produk LIKE '%$pecarian%' || harga_produk LIKE '%$pecarian%' || keterangan_produk LIKE '%$pecarian%' order by id_produk DESC");
            }else{
                $q=mysqli_query($koneksi, "SELECT * FROM produk a LEFT JOIN user b ON a.id_user=b.id_user WHERE tinjauan='disetujui' order by id_produk DESC LIMIT 8");
            }
            while($data=mysqli_fetch_array($q)){
        ?>
        <div class="col-6 col-md-4 col-lg-3 mb-3">
            <div class="card h-100 card-hover">
                <a href="?page=deskripsi&&id_produk=<?php echo$data['id_produk'] ?>" class="gradient-card-hover">
                    <div class="btn-hover-card"><i class="fa-solid fa-search"></i></div>
                </a>
                
                <div class="img-produk card-img-top" style="background-image: url('asset/img/<?php echo $data['foto_produk'] ?>');"></div>
                <div class="card-body p-3">
                    <p class="card-title h6"><?php echo substr($data['nama_produk'], 0, 30)."..."  ?></p>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="small text-secondary" style="font-size: 11px;"><i class="fa-solid fa-location-pin"></i> <?php echo substr($data['alamat'], 0, 15)."..."  ?></p>
                        </div>
                    </div>
                </div>
                <div class="card-footer p-3 card-harga">
                    <div class="row mb-0">
                        <div class="col-md-6">
                            <h6 class="mb-0 ">Rp <?php echo number_format("$data[harga_produk]", 2, ",", "."); ?></h6>
                        </div>
                        <div class="col-md-6 d-none d-md-inline text-end">
                            <p class="text-secondary mb-0 small">
                            <?php 
                                $kemarin= date('d-M-Y', strtotime('-1 days', strtotime($data['tanggal'])));
                                if($data['tanggal']==date('d-M-Y')){
                                    echo "Hari ini";
                                }
                                elseif($data['tanggal']==$kemarin){
                                    echo"Kemarin";
                                }else{
                                    echo $data['tanggal'];
                                }
                            ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
    <div class="text-center mt-4">
        <a href="?page=produk" class="btn btn-primary text-white px-4 py-2 mb-5">Selengkapnya <i class="fa-solid fa-arrow-right"></i> </a>
    </div>
</div>


<div class="">
    <div class="container mb-5 mt-5 bg-primary text-white py-5" style="border-radius: 0.25rem;">
        <div class="text-center  mb-3 py-4">
            <h3 class="text-white">Tunggu Apa Lagi?</h3>
            <p>Ayo bangun usahamu bersama ThriftShop-Jogja</p>
            <?php if(empty($_SESSION['login'])){ ?>
            <a href="registrasi.php" class="btn btn-light text-primary px-4 mb-0">Daftar Sekarang</a>
            <?php }else{ ?>
            <a href="dashboard/?page=tambah_produk" class="btn btn-light text-primary px-4 mb-0">Daftar Sekarang</a>
            <?php } ?>
        </div>
    </div>
</div>

<footer class="bg-light mt-5 py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-4 mt-3">
                <h2 class="">ThriftShop-Jogja</h2>
                <p class="w-75">Bangun Usaha Thriftmu bersama ThriftShop-Jogja</p>
                <div class="mt-4">
                    
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <h5>Link Pintasan</h5>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php#profil">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="?page=produk">Lihat Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="page=keranjang">Produk Tersimpan</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 mt-3">
                <h5>Contact</h5>
                <a href="" class="nav-link">Hubungi Kami</a>
            </div>
            <dov class="col-md-2 mt-3">
                <h5>Support kami</h5>
                <a href="https://www.instagram.com/bagusrizkiiii/" target="_blank" class="h5 me-4 text-primary"><i class="fa-brands fa-instagram"></i></a>
                <a href="" class="h5 me-4 text-primary"><i class="fa-brands fa-twitter"></i></a>
                <a href="" class="h5 me-4 text-primary"><i class="fa-brands fa-facebook-f"></i></a>
            </dov>
        </div>
        <hr>
        &copy; Kelompok 6 KBBMI - ThriftShop-Jogja
    </div>
</footer>