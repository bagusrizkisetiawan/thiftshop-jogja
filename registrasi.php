<?php
include'koneksi.php';

if (isset($_POST['registrasi'])) {
    $nama=mysqli_real_escape_string($koneksi, "$_POST[nama]");
    $email=mysqli_real_escape_string($koneksi, "$_POST[email]");
    $password=mysqli_real_escape_string($koneksi, "$_POST[password]");
    $ulangi_password=mysqli_real_escape_string($koneksi, "$_POST[ulangi_password]");

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
                $simpan=mysqli_query($koneksi, "INSERT INTO user (nama_user, email, password, level) VALUES ('$nama','$email','$md5_password','pengguna')");
                if ($simpan) {
                    $alert="<div class='alert alert-success'>Anda berhasil Merdaftar</div>";
                    echo "<meta http-equiv='refresh' content='2; url=login.php'>";
                }else{
                    $alert="<div class='alert alert-warning'>Anda gagal registrasi</div>";
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
<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="dashboard/assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Registrasi</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="dashboard/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="dashboard/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="dashboard/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="dashboard/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="dashboard/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="dashboard/assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="dashboard/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="dashboard/assets/js/config.js"></script>
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register Card -->
          <div class="card card-kategori">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="p-2 mb-3">
                  <span class="app-brand-text demo text-body fw-bolder">ThriftShop-Jogja</span>
                </a>
              </div>
              <!-- /Logo -->
              
                <?php echo @$alert ?>
              <form id="formAuthentication" class="mb-3" action="" method="POST">
                <div class="mb-3">
                  <label for="username" class="form-label">Nama</label>
                  <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="nama"
                    placeholder="Masukan nama"
                    autofocus
                    value="<?php echo@$nama ?>"
                  />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" id="email" name="email" placeholder="Masukan email" value="<?php echo@$email ?>" />
                </div>
                <div class="mb-3 form-password-toggle">
                    <div class="row">
                        <div class="col">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                              <input
                                type="password"
                                id="password"
                                class="form-control"
                                name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password"
                              />
                              <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label" for="ulangi_password">Ulangi Password</label>
                            <div class="input-group input-group-merge">
                              <input
                                type="password"
                                id="ulangi_password"
                                class="form-control"
                                name="ulangi_password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password"
                              />
                              <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                
                <button name="registrasi" class="btn btn-primary d-grid w-100">Registrasi</button>
              </form>

              <p class="text-center">
                <span>Sudah terdaftar?</span>
                <a href="login.php">
                  <span>Login sekarang</span>
                </a>
              </p>
            </div>
          </div>
          <!-- Register Card -->
        </div>
      </div>
    </div>

    <!-- / Content -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="dashboard/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="dashboard/assets/vendor/libs/popper/popper.js"></script>
    <script src="dashboard/assets/vendor/js/bootstrap.js"></script>
    <script src="dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="dashboard/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="dashboard/assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
