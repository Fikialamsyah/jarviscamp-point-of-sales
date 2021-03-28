
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Laporan Penjualan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Laporan Penjualan</li>
                        </ol>
                        <div class="card mb-4 shadow rounded">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                      <thead class="thead-light">  
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Penjualan</th>
                                            <th>Tanggal Penjualan</th>
                                            <th>Aksi</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                            <?php 
                                                $no = 1;
                                                $sql = $myPDO->prepare("SELECT kode_penjualan, tgl_penjualan FROM penjualan GROUP BY kode_penjualan, tgl_penjualan");
                                                $sql->execute();
                                                while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {

                                                // foreach ($conn->query($sql) as $row) {
                                            ?>
                                            
                                            <tr>
                                                <td><?= $no++;?></td>
                                                <td><?= $row['kode_penjualan']?></td>
                                                <td><?= $row['tgl_penjualan']?></td>
                                                <td>
                                                    <a href="?page=laporan_penjualan&aksi=view&kode_penjualan=<?= $row['kode_penjualan']; ?>" class="btn btn-success"><i class="fas fa-eye"></i></a>
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