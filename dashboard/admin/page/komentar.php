<?php
if(@$_SESSION['login_admin']=='login'){

    if ($proses=='hapus') {
        $id_komentar=$_GET['id_komentar'];
        $hapus=mysqli_query($koneksi, "DELETE FROM komentar WHERE id_komentar='$id_komentar'");
        if ($hapus) {
            echo "<meta http-equiv='refresh' content='0; url=?page=komentar'>";
        }
    }
?>

    
<div class="card">
    <div class="card-body">
        <!-- table -->
        <div class="table-responsive mt-2">
            <table class="table table-hovers" id="datatable">
                <thead>
                    <tr>
                        <th>Nama User</th>
                        <th>Tanggal</th>
                        <th>Komentar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    
                    $q_komentar=mysqli_query($koneksi, "SELECT * FROM komentar a LEFT JOIN user b ON a.id_user=b.id_user order by a.id_komentar DESC");
                    
                    while ($data=mysqli_fetch_array($q_komentar)) {
                    ?>
                    <tr valign="top">
                        <td><p class="mb-0"><?php echo $data['nama_user'] ?></p><p class="mb-0 text-secondary" style="font-size: 11px;"><?php echo $data['email'] ?></p></td>
                        <td>
                        <?php 
                            $kemarin= date('d-M-Y', strtotime('-1 days', strtotime($data['tanggal_komentar'])));
                            if($data['tanggal_komentar']==date('d-M-Y')){
                                echo "Hari ini";
                            }
                            elseif($data['tanggal_komentar']==$kemarin){
                                echo"Kemarin";
                            }else{
                                echo $data['tanggal_komentar'];
                            }
                        ?>
                        </td>
                        <td>
                            <?php echo nl2br( $data['komentar'] ) ?>
                        </td>
                        <td>
                            <!-- Hapus -->
                            <button class="btn btn-sm btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#hapus<?php echo$data['id_user'] ?>">Hapus</button>
                            <div class="modal fade" id="hapus<?php echo$data['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus komentar <br>
                                        <b>"<?php echo nl2br($data['komentar']) ?>"</b>
                                    </div>
    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a href="?page=komentar&&proses=hapus&&id_komentar=<?php echo $data['id_komentar'] ?>" class="btn btn-danger" >Hapus</a>
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
