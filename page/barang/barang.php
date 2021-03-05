                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Kategori Toko</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Kategori Toko</li>
                        </ol>
                        <div class="card-body">
                                <a href="?page=barang&aksi=tambah" class="btn btn-secondary mb-2">Tambah Data</a>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Produk</th>
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
                                                $sql = "SELECT * FROM produk";

                                                foreach ($conn->query($sql) as $row) {
                                            ?>
                                            
                                            <tr>
                                                <td><?= $no++;?></td>
                                                <td><?= $row['kode_produk']?></td>
                                                <td><?= $row['nama']; ?></td>
                                                <td><?= $row['deskripsi']; ?></td>
                                                <td><?= $row['produk_kategori_id']; ?></td>
                                                <td><?= $row['stok']; ?></td>
                                                <td><?= $row['harga_beli']; ?></td>
                                                <td><?= $row['harga_jual']; ?></td>
                                                <td>
                                                    <a href="?page=barang&aksi=edit&id=<?= $row['id']; ?>" class="btn btn-success">Edit</a>
                                                    <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" href="?page=barang&aksi=hapus&id=<?= $row['id']; ?>" class="btn btn-danger">Delete</a>
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