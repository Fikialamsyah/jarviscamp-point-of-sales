
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data User</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Data User</li>
                        </ol>
                        <div class="card mb-4 shadow rounded">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <!-- <table class="table table-striped text-center"> -->
                                    <table id="dtHorizontalExample" class="table table-striped table-bordered table-sm text-center" cellspacing="0" width="100%">
                                      <thead class="thead-light">  
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
                                                <td>
                                                    <input type="Password" name="" value="<?= $row['password']?>" class="form-control" readonly style="border: 0;">
                                                </td>
                                                <td><?= $row['created_at']?></td>
                                                <td><?= $row['updated_at']?></td>
                                                <td>
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
                    </div>
                </main>