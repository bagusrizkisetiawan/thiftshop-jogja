<?php
if(@$_SESSION['login_admin']=='login'){

    if ($proses=='hapus') {
        $id_user=$_GET['id_user'];
        $hapus=mysqli_query($koneksi, "DELETE FROM user WHERE id_user='$id_user'");
        if ($hapus) {
            echo "<meta http-equiv='refresh' content='0; url=?page=user'>";
        }else{
            $alert="<div class='alert alert-danger'>Anda gagal menghapus user</div>";
        }
    }

    
?>
<div class="btn-group">
    <a href="?page=tambah_user" class="btn btn-primary text-white active"><i class="fa-solid fa-plus"></i></a>
    <a href="?page=tambah_user" class="btn btn-primary text-white">Tambah User</a>
</div>
   

<div class="card mt-3">
    <div class="card-header bg-light">
        <h6 class="mb-0">Admin</h6>
    </div>
    <div class="card-body py-3">
        <!-- table -->
        <?php echo @$alert ?>
        <div class="table-responsive ">
            <table class="table table-hover my-3" id="datatable">
                <thead>
                    <tr>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Foto</th>
                        
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $q_kategori=mysqli_query($koneksi, "SELECT * FROM user WHERE level='admin' order by nama_user ASC");
                    
                    while ($data=mysqli_fetch_array($q_kategori)) {
                    ?>
                    <tr>
                        <td><?php echo $data['nama_user'] ?></td>
                        <td><?php echo $data['email'] ?></td>
                        <td>
                            <?php 
                                if ($data['foto']!='') {
                                echo "<div class='img-user' style='background-image: url(../../asset/img/user/".$data['foto'].") ;'></div> ";
                                }else{
                                    echo "<div class='img-user' style='background-image: url(https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__480.png) ;'></div> ";
                                }
                                ?>
                        </td>
                        
                        <td>
                            <button class="btn btn-sm btn-info text-white mb-1" data-bs-toggle="modal" data-bs-target="#info<?php echo$data['id_user'] ?>">Info</button>
                            <div class="modal fade" id="info<?php echo$data['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    
                                    <div class="modal-body">
                                        <div class="card">
                                            <div class="card-body">
    
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <?php
                                                        if ($data['foto']!='') {
                                                            echo "<img src='../../asset/img/user/".$data['foto']."' alt='' class='w-100'>";
                                                        }else{
                                                            echo "<img src='https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__480.png' alt='' class='w-100'>";
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <h5><?php echo $data['nama_user'] ?></h5>
                                                        <hr class="">
                                                        <p class="small text-secondary"><i class="fa-solid fa-user"></i> &nbsp; <?php echo $data['email'] ?></p>
                                                        <p class="small text-secondary"><i class="fa-brands fa-whatsapp"> &nbsp; </i> <?php echo $data['no_hp'] ?><br><i class="fa-solid fa-location-pin"></i> &nbsp; <?php echo $data['alamat'] ?></p>
    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Hapus -->
                            <button class="btn btn-sm btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#hapus<?php echo$data['id_user'] ?>">Hapus</button>
                            <div class="modal fade" id="hapus<?php echo$data['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    
                                    <div class="modal-body">
                                    <h5 class="mb-3 text-danger">Apakah anda yakin ingin menghapus user ini?</h5>

                                        <div class="card">
                                            <div class="card-body">
    
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <?php
                                                        if ($data['foto']!='') {
                                                            echo "<img src='../asset/img/".$data['foto']."' alt='' class='w-100'>";
                                                        }else{
                                                            echo "<img src='https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__480.png' alt='' class='w-100'>";
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="col-lg-8">
                                                    <h5><?php echo $data['nama_user'] ?></h5>
                                                        <hr class="">
                                                        <p class="small text-secondary"><i class="fa-solid fa-user"></i> &nbsp; <?php echo $data['email'] ?></p>
                                                        <p class="small text-secondary"><i class="fa-brands fa-whatsapp"> &nbsp; </i> <?php echo $data['no_hp'] ?><br><i class="fa-solid fa-location-pin"></i> &nbsp; <?php echo $data['alamat'] ?></p>
    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a href="?page=user&&proses=hapus&&id_user=<?php echo $data['id_user'] ?>" class="btn btn-danger" >Hapus</a>
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


<div class="card mt-4">
    <div class="card-header bg-light">
        <h6 class="mb-0">Pengguna</h6>
    </div>
    <div class="card-body py-3">
        <!-- table -->
        <?php echo @$alert ?>
        <div class="table-responsive ">
            <table class="table table-hover my-3" id="datatable-2">
                <thead>
                    <tr>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $q_kategori=mysqli_query($koneksi, "SELECT * FROM user WHERE level='pengguna' order by nama_user ASC");
                    
                    while ($data=mysqli_fetch_array($q_kategori)) {
                    ?>
                    <tr>
                        <td><?php echo $data['nama_user'] ?></td>
                        <td><?php echo $data['email'] ?></td>
                        <td>
                            <?php 
                                if ($data['foto']!='') {
                                echo "<div class='img-user' style='background-image: url(../../asset/img/user/".$data['foto'].") ;'></div> ";
                                }else{
                                    echo "<div class='img-user' style='background-image: url(https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__480.png) ;'></div> ";
                                }
                                ?>
                        </td>
                        
                        <td>
                            <button class="btn btn-sm btn-info text-white mb-1" data-bs-toggle="modal" data-bs-target="#info<?php echo$data['id_user'] ?>">Info</button>
                            <div class="modal fade" id="info<?php echo$data['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    
                                    <div class="modal-body">
                                        <div class="card">
                                            <div class="card-body">
    
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <?php
                                                        if ($data['foto']!='') {
                                                            echo "<img src='../../asset/img/user/".$data['foto']."' alt='' class='w-100'>";
                                                        }else{
                                                            echo "<img src='https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__480.png' alt='' class='w-100'>";
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <h5><?php echo $data['nama_user'] ?></h5>
                                                        <hr class="">
                                                        <p class="small text-secondary"><i class="fa-solid fa-user"></i> &nbsp; <?php echo $data['email'] ?></p>
                                                        <p class="small text-secondary"><i class="fa-brands fa-whatsapp"> &nbsp; </i> <?php echo $data['no_hp'] ?><br><i class="fa-solid fa-location-pin"></i> &nbsp; <?php echo $data['alamat'] ?></p>
    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Hapus -->
                            <button class="btn btn-sm btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#hapus<?php echo$data['id_user'] ?>">Hapus</button>
                            <div class="modal fade" id="hapus<?php echo$data['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    
                                    <div class="modal-body">
                                    <h5 class="mb-3 text-danger">Apakah anda yakin ingin menghapus user ini?</h5>

                                        <div class="card">
                                            <div class="card-body">
    
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <?php
                                                        if ($data['foto']!='') {
                                                            echo "<img src='../asset/img/".$data['foto']."' alt='' class='w-100'>";
                                                        }else{
                                                            echo "<img src='https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460__480.png' alt='' class='w-100'>";
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="col-lg-8">
                                                    <h5><?php echo $data['nama_user'] ?></h5>
                                                        <hr class="">
                                                        <p class="small text-secondary"><i class="fa-solid fa-user"></i> &nbsp; <?php echo $data['email'] ?></p>
                                                        <p class="small text-secondary"><i class="fa-brands fa-whatsapp"> &nbsp; </i> <?php echo $data['no_hp'] ?><br><i class="fa-solid fa-location-pin"></i> &nbsp; <?php echo $data['alamat'] ?></p>
    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a href="?page=user&&proses=hapus&&id_user=<?php echo $data['id_user'] ?>" class="btn btn-danger" >Hapus</a>
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
