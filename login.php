<?php
include 'koneksi.php';

if (isset($_POST['login'])) {
    $email=mysqli_real_escape_string($koneksi, "$_POST[email]");
    $password=mysqli_real_escape_string($koneksi, "$_POST[password]");

    $md5_password=md5($password);

    $q=mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email' and password='$md5_password'");
    $cek_akun=mysqli_num_rows($q);
    if (!empty($cek_akun)) {
        $data=mysqli_fetch_array($q);
        if ($data['level']=='admin') {
            $_SESSION['id_user_admin']=$data['id_user'];
            $_SESSION['login_admin']='login';
            echo "<meta http-equiv='refresh' content='2; url=dashboard/admin'>";
        }else{
            $_SESSION['id_user']=$data['id_user'];
            $_SESSION['login']='login';
            echo "<meta http-equiv='refresh' content='2; url=index.php'>";
        } 
        $alert="<div class='alert alert-success'>Anda berhasil login</div>";
        
    }else{
        $alert="<div class='alert alert-danger'>Email dan password tidak valid</div>";
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

    <title>Login ThriftShop-Jogja</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="" />

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
          <!-- Register -->
          <div class="card card-kategori" >
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="p-2 mb-3">
                  <span class="app-brand-text demo text-body fw-bolder">ThriftShop-Jogja</span>
                </a>
              </div>
              
              <form id="formAuthentication" class="" action="" method="POST">
                <div class="mb-3">
                  <?php echo @$alert; ?>
                  <label for="email" class=" form-label">Email </label>
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Masukan email"
                    autofocus
                    required
                    value="<?php echo @$email; ?>"
                  />
                </div>
                <div class="mb-4 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href="auth-forgot-password-basic.html">
                      <small>Forgot Password?</small>
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                      required
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                
                <div class="mb-3">
                  <button name="login" class="btn btn-primary d-grid w-100" type="submit">Login</button>
                </div>
              </form>

              <p class="text-center">
                <span>Belum mendaftar ?</span>
                <a href="registrasi.php">
                  <span>Daftar Sekarang!</span>
                </a>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>


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
