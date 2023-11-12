<?php
if(@$_SESSION['login_admin']=='login'){

    $id_kategori=@$_GET['id_kategori'];
    if ($proses=='hapus') {
        $hapus=mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori='$id_kategori'");
        if($hapus){
            echo "<meta http-equiv='refresh' content='0; url=?page=kategori'>";
        }
    }

    if (isset($_POST['simpan'])) {
        $nama_kategori=mysqli_real_escape_string($koneksi, "$_POST[nama_kategori]");
        $cek=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kategori WHERE nama_kategori='$nama_kategori'"));
        if (empty($cek)) {
            $simpan=mysqli_query($koneksi, "INSERT INTO kategori VALUES ('','$nama_kategori')");
            if ($simpan) {
                echo "<meta http-equiv='refresh' content='2; url=?page=kategori'>";
                $alert="<div class='alert alert-success'>Anda berhasil menambah kategori</div>";
            }
            else{
                $alert="<div class='alert alert-danger'>Anda gagal menambah kategori</div>";
            }
        }else{
            $alert="<div class='alert alert-danger'>Nama kategori sudah ada</div>";
        }
    }
?>

    
            
<div class="card">
    <div class="card-body">
        <h5 class="mb-4 text-primary">Form tambah kategori</h5>
        <?php echo @$alert ?>
        <form action="" method="post" style="margin-top:31px ;">
            <input type="text" name="nama_kategori" class="form-control mt-3  mb-3" placeholder="Masukan kategori" value="<?php echo @$nama_kategori ?>" >
            <button name="simpan" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>


<div class="card my-3">
    <div class="card-body">
        
        <div class="table-responsive mt-3">
            <table class="table table-hover" id="datatable">
                <thead>
                    <tr>
                        <th>Nama Kategori</th>
                        <th class="">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (isset($_POST['cari'])) {
                        $pecarian=mysqli_real_escape_string($koneksi, "$_POST[pencarian]");
                        $q_kategori=mysqli_query($koneksi, "SELECT * FROM kategori WHERE nama_kategori LIKE '%$pecarian%'");
                    }else{
                        $q_kategori=mysqli_query($koneksi, "SELECT * FROM kategori");
                    }
                    while ($data=mysqli_fetch_array($q_kategori)) {
                    ?>
                    <tr>
                        <td><?php echo $data['nama_kategori'] ?></td>
                        <td class="">
                            <a href="?page=edit_kategori&&id_kategori=<?php echo$data['id_kategori'] ?>" class="btn btn-sm btn-warning text-white">Edit</a>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo$data['id_kategori'] ?>">Hapus</button>
                            <div class="modal fade" id="hapus<?php echo$data['id_kategori'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header ">
                                        
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger">Apakah anda yakin ingin menghapus kategori <b>" <?php echo$data['nama_kategori'] ?> "</b></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a href="?page=kategori&&proses=hapus&&id_kategori=<?php echo$data['id_kategori'] ?>" class="btn btn-danger">Hapus</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
               
        
<?php
}else{
    header('location:../../../login.php');
}
