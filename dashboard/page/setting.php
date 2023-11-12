<?php
if (!empty($id_user_login)) {

    if (isset($_POST['simpan'])) {
        $no_hp=mysqli_real_escape_string($koneksi, "$_POST[no_hp]");
        $alamat=mysqli_real_escape_string($koneksi, "$_POST[alamat]");
        $nama=mysqli_real_escape_string($koneksi, "$_POST[nama]");

        $foto=$_FILES['foto']['name'];
        $tmp_name=$_FILES['foto']['tmp_name'];
        $size=$_FILES['foto']['size'];
        $location="../asset/img/user/";

        $cek_no_hp_user=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM user WHERE no_hp='$no_hp' && id_user='$id_user_login'"));
        
        if (!empty($cek_no_hp_user)) {
            $data_foto=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user_login'"));
            unlink("../asset/img/user/$data_foto[foto]");
            if ($size<=5000000) {
                move_uploaded_file($tmp_name, $location.$foto); 
                $update=mysqli_query($koneksi, "UPDATE user SET nama_user='$nama', foto='$foto', no_hp='$no_hp', alamat='$alamat' WHERE id_user='$id_user_login'");
                if ($update) {
                    echo "<meta http-equiv='refresh' content='2; url=?page=setting'>";
                }else{
                    $alert="<div class='alert alert-danger'>Anda gagal melengkapi data</div>";   
                }
            }else{
                $alert="<div class='alert alert-danger'>Maksimal foto 10 mb</div>";
            }
        }
        else{
            $cek_no_hp=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM user WHERE no_hp='$no_hp'"));
            if (empty($cek_no_hp)) {
                # code...
            }else{
                $alert="<div class='alert alert-danger'>Nomor Wa Sudah Terdaftar</div>";
            }
        }
    }

$data=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user_login'"));
?>

<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

<div class="row">
    <div class="col-md-12">
        
        <div class="card mb-4">
            <h5 class="card-header">Profile Details</h5>
            <!-- Account -->
            <form method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <?php echo @$alert; ?>
                    <div class="d-flex img-card align-items-start align-items-sm-center gap-4">
                        <img
                            src="<?php if(!empty($data['foto'])){echo "../asset/img/user/".$data['foto'];}else{?>https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__480.png <?php }?>"
                            alt="user-avatar"
                            class="d-block rounded img-produk-deskripsi"
                            id="uploadedAvatar"
                        />
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input
                                class="form-control mt-3"
                                type="file"
                                name="foto"
                                class="account-file-input"
                                accept="image/png, image/jpeg"
                            />
                        </div>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Nama</label>
                            <input
                                class="form-control"
                                type="text"
                                id="firstName"
                                name="nama"
                                value="<?php echo $data['nama_user'] ?>"
                                autofocus
                            />
                            
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" disabled type="email" name="email" id="email" value="<?php echo $data['email'] ?>" />
                            
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="no_hp" class="form-label">No WA (WhatsApp)</label>
                            <input
                            class="form-control"
                            type="number"
                            id="no_hp"
                            name="no_hp"
                            value="0<?php echo $data['no_hp'] ?>"
                            />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input
                                type="text"
                                class="form-control"
                                id="alamat"
                                name="alamat"
                                value="<?php echo $data['alamat'] ?>"
                            />  
                        </div>
                        
                    </div>
                    <div class="mt-2">
                        <button type="submit" name="simpan" class="btn btn-primary me-2">Save changes</button>
                    </div>
                </div>
            </form>
        <!-- /Account -->
        </div>
    </div>
</div>

<?php
}else{
    header("location:../../login.php");
}
?>