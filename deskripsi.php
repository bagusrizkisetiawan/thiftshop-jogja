<?php
$id_produk=$_GET['id_produk'];

$produk_dilihat=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id_produk'"));
$dilihat=$produk_dilihat['dilihat']+1;
mysqli_query($koneksi, "UPDATE produk set dilihat='$dilihat' WHERE id_produk='$id_produk'");

if (isset($_POST['komentar'])) {
    $isi_komentar=mysqli_real_escape_string($koneksi, $_POST['isi_komentar']);
    $tanggal=date('d-M-Y');
    $komentar=mysqli_query($koneksi, "INSERT INTO komentar VALUES ('','$id_produk','$id_user_login','$isi_komentar','$tanggal')");
    if ($komentar) {
        echo "<meta http-equiv='refresh' content='0; url=?page=deskripsi&&id_produk=$id_produk'>";
    }
}

if ($proses=='keranjang') {
    $keranjang=mysqli_query($koneksi, "INSERT INTO keranjang VALUES ('','$id_produk','$id_user_login')");
    if($keranjang){
        echo "<meta http-equiv='refresh' content='0; url=?page=deskripsi&&id_produk=$id_produk'>";
    }
}
if ($proses=='hapus_keranjang') {
    $hapus_keranjang=mysqli_query($koneksi, "DELETE FROM keranjang WHERE id_produk='$id_produk' and id_user='$id_user_login'");
    if($hapus_keranjang){
        echo "<meta http-equiv='refresh' content='0; url=?page=deskripsi&&id_produk=$id_produk'>";

    }
}

$produk=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM produk a left join user b on a.id_user=b.id_user WHERE id_produk='$id_produk'"));

?>
<div class="container pt-5">
    <div class="row pt-4">
        <div class="col-lg-6 mb-5">
            <div class="card">
                <div class="card-img-top card-img-produk">
                    <img src="asset/img/<?php echo$produk['foto_produk'] ?>" alt="" class="img-produk-deskripsi">
                </div>
                <div class="card-body">
                    <h4 class="mt-2"><?php echo $produk['nama_produk'] ?></h4>
                    <div class="row">
                        <div class="col">
                            <p class="text-secondary small">
                                <?php 
                                    $kemarin= date('d-M-Y', strtotime('-1', strtotime($produk['tanggal'])));
                                    if($produk['tanggal']==date('d-M-Y')){
                                        echo "Hari ini";
                                    }
                                    elseif($produk['tanggal']==$kemarin){
                                        echo"Kemarin";
                                    }else{
                                        echo $produk['tanggal'];
                                    }
                                ?>
                                
                            </p>
                        </div>
                        <div class="col text-end">
                            <p class="text-secondary small"></p>
                        </div>
                    </div>
                    
                    <h5 class="mb-3">Rp <?php echo number_format("$produk[harga_produk]", 2, ",", "."); ?></h5>
                    <div class="btn-group me-2">
                        <a href="" class="btn btn-success active"><i class="fa-brands fa-whatsapp"></i></a>
                        <a target="_blank" href="https://wa.me/+62<?php echo $produk['no_hp'] ?>?text=Apakah%20<?php echo nl2br( $produk['nama_produk'] )?>%20masih%20ada?" class="btn btn-success">WhatsApp</a>
                    </div>

                    <?php
                    $cek_keranjang=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM keranjang where id_produk='$id_produk' and id_user='$id_user_login'"));
                    if(empty($cek_keranjang)){
                    ?>
                    <div class="btn-group">
                        <a href="?page=deskripsi&&proses=keranjang&&id_produk=<?php echo $id_produk ?>" class="btn btn-warning active text-white" <?php if (empty($id_user_login)){?>data-bs-toggle="modal" data-bs-target="#login_dahulu"<?php } ?>><i class="fa-solid fa-cart-shopping"></i></a>
                        <a href="?page=deskripsi&&proses=keranjang&&id_produk=<?php echo $id_produk ?>" class="btn btn-warning text-white" <?php if (empty($id_user_login)){?>data-bs-toggle="modal" data-bs-target="#login_dahulu"<?php } ?>>Keranjang</a>
                    </div>
                    <div class="modal fade" id="login_dahulu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header text-dark">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Peringatan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-dark">
                                Login atau masuk terlebih dahulu untuk menambahkan ke keranjang anda
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="login.php" name="simpan_data_diri" class="btn btn-primary">Lanjutkan</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <?php } else{?>
                    <div class="btn-group">
                        <a href="?page=deskripsi_produk&&proses=hapus_keranjang&&id_produk=<?php echo $id_produk ?>" class="btn btn-primary active text-white"><i class="fa-solid fa-cart-shopping"></i></a>
                        <a href="?page=deskripsi_produk&&proses=hapus_keranjang&&id_produk=<?php echo $id_produk ?>" class="btn btn-primary text-white">Tersimpan</a>
                    </div>
                    <?php }?>
                </div>
            </div>
            <div class="card mt-3 mb-3">
                <div class="card-body">
                    <table class="w-100">
                        <tr>
                            <td style="width: 80px;">
                                <?php 
                                     if ($produk['foto']!='') {
                                        echo "<div class='img-user-deskripsi' style='background-image: url(asset/img/user/".$produk['foto'].") ;'></div> ";
                                     }else{
                                         echo "<div class='img-user-deskripsi' style='background-image: url(https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__480.png) ;'></div> ";
                                     }
                                ?>
                            </td>
                            <td>
                                <h6 class="mb-0"><?php echo $produk['nama_user'] ?></h6>
                                <p class="text-secondary mb-1" style="font-size: 12px;">Penjual</p>
                                <p class="mb-0 small"><i class="fa-solid fa-location-pin"></i> <?php echo $produk['alamat'] ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <did class="card mb-3">
                <div class="card-body">
                    <h6>Deskripsi</h6>
                    <hr>
                    <p>
                        <?php echo nl2br($produk['keterangan_produk']) ?>
                    </p>
                </div>
            </did>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="form-control"  data-bs-toggle="modal" data-bs-target="#exampleModal">Tulis Komentar...</div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Peringatan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <?php if(!empty($id_user_login)){ ?>
                            <form action="" method="post">
                                <div class="modal-body">
                                    <textarea name="isi_komentar" id="" cols="30" rows="5" class="form-control" placeholder="Tulis Komentar" autofocus></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button name="komentar" class="btn btn-primary">Kirim</button>
                                </div>
                            </form>
                            <?php }else{?>
                            
                                <div class="modal-body">
                                    Login terlebih dahulu untuk melakukan komentar
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="login.php" class="btn btn-primary">Lanjutkan</a>
                                </div>
                            <?php }?>
                            </div>
                        </div>
                    </div>

                    <ul class="list-group list-group-flush mt-3">
                        <?php 
                        $q_komentar=mysqli_query($koneksi, "SELECT * FROM komentar a left join user b on a.id_user=b.id_user where id_produk='$id_produk' order by id_komentar DESC");
                        while($komentar=mysqli_fetch_array($q_komentar)){
                        ?>
                        <li class="list-group-item">
                            <table class="w-100">
                                <tr>
                                    <td width='50px' valign='top'>
                                    <?php 
                                     if ($komentar['foto']!='') {
                                        echo "<div class='img-user' style='background-image: url(asset/img/user/".$komentar['foto'].") ;'></div> ";
                                     }else{
                                         echo "<div class='img-user' style='background-image: url(https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__480.png) ;'></div> ";
                                     }
                                     ?>
                                    </td>
                                    <td>
                                        <p class="small mb-1">
                                            <span class="h6 mb-0"><?php echo $komentar['nama_user'] ?> </span>
                                            <span>
                                                <?php
                                                $cek_penjual=mysqli_query($koneksi, "SELECT * FROM produk a LEFT JOIN user b ON a.id_user=b.id_user WHERE id_produk='$id_produk'");
                                                $cek_komentar_penjual=mysqli_fetch_array($cek_penjual);
                                                if ($komentar['nama_user']==$cek_komentar_penjual['nama_user']) {
                                                    echo "(penjual)";
                                                }
                                                ?>
                                            </span>
                                            <span class="text-secondary">
                                            <?php 
                                                $kemarin= date('d-M-Y', strtotime('-1', strtotime($produk['tanggal'])));
                                                if($produk['tanggal']==date('d-M-Y')){
                                                    echo "Hari ini";
                                                }
                                                elseif($produk['tanggal']==$kemarin){
                                                    echo"Kemarin";
                                                }else{
                                                    echo $produk['tanggal'];
                                                }
                                            ?>
                                            </span> 
                                        </p>
                                        
                                        <p class="mb-0">
                                            <?php echo $komentar['komentar'] ?>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <h5 class="mb-3">Produk serupa</h5>
            <div class="row">
                <?php
                
                    $q=mysqli_query($koneksi, "SELECT * FROM produk a LEFT JOIN user b ON a.id_user=b.id_user WHERE tinjauan='disetujui' and id_kategori='$produk[id_kategori]' and id_produk!='$id_produk' order by id_produk DESC");
                    
                    while($data=mysqli_fetch_array($q)){
                ?>
                <div class="col-6 mb-3">
                    <div class="card card-hover">
                        <a href="?page=deskripsi&&id_produk=<?php echo$data['id_produk'] ?>" class="gradient-card-hover">
                            <div class="btn-hover-card"><i class="fa-solid fa-search"></i></div>
                        </a>
                        <div class="img-produk card-img-top" style="background-image: url('asset/img/<?php echo $data['foto_produk'] ?>');"></div>
                        <div class="card-body">
                            <p class="card-title h6"><?php echo substr($data['nama_produk'], 0, 30)."..."  ?></p>
                            <div class="row">
                                <div class="col-md-6">
                                <p class="small text-secondary" style="font-size: 11px;"><i class="fa-solid fa-location-pin"></i> <?php echo substr($data['alamat'], 0, 15)."..."  ?></p>
                                </div>
                                <div class="col-md-6 d-none d-md-inline text-end">
                                <p class="small text-secondary" style="font-size: 11px;"><i class="fa-solid fa-eye"></i> <?php echo $data['dilihat'] ?> &nbsp; &nbsp; <i class="fa-solid fa-comment"></i> 0</p>
                                </div>
                            </div>
                            <div class="card-footer p-1 card-harga mb-2">
                                <div class="row mb-0">
                                    <div class="col-md-6">
                                        <p class="card-text text-wight-bold mb-0">Rp<?php echo number_format("$data[harga_produk]", 2, ",", "."); ?></p>
                                    </div>
                                    <div class="col-md-6 d-none d-md-inline text-end">
                                        <p class="text-secondary mb-0 small" style="padding-top: 3px;">
                                        <?php 
                                            $kemarin= date('d-M-Y', strtotime('-1', strtotime($data['tanggal'])));
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
                </div>
                <?php }?>
            </div>
        </div>
    </div> 
</div>