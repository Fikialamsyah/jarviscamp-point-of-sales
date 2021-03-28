
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Data User</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="?page=kelola_user">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Data Barang</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="?page=barang">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Data Vendor</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="?page=vendor">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Data Toko</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="?page=toko">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode</th>
                                                <th>Gambar</th>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Kategori</th>
                                                <th>Stok</th>
                                                <th>Harga Beli</th>
                                                <th>Harga Jual</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode</th>
                                                <th>Gambar</th>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Kategori</th>
                                                <th>Stok</th>
                                                <th>Harga Beli</th>
                                                <th>Harga Jual</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                                <?php 
                                                    $no = 1;
                                                    // $sql = "SELECT * FROM produk";
                                                    $sql = $myPDO->prepare("SELECT * FROM produk");
                                                    $sql->execute();

                                                    // foreach ($conn->query($sql) as $row) {
                                                    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                            <tr>
                                                <td><?= $no++;?></td>
                                                <td><?= $row['kode_produk']?></td>
                                                <td>
                                                    <img src="assets/produk/<?= $row['gambar_produk'] ?>" alt="" width="30px">
                                                </td>
                                                <td><?= $row['nama']; ?></td>
                                                <td><?= $row['deskripsi']; ?></td>
                                                <td><?= $row['produk_kategori_id']; ?></td>
                                                <td><?= $row['stok']; ?></td>
                                                <td><?= $row['harga_beli']; ?></td>
                                                <td><?= $row['harga_jual']; ?></td>
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