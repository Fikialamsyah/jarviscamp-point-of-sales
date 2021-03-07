                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Vendor</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Data Vendor</li>
                        </ol>
                        <div class="card-body">
                                <a href="?page=vendor&aksi=tambah" class="btn btn-secondary mb-2">Tambah Data</a>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
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
                                                $sql = "SELECT * FROM vendor";

                                                foreach ($conn->query($sql) as $row) {
                                            ?>
                                            
                                            <tr>
                                                <td><?= $no++;?></td>
                                                <td><?= $row['nama_vendor']?></td>
                                                <td><?= $row['email']; ?></td>
                                                <td><?= $row['telpon']; ?></td>
                                                <td><?= $row['alamat']; ?></td>
                                                <td>
                                                    <a href="?page=vendor&aksi=edit&id=<?= $row['id']; ?>" class="btn btn-success">Edit</a>
                                                    <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" href="?page=vendor&aksi=delete&id=<?= $row['id']; ?>" class="btn btn-danger">Delete</a>
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