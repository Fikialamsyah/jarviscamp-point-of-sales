                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Kategori Toko</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Kategori Toko</li>
                        </ol>
                        <div class="card-body">
                                <a href="?page=kategori_toko&aksi=tambah" class="btn btn-secondary mb-2">Tambah Data</a>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $no = 1;
                                                // $sql = "SELECT * FROM produk_kategori";

                                                // foreach ($conn->query($sql) as $row) {
                                                $sql = $myPDO->prepare("SELECT * FROM produk");
                                                $sql->execute();

                                                while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {

                                            ?>
                                            
                                            <tr>
                                                <td><?= $no++;?></td>
                                                <td><?= $row['nama']?></td>
                                                <td>
                                                    <a href="?page=kategori_toko&aksi=edit&id=<?= $row['id']; ?>" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                                    <a onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" href="?page=kategori_toko&aksi=hapus&id=<?= $row['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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