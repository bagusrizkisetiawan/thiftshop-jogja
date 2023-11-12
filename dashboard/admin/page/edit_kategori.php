<?php
if(@$_SESSION['login_admin']=='login'){
    $id_kategori=$_GET['id_kategori'];
    if (isset($_POST['simpan'])) {
        $nama_kategori=mysqli_real_escape_string($koneksi, "$_POST[nama_kategori]");
        $cek=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kategori WHERE nama_kategori='$nama_kategori' and id_kategori!='$id_kategori'"));
        if (empty($cek)) {
            $simpan=mysqli_query($koneksi, "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id_kategori='$id_kategori'");
            if ($simpan) {
                echo "<meta http-equiv='refresh' content='2; url=?page=kategori'>";
                $alert="<div class='alert alert-success'>Anda mengubah kategori</div>";
            }
            else{
                $alert="<div class='alert alert-danger'>Anda gagal mengubah kategori</div>";
            }
        }else{
            $alert="<div class='alert alert-danger'>Nama kategori sudah ada</div>";
        }
    }

    $kategori=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori='$id_kategori'"));
?>

    
<div class="card">
    <div class="card-body">  
        
        <h5 class="mb-4">Form edit kategori</h5>
        <?php echo @$alert ?>
        <form action="" method="post">
            <label for="">Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control mt-2 p-2 mb-3" value="<?php echo $kategori['nama_kategori'] ?>"  autofocus>
            <button name="simpan" class="btn btn-primary">Simpan</button>
        </form>

    </div>
</div>
        

<?php
}else{
    header('location:../../../login.php');
}
