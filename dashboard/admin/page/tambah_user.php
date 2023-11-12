<?php
if(@$_SESSION['login_admin']=='login'){

    if (isset($_POST['simpan'])) {
        $nama=mysqli_real_escape_string($koneksi, "$_POST[nama]");
        $email=mysqli_real_escape_string($koneksi, "$_POST[email]");
        $password=mysqli_real_escape_string($koneksi, "$_POST[password]");
        $ulangi_password=mysqli_real_escape_string($koneksi, "$_POST[ulangi_password]");
        $level=mysqli_real_escape_string($koneksi, "$_POST[level]");
    
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
    
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            $alert="<div class='alert alert-warning'>Password setidaknya harus 8 karakter dan harus memiliki huruf besar, huruf kecil, angka, dan spesial karakter.</div>";
        }else{
            if ($password==$ulangi_password) {
                $md5_password=md5($password);
                $q=mysqli_query($koneksi, "SELECT * FROM user where email='$email'");
                $cek_email=mysqli_num_rows($q);
                if (empty($cek_email)) {
                    $simpan=mysqli_query($koneksi, "INSERT INTO user (nama_user, email, password, level) VALUES ('$nama','$email','$md5_password','$level')");
                    if ($simpan) {
                        $alert="<div class='alert alert-success'>Anda berhasil menambah user</div>";
                        echo "<meta http-equiv='refresh' content='2; url=?page=tambah_user'>";
                    }else{
                        $alert="<div class='alert alert-warning'>Anda gagal menambah user</div>";
                    }
                }else{
                    $alert="<div class='alert alert-warning'>Email sudah terdaftar</div>";
                }
            }else{
                $alert="<div class='alert alert-warning'>Ulangi password dengan benar</div>";
            }
        }
        
    }
    
?>

    
<div class="card">
    <div class="card-header">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <h5 class="mb-0 text-primary">Form tambah User</h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-7 mb-2">
                <?php echo @$alert ?>
                <form action="" method="post">
                    <label class="text-secondary mt-2" for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control p-2 mt-2 mb-3" value="<?php echo @$_POST['nama'] ?>" required autofocus>
                    <label class="text-secondary" for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control p-2 mt-2 mb-3" value="<?php echo @$_POST['email'] ?>" required >
                    
                    <div class="row mb-3">
                        <div class="col">
                            <label class="text-secondary" for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control p-2 mt-2 mb-1" required>
                        </div>
                        <div class="col">
                        <label class="text-secondary" for="ulangi_password">ulangi password</label>
                            <input type="password" name="ulangi_password" id="ulangi_password" class="form-control p-2 mt-2 mb-1" required>
                        </div>
                    </div>
                    <label class="text-secondary" for="level">Level</label>
                    <select name="level" id="level" class="form-control p-2 mt-2 mb-3">
                        <option value="" selected disabled>Pilih Level</option>
                        <option value="pengguna">Pengguna</option>
                        <option value="admin">Admin</option>
                    </select>                                
                    <button name="simpan" class="btn btn-primary w-100 mt-4">Simpan</button>
                </form>
            </div>
            
        </div>
    </div>
</div>


<?php
}else{
    header('location:../login.php');
}
