<?php
if (!empty($id_user_login)) {
    if (isset($_POST['posting'])) {
        $nama_produk=mysqli_real_escape_string($koneksi, "$_POST[nama_produk]");
        $harga_produk=mysqli_real_escape_string($koneksi, "$_POST[harga_produk]");
        $kategori_produk=mysqli_real_escape_string($koneksi, "$_POST[kategori_produk]");
        $deskripsi_produk=mysqli_real_escape_string($koneksi, "$_POST[deskripsi_produk]");

        $foto_produk=$_FILES['foto_produk']['name'];
        $tmp_name=$_FILES['foto_produk']['tmp_name'];
        $size=$_FILES['foto_produk']['size'];
        $location="../asset/img/";

        $tanggal=date('d-M-Y');
        

        if(!empty($kategori_produk)){
            if ($size<=10000000) {
                move_uploaded_file($tmp_name, $location.$foto_produk);
                $posting=mysqli_query($koneksi, "INSERT INTO produk VALUES ('','$id_user_login','$kategori_produk','$nama_produk','$harga_produk','$deskripsi_produk','$foto_produk','$tanggal','0','belum terjual','belum disetujui')");
                if ($posting) {
                    $alert="<div class='alert alert-success'>Produk anda akan di tinjau oleh admin terlebih dahulu</div>";
                    echo "<meta http-equiv='refresh' content='2; url=?page=posting_produk'>";
                }
            }else{
                $alert="<div class='alert alert-danger'>Maksimal foto 10 mb</div>";
            }
        }else{
            $alert="<div class='alert alert-danger'>Pilih kategori produk</div>";
        }
    }
?>


<div class="card shadow">
    <div class="card-header">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <h5 class="mb-0 text-primary">Form Posting Produk</h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <?php echo @$alert ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label class="text-secondary mt-2" for="nama_produk">Nama Produk</label>
                    <input type="text" name="nama_produk" id="nama_produk" class="form-control mt-2 mb-3" required autofocus>
                    <label class="text-secondary" for="foto_produk">Foto Produk</label>
                    <input type="file" name="foto_produk" accept="image/*" id="foto_produk" class="form-control mt-2 mb-3" required>
                    <label class="text-secondary" for="harga">Harga Produk</label>
                    <input type="number" name="harga_produk" id="harga" class="form-control mt-2 mb-3" required>
                    <label class="text-secondary" for="kategori">Kategori Produk</label>
                    <select name="kategori_produk" id="kategori" class="form-control mt-2 mb-3" required>
                        <option value="" disabled selected>Pilih kategori</option>
                        <?php 
                            $q_kategori=mysqli_query($koneksi, "SELECT * FROM kategori");
                            while ($data_kategori=mysqli_fetch_array($q_kategori)) {
                        ?>
                        <option value="<?php echo $data_kategori['id_kategori'] ?>"><?php echo $data_kategori['nama_kategori'] ?></option>
                        <?php } ?>
                    </select>
                    <label for="deskripsi_produk">Deskripsi Produk</label>
                    <textarea name="deskripsi_produk" id="deskripsi_produk" class="form-control mt-2 mb-3" rows="7" required></textarea>
                    <button name="posting" class="btn w-100 btn-primary">Posting</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
}else{
    header("location:../../login.php");
}
?>