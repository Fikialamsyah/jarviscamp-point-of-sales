                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Toko</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Data Toko</li>
                        </ol>
                        <div class="card-body">
                                <a href="?page=toko&aksi=tambah" class="btn btn-secondary mb-2">Tambah Data</a>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
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
                </main>