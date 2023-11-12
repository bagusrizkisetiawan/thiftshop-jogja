<?php
if (!empty($id_user_login)) {
?>

<div class="row">
    <div class="col-lg-12 mb-4 order-0">
        <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-sm-7">
            <div class="card-body">
                <h5 class="card-title text-primary">Hai, <?php echo $data_user_login['nama_user'] ?> 🎉</h5>
                <p class="mb-4">
                Selamat datang di halaman dashboard pengguna <br>Silahkan posting produk anda
                </p>

                <a href="" class="btn btn-sm btn-primary">Posting Produk</a>
            </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
                <img
                src="assets/img/illustrations/man-with-laptop-light.png"
                height="140"
                alt="View Badge User"
                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                data-app-light-img="illustrations/man-with-laptop-light.png"
                />
            </div>
            </div>
        </div>
        </div>
    </div>
</div>

<?php
}else{
    header("location:../../login.php");
}
?>