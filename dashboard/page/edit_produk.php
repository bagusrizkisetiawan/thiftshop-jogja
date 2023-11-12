<?php

if(@$_SESSION['login']=='login'){
    $id_produk=$_GET['id_produk'];
    if (isset($_POST['posting'])) {
        $nama_produk=mysqli_real_escape_string($koneksi, "$_POST[nama_produk]");
        $harga_produk=mysqli_real_escape_string($koneksi, "$_POST[harga_produk]");
        $kategori_produk=@$_POST['kategori_produk'];
        $deskripsi_produk=mysqli_real_escape_string($koneksi, "$_POST[deskripsi_produk]");

        $foto_produk=$_FILES['foto_produk']['name'];
        $tmp_name=$_FILES['foto_produk']['tmp_name'];
        $size=$_FILES['foto_produk']['size'];
        $location="../asset/img/";

        
        
        if (!empty($foto_produk)) {
            $cek_foto_produk=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id_produk' && id_user='$id_user_login'"));
            unlink("../asset/img/$cek_foto_produk[foto_produk]");
            if ($size<=10000000) {
                move_uploaded_file($tmp_name, $location.$foto_produk);
                $posting=mysqli_query($koneksi, "UPDATE produk SET nama_produk='$nama_produk', foto_produk='$foto_produk', harga_produk='$harga_produk', id_kategori='$kategori_produk', keterangan_produk='$deskripsi_produk' where id_produk='$id_produk' && id_user='$id_user_login' ");
                if ($posting) {
                    $alert="<div class='alert alert-success'>Anda berhasil mengubah produk anda</div>";
                    echo "<meta http-equiv='refresh' content='2; url=?page=produk'>";
                }
            }else{
                $alert="<div class='alert alert-danger'>Maksimal foto 10 mb</div>";
            }
        }else{
            $posting=mysqli_query($koneksi, "UPDATE produk SET nama_produk='$nama_produk', harga_produk='$harga_produk', id_kategori='$kategori_produk', keterangan_produk='$deskripsi_produk' where id_produk='$id_produk' ");
            if ($posting) {
                $alert="<div class='alert alert-success'>Anda berhasil mengubah produk anda</div>";
                    echo "<meta http-equiv='refresh' content='2; url=?page=produk'>";
            }
        }

    }

$produk=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id_produk'"));


?>


    
<div class="card">
    <div class="card-header">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <h5 class="mb-0 text-primary">Form Edit Produk</h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                
                <?php echo @$alert ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" name="nama_produk" id="nama_produk" value="<?php echo$produk['nama_produk'] ?>" class="form-control mt-2 mb-3" required autofocus>
                    <label for="foto_produk">Foto Produk</label>
                    <input type="file" name="foto_produk" accept="image/*" id="foto_produk" value="<?php echo$produk['foto_produk'] ?>" class="form-control mt-2 mb-3">
                    <label for="harga">Harga Produk</label>
                    <input type="number" name="harga_produk" id="harga" value="<?php echo$produk['harga_produk'] ?>" class="form-control mt-2 mb-3" required>
                    <label for="kategori">Kategori Produk</label>
                    <select name="kategori_produk" id="kategori" class="form-control mt-2 mb-3" >
                        <?php 
                            $kategori_p=mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori='$produk[id_kategori]'");
                            $d_kategori=mysqli_fetch_array($kategori_p)
                        ?>
                        <option value="<?php echo $d_kategori['id_kategori'] ?>"><?php echo $d_kategori['nama_kategori'] ?></option>
                        
                        <?php 
                            $q_kategori=mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori!='$produk[id_kategori]'");
                            while ($data_kategori=mysqli_fetch_array($q_kategori)) {
                        ?>
                        <option value="<?php echo $data_kategori['id_kategori'] ?>"><?php echo $data_kategori['nama_kategori'] ?></option>
                        <?php } ?>
                    </select>
                    <label for="deskripsi_produk">Deskripsi Produk</label>
                    <textarea name="deskripsi_produk" id="deskripsi_produk" class="form-control mt-2 mb-3" rows="7" required><?php echo$produk['keterangan_produk'] ?></textarea>
                    <button name="posting" class="btn btn-primary w-100">Posting</button>
                </form>
            </div>
        </div>
    </div>
</div>
        
    

<?php
}else{
    header('location:../login.php');
}
