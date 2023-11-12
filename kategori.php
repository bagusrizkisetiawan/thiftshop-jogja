<?php
    
$id_kategori=$_GET['id_kategori'];
$kategori=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM kategori where id_kategori='$id_kategori'"));

?>
    
<div class="" style="padding-top: 50px;">
    <div class="bg-primary text-white">  
        <div class="container py-3">
            <div class="py-5 text-center">
                <h4 class="text-white"><?php echo $kategori['nama_kategori'] ?></h4>
                <p class="">Kumpulan produk dengan kategori <?php echo $kategori['nama_kategori'] ?></p>
            </div>
        </div>
    </div>
</div>

    <div class="container mb-3 mt-3">
        <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#pilih_kategori">Pilih Kategori Produk</a>
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
                                    <a href="?page=kategori&&id_kategori=<?php echo$data_kategori['id_kategori'] ?>" class="card-body text-center text-decoration-none">
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
        <div class="row mt-2">
            <?php
                
                $q=mysqli_query($koneksi, "SELECT * FROM produk a LEFT JOIN user b ON a.id_user=b.id_user WHERE tinjauan='disetujui' and id_kategori='$id_kategori' order by id_produk DESC");
                $cek_produk=mysqli_num_rows($q);
                if(empty($cek_produk)){
                    echo "<div class='alert alert-secondary m-2'>Produk yang anda cari tidak tersedia</div>";
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
    </div>