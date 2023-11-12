<?php

if(@$_SESSION['login_admin']=='login'){

$id_produk=$_GET['id_produk'];

if (isset($_POST['komentar'])) {
    $isi_komentar=mysqli_real_escape_string($koneksi, $_POST['isi_komentar']);
    $tanggal=date('d-M-Y');
    $komentar=mysqli_query($koneksi, "INSERT INTO komentar VALUES ('','$id_produk','$id_user_login','$isi_komentar','$tanggal')");
    if ($komentar) {
        echo "<meta http-equiv='refresh' content='0; url=?page=deskripsi&&id_produk=$id_produk'>";
    }
}

if ($proses=='hapus_komentar') {
    $id_komentar=$_GET['id_komentar'];
    $hapus_komentar=mysqli_query($koneksi, "DELETE FROM komentar WHERE id_komentar='$id_komentar'");
    if ($hapus_komentar) {
        echo "<meta http-equiv='refresh' content='0; url=?page=deskripsi&&id_produk=$id_produk'>";
    }
}

$produk=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM produk a left join user b on a.id_user=b.id_user WHERE id_produk='$id_produk'"));

?>

    
<div class="card shadow">
    <div class="card-body">

        <div class="row">
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-img-top card-img-produk">
                        <img src="../../asset/img/<?php echo$produk['foto_produk'] ?>" alt="" class="img-produk-deskripsi">
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
                                    
                                    <span class="small text-secondary ms-5" style="font-size: 11px;"><i class="fa-solid fa-eye"></i> <?php echo $produk['dilihat'] ?></span>
                                </p>
                            </div>
                            
                            
                        </div>
                        
                        <h5 class="mb-3">Rp <?php echo number_format("$produk[harga_produk]", 2, ",", "."); ?></h5>
                    </div>
                </div>

                <did class="card mt-3">
                    <div class="card-body">
                        <h6>Deskripsi</h6>
                        <hr>
                        <p>
                            <?php echo nl2br($produk['keterangan_produk']) ?>
                        </p>
                    </div>
                </did>
            </div>

            <div class="col-lg-6">
                <div class="card mb-3">
                    <div class="card-header  bg-light">
                    <h6 class="mb-0">Komentar</h6>
                    </div>
                    <div class="card-body pt-2">
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
                                            echo "<div class='img-user' style='background-image: url(../../asset/img/user/".$komentar['foto'].") ;'></div> ";
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
                                        <td class="text-end">
                                            <a href="?page=deskripsi&&proses=hapus_komentar&&id_produk=<?php echo $id_produk ?>&&id_komentar=<?php echo $komentar['id_komentar'] ?>" class="btn btn-sm btn-danger">hapus</a>
                                        </td>
                                    </tr>
                                </table>
                            </li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        
    

<?php
}else{
    header('location:../../../login.php');
}
