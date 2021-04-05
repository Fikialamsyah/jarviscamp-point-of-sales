                <?php 
                    $kode_penjualan = $_GET["kode_penjualan"];
                ?>
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Laporan Detail Penjualan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Laporan Detail Penjualan</li>
                        </ol>
                        <div class="card mb-4 shadow rounded">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered text-center">
                                      <thead class="thead-light">  
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Produk</th>
                                            <th>Jumlah</th>
                                            <th>Diskon</th>
                                            <th>Potongan</th>
                                            <th>Total</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                            <?php 
                                                $no = 1;
                                                $sql = $myPDO->prepare("SELECT kode_produk, jumlah, diskon, potongan, total FROM penjualan WHERE kode_penjualan = '$kode_penjualan' ");
                                                $sql->execute();
                                                while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {

                                                // foreach ($conn->query($sql) as $row) {
                                            ?>
                                            
                                            <tr>
                                                <td><?= $no++;?></td>
                                                <td><?= $row['kode_produk']?></td>
                                                <td><?= $row['jumlah']?></td>
                                                <td><?= $row['diskon']?></td>
                                                <td><?= $row['potongan']?></td>
                                                <td><?= $row['total']?></td>
                                            </tr>

                                            <?php 
                                                }
                                            ?>

                                        </tbody>
                                    </table>
                                    <form action="page/laporan_penjualan/coba.php" method="POST" target="_blank">
                                        <input type="text" name="kode_penjualan" value="<?= $kode_penjualan ?>" readonly style="visibility: hidden;"><br>
                                        <button type="submit" class="btn btn-success">Cetak</button>
                                    </form>
                                </div>  
                            </div>
                        </div>
                    </div>
                </main>