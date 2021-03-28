                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Vendor</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Data Vendor</li>
                        </ol>
                        <div class="card mb-4 shadow rounded">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <a href="?page=vendor&aksi=tambah" class="btn btn-secondary mb-2">Tambah Data</a>
                                    <!-- <table class="table table-striped"> -->
                                    <table id="dtHorizontalExample" class="table table-striped table-bordered table-sm text-center" cellspacing="0" width="100%">
                                      <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No Telpon</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                            <?php 
                                                $no = 1;
                                                $sql = $myPDO->prepare("SELECT * FROM vendor");
                                                $sql->execute();

                                                while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                                                // foreach ($conn->query($sql) as $row) {
                                            ?>
                                            
                                            <tr>
                                                <td><?= $no++;?></td>
                                                <td><?= $row['nama_vendor']?></td>
                                                <td><?= $row['email']; ?></td>
                                                <td><?= $row['telpon']; ?></td>
                                                <td><?= $row['alamat']; ?></td>
                                                <td>
                                                    <a href="?page=vendor&aksi=edit&id=<?= $row['id']; ?>" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                                    <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" href="?page=vendor&aksi=delete&id=<?= $row['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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