                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Vendor</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Data Barang</li>
                        </ol>
                        <div class="card mb-4 shadow rounded">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <a href="?page=barang&aksi=tambah" class="btn btn-secondary mb-2">Tambah Data</a>
                                    <!-- <table class="table table-striped table-bordered text-center "> -->
                                    <table id="dtHorizontalExample" class="table table-striped table-bordered table-sm text-center" cellspacing="0" width="100%">
                                      <thead class="thead-light">
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
                                            <th>Aksi</th>
                                        </tr>
                                      </thead>
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
                                                <td width="5%"><?= $row['kode_produk']?></td>
                                                <td>
                                                    <img src="assets/produk/<?= $row['gambar_produk'] ?>" alt="" width="30px">
                                                </td>
                                                <td width="15%"><?= $row['nama']; ?></td>
                                                <td><?= $row['deskripsi']; ?></td>
                                                <td><?= $row['produk_kategori_id']; ?></td>
                                                <td><?= $row['stok']; ?></td>
                                                <td><?= $row['harga_beli']; ?></td>
                                                <td><?= $row['harga_jual']; ?></td>
                                                <td>
                                                    <a href="?page=barang&aksi=edit&id=<?= $row['id']; ?>" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                                    <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" href="?page=barang&aksi=delete&id=<?= $row['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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