                  <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Kategori Toko</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Kategori Toko</li>
                        </ol>
                          <form method="POST">
                            <div class="form-group">
                              <label for="kode">Kode Produk</label>
                              <input type="text" class="form-control" id="kode" aria-describedby="emailHelp" placeholder="Masukkan kode kategori barang" name="kode">
                            </div>
                            <div class="form-group">
                              <label for="nama">Nama Barang</label>
                              <input type="nama" class="form-control" id="nama" aria-describedby="namaHelp" placeholder="Masukkan nama barang" name="nama">
                            </div>
                            <div class="form-group">
                              <label for="deskripsi">Deskripsi</label>
                              <input type="text" class="form-control" id="deskripsi" aria-describedby="emailHelp" placeholder="Berikan deskripsi barang" name="deskripsi">
                            </div>
                            <div class="form-group">
                            <label for="kategori">Kategori Produk</label>
                            <select class="form-control" id="kategori" name="kategori">
                                <?php 
                                    $sql = "SELECT * FROM produk_kategori";

                                    foreach ($conn->query($sql) as $row) {
                                ?>
                              <option value="<?= $row['nama']?>"><?= $row['nama']?></option>
                                <?php 
                                    }
                                ?>
                            </select>
                          </div>
                            <div class="form-group">
                              <label for="stok">Stok</label>
                              <input type="number" class="form-control" id="stok" aria-describedby="emailHelp" placeholder="Masukkan stok barang" name="stok">
                            </div>
                            <div class="form-group">
                              <label for="hargaBeli">Harga Beli</label>
                              <input type="text" class="form-control" id="hargaBeli" aria-describedby="emailHelp" placeholder="Masukkan harga beli" name="hargaBeli">
                            </div>
                            <div class="form-group">
                              <label for="hargaJual">Harga Jual</label>
                              <input type="text" class="form-control" id="hargaJual" aria-describedby="emailHelp" placeholder="Masukkan harga jual" name="hargaJual">
                            </div>
                            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                          </form>
                      </div>
                  </main>


                  <?php 

                      if (isset($_POST['simpan'])) {
                        $kode = $_POST['kode'];
                        $nama = $_POST['nama'];
                        $deskripsi = $_POST['deskripsi'];
                        $kategori = $_POST['kategori'];
                        $stok = $_POST['stok'];
                        $hargaBeli = $_POST['hargaBeli'];
                        $hargaJual = $_POST['hargaJual'];

                        $tambah = $conn->query("insert into produk (id, nama, harga_jual, deskripsi, stok, produk_kategori_id, kode_produk, harga_beli) values ('', '$nama', '$hargaJual', '$deskripsi', '$stok', '$kategori', '$kode', '$hargaBeli')");

                        $result = mysql_query($tambah) or die (mysql_error());

                        if ($tambah) {
                          ?>

                          <script type="text/javascript">
                            alert("Data Berhasil di Simpan");
                            window.location.href="?page=barang";
                          </script>

                          <?php 
                        }
                      }
                   ?>