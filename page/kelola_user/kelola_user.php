
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data User</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Data User</li>
                        </ol>
                        <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>Created_at</th>
                                                <th>Updated_at</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $no = 1;
                                                $table = '"user"';
                                                $sql = $myPDO->prepare("SELECT * FROM $table");
                                                $sql->execute();
                                                while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {

                                                // foreach ($conn->query($sql) as $row) {
                                            ?>
                                            
                                            <tr>
                                                <td><?= $no++;?></td>
                                                <td><?= $row['username']?></td>
                                                <td><?= $row['email']?></td>
                                                <td><?= $row['password']?></td>
                                                <td><?= $row['created_at']?></td>
                                                <td><?= $row['updated_at']?></td>
                                                <td>
                                                     <a href="?page=kelola_user&aksi=edit&id=<?= $row['id']; ?>" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                                    <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" href="?page=kelola_user&aksi=delete&id=<?= $row['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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