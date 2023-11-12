<?php
$id_produk=@$_GET['id_produk'];

if ($proses=='hapus_keranjang') {
    $hapus_keranjang=mysqli_query($koneksi, "DELETE FROM keranjang WHERE id_produk='$id_produk' and id_user='$id_user_login'");
    if($hapus_keranjang){
        echo "<meta http-equiv='refresh' content='0; url=?page=keranjang'>";

    }
}

?>
<div class="bg-primary banner-produk" style="padding-top: 70px;">
    <div class="container pb-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="py-5 text-white text-center">
                    <h4 class="text-white">Keranjang Anda</h4>
                    <p class="">Kumpulan produk yang anda simpan di dalam keranjang</p>
                </div>
            </div>
            
        </div>
    </div>
</div>

<div class="container mb-3">
    <div class="card card-produk">
        <div class="card-body py-3">
            <?php
            $cek_keranjang=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM keranjang WHERE id_user='$id_user_login'"));
            if (empty($cek_keranjang)) {
                echo "<div class='alert alert-secondary mb-0'>Anda Belum memilih barang untuk di simpan di keranjang</div>";
            }
            ?>
            <div class="table-responsive-lg">
                <table class="w-100 table align-middle table-hover mb-0">
                <?php
                $q=mysqli_query($koneksi, "SELECT * FROM produk a LEFT JOIN user b ON a.id_user=b.id_user LEFT JOIN keranjang c ON a.id_produk=c.id_produk  WHERE tinjauan='disetujui' and c.id_user='$id_user_login' order by id_keranjang DESC");  
                while($data=mysqli_fetch_array($q)){
                ?>
                    <tr>
                        <td>
                            <div class="img-keranjang">
                                <img src="asset/img/<?php echo $data['foto_produk'] ?>" class="w-100" alt="">
                            </div>
                        </td>
                        <td class="text-start">
                            <h6 class="w-75">
                                <?php echo$data['nama_produk'] ?>
                            </h6>
                        </td>
                        <td>
                            <p class="card-text text-wight-bold mb-0">Rp <?php echo number_format("$data[harga_produk]", 2, ",", "."); ?></p>
                        </td>
                        <td class="text-end">
                            <a href="?page=deskripsi&&id_produk=<?php echo$data['id_produk'] ?>" class="btn btn-sm btn-primary">Deskripsi</a>
                            <a href="?page=keranjang&&proses=hapus_keranjang&&id_produk=<?php echo $data['id_produk'] ?>" class="btn btn-sm btn-danger" >Hapus</a>
                            <div class="btn-group">
                                <a href="https://wa.me/+62<?php echo $data['no_hp'] ?>?text=Apakah%20<?php echo nl2br( $data['nama_produk'] )?>%20masih%20ada?" target="_blank" class="btn btn-sm active btn-success"><i class="fa-brands fa-whatsapp"></i></a>
                                <a href="https://wa.me/+62<?php echo $data['no_hp'] ?>?text=Apakah%20<?php echo nl2br( $data['nama_produk'] )?>%20masih%20ada?" target="_blank" class="btn btn-sm btn-success">WhatsApp</a>
                            </div>
                        </td>
                    </tr>
                <?php }?>
                </table>
            </div>
        </div>
    </div>
</div>