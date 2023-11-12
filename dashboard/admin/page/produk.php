<?php
if (!empty($id_user_login)) {


    $id_produk=@$_GET['id_produk'];
    if ($proses=='setujui') {
        $setujui=mysqli_query($koneksi, "UPDATE produk SET tinjauan='disetujui' WHERE id_produk='$id_produk'");
        if ($setujui) {
            echo "<meta http-equiv='refresh' content='0; url=?page=produk'>";
        }
    }
    if ($proses=='hapus') {
        $foto_produk=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id_produk'"));
        unlink("../../asset/img/$foto_produk[foto_produk]");
        $hapu=mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk='$id_produk'");
        if ($hapu) {
            echo "<meta http-equiv='refresh' content='0; url=?page=produk'>";
        }
    }

?>


<div class="btn-group">
    <button class="btn btn-primary active" data-bs-toggle="modal" data-bs-target="#pilih_kategori"><i class="fa-solid fa-list"></i></button>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pilih_kategori">Pilih Kategori</button>
</div>
<div class="modal fade" id="pilih_kategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Status</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6 col-lg-3">
                        <div class="card mb-3 card-kategori">
                            <a href="?page=produk&&status=terjual" class="card-body p-3 text-center text-decoration-none">
                                Terjual
                            </a>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="card mb-3 card-kategori">
                            <a href="?page=produk&&status=belum terjual" class="card-body p-3 text-center text-decoration-none">
                                Belum Terjual
                            </a>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="card mb-3 card-kategori">
                            <a href="?page=produk&&tinjauan=disetujui" class="card-body p-3 text-center text-decoration-none">
                                Disetujui
                            </a>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="card mb-3 card-kategori">
                            <a href="?page=produk&&tinjauan=belum disetujui" class="card-body p-3 text-center text-decoration-none">
                                Belum Disetujui
                            </a>
                        </div>
                    </div>
                </div>
                <h5 class="modal-title fs-5 mt-3">Pilih Kategori</h5>
                <div class="row mt-3">
                    <div class="col-lg-3 col-6">
                        <div class="card mb-3 card-kategori">
                            <a href="?page=produk" class="card-body p-3 text-center text-decoration-none">
                                Semua Kategori
                            </a>
                        </div>
                    </div>
                    <?php 
                        $q_kategori=mysqli_query($koneksi, "SELECT * FROM kategori");
                        while ($data_kategori=mysqli_fetch_array($q_kategori)) {
                    ?>
                    <div class="col-lg-3 col-6">
                        <div class="card mb-3 card-kategori">
                            <a href="?page=produk&&id_kategori=<?php echo$data_kategori['id_kategori'] ?>" class="card-body p-3 text-center text-decoration-none">
                                <?php echo $data_kategori['nama_kategori'] ?>
                            </a>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card my-3 shadow">
    
    <div class="card-body">
        
        <div class="table-responsive-lg ">
            <table class="table table-hover my-2" id="datatable">
                <thead>
                    <th colspan="2">Produk</th>
                    <th>Harga</th>
                    <th>Tinjauan</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                <?php
          
                $id_kategori=@$_GET['id_kategori'];
                $status=@$_GET['status'];
                $tinjauan=@$_GET['tinjauan'];
                if(!empty($id_kategori)){
                    $q=mysqli_query($koneksi, "SELECT * FROM produk WHERE id_kategori='$id_kategori' order by id_produk DESC");
                }elseif(!empty($status)){
                    $q=mysqli_query($koneksi, "SELECT * FROM produk WHERE status='$status' order by id_produk DESC");
                }elseif(!empty($tinjauan)){
                    $q=mysqli_query($koneksi, "SELECT * FROM produk WHERE tinjauan='$tinjauan' order by id_produk DESC");
                }else{
                    $q=mysqli_query($koneksi, "SELECT * FROM produk order by id_produk DESC");
                }
                
                
                while($data=mysqli_fetch_array($q)){
                ?>
                    <tr>
                        <td width="80px">
                            <div class="img-keranjang">
                                <img src="../../asset/img/<?php echo $data['foto_produk'] ?>" class="w-100" alt="">
                            </div>
                        </td>
                        <td class="text-start">
                            <h6 class="mb-1">
                                <?php echo substr($data['nama_produk'], 0, 25)."..."   ?>
                            </h6>
                            <p class="text-secondary small mb-1" style="font-size: 11px;">
                                <?php 
                                    $kemarin= date('d-M-Y', strtotime('-1 days', strtotime($data['tanggal'])));
                                    if($data['tanggal']==date('d-M-Y')){
                                        echo "Hari ini";
                                    }
                                    elseif($data['tanggal']==$kemarin){
                                        echo"Kemarin";
                                    }else{
                                        echo $data['tanggal'];
                                    }
                                ?>
                            </p>
                            <p class="small text-secondary" style="font-size: 11px;"><i class="fa-solid fa-eye"></i> <?php echo $data['dilihat'] ?> &nbsp; &nbsp; <i class="fa-solid fa-comment"></i> <?php echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM komentar where id_produk='$data[id_produk]'")) ?></p>

                        </td>
                        <td>
                            <p class="card-text text-wight-bold mb-0">Rp <?php echo number_format("$data[harga_produk]", 2, ",", "."); ?></p>
                        </td>
                        <td>
                            <?php
                            if ($data['tinjauan']=='belum disetujui') {
                                echo"<div class='text-danger'>Belum Disetujui</div>";
                            }else{
                                echo"<div class='text-success'>Disetujui</div>";
                            }
                            ?>
                        </td>
                        
                        </td>
                        <td >
                            <!-- info -->
                            <a href="?page=deskripsi&&id_produk=<?php echo$data['id_produk'] ?>" class="btn btn-sm mb-1 btn-aksi btn-info"><i class="fa-solid fa-info"></i></a>
                            <!-- terjual -->
                            <a href="" class="btn btn-sm mb-1 btn-aksi <?php if($data['tinjauan']=='disetujui'){echo'disabled btn-secondary';}else{echo'btn-success';} ?> " data-bs-toggle="modal" data-bs-target="#setujui<?php echo$data['id_produk'] ?>"><i class="fa-solid fa-check"></i></a>
                            <div class="modal fade" id="setujui<?php echo$data['id_produk'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class=" mb-3 mb-0">Apakah anda menyetujui produk ini ?</h6>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="img-modal">
                                                            <img src="../../asset/img/<?php echo$data['foto_produk'] ?>" alt="" class="img-produk-deskripsi">
                                                        </div>
                                                    </div>
                                                    <div class="col-8 py-3">
                                                        <h6><?php echo$data['nama_produk'] ?></h6>
                                                        <p  class="small">Rp <?php echo number_format("$data[harga_produk]", 2, ",", "."); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a href="?page=produk&&proses=setujui&&id_produk=<?php echo$data['id_produk'] ?>" class="btn btn-success">Setujui</a>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <!-- hapus -->
                            <a href="" class="btn btn-sm mb-1 btn-aksi btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo$data['id_produk'] ?>"><i class="fa-solid fa-trash"></i></a>
                            <div class="modal fade" id="hapus<?php echo$data['id_produk'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    
                                    <div class="modal-body">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class=" mb-3 mb-0 text-danger">Apakah anda ingin menghapus produk ini?</h6>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="img-modal">
                                                            <img src="../../asset/img/<?php echo$data['foto_produk'] ?>" alt="" class="img-produk-deskripsi">
                                                        </div>
                                                    </div>
                                                    <div class="col-8 py-3">
                                                        <h6><?php echo$data['nama_produk'] ?></h6>
                                                        <p  class="small">Rp <?php echo number_format("$data[harga_produk]", 2, ",", "."); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a href="?page=produk&&proses=hapus&&id_produk=<?php echo$data['id_produk'] ?>" class="btn btn-danger">Hapus</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
}else{
    header("location:../../../login.php");
}
?>