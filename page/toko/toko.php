                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Toko</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Data Toko</li>
                        </ol>
                        <div class="card mb-4 shadow rounded">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <a href="?page=toko&aksi=tambah" class="btn btn-secondary mb-2">Tambah Data</a>
                                    <!-- <table class="table table-striped"> -->
                                    <table id="dtHorizontalExample" class="table table-striped table-bordered table-sm text-center" cellspacing="0" width="100%">
                                      <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Toko</th>
                                            <th>Alamat</th>
                                            <th>Telepon</th>
                                            <th>Kategory</th>
                                            <th>Aksi</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                            <?php 
                                                $no = 1;
                                                $sql = $myPDO->prepare("SELECT toko.nama, toko.alamat, toko.telepon, informasi_toko.nama as category_toko FROM toko JOIN informasi_toko ON toko.informasi_toko_id = informasi_toko.id");
                                                $sql->execute();
                                                while($row = $sql->fetch(PDO::FETCH_ASSOC)){

                                                // foreach ($conn->query($sql) as $row) {
                                            ?>
                                            
                                            <tr>
                                                <td><?= $no++;?></td>
                                                <td><?= $row['nama']?></td>
                                                <td><?= $row['alamat']; ?></td>
                                                <td><?= $row['telepon']; ?></td>
                                                <td><?= $row['category_toko']; ?></td>
                                                <td>
                                                    <a href="?page=toko&aksi=edit&id=<?= $row['id']; ?>" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                                    <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" href="?page=toko&aksi=delete&id=<?= $row['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>

                                            <?php 
                                                }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>      
                            </div>
                        </div>
                    </div>
                </main>