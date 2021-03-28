                  <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Produk</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Data Produk</li>
                        </ol>
                          <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                              <label for="kode">Kode Produk</label>
                              <input type="text" class="form-control" id="kode" aria-describedby="emailHelp" placeholder="Masukkan kode kategori barang" name="kode">
                            </div>
                            <div class="form-group">
                              <label for="gambar">Gambar Produk</label>
                              <input type="file" class="form-control-file" id="gambar" name="gambar">
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
                                    // $sql = "SELECT * FROM produk_kategori";

                                    // foreach ($conn->query($sql) as $row) {

                                    $sql = $myPDO->prepare("SELECT * FROM produk_kategori");
                                    $sql->execute();

                                    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                              <option value="<?= $row['id']?>"><?= $row['nama']?></option>
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

                      function upload() {
                        $namaFile = $_FILES['gambar']['name'];
                        $ukuranFiles = $_FILES['gambar']['size'];
                        $error = $_FILES['gambar']['error'];
                        $tmpName = $_FILES['gambar']['tmp_name'];

                        // cek gambar upload
                        if ($error === 4) {
                          echo '
                            <script>
                              alert("pilih gambar terlebih dahulu");
                            </script>
                          ';
                          return false;
                        }

                        // cek type file
                        $extensiGambarValid = ['jpg','jpeg','png'];
                        $extensiGambar = explode('.', $namaFile);
                        $extensiGambar = strtolower(end($extensiGambar));

                        if (!in_array($extensiGambar, $extensiGambarValid)) {
                          echo '
                            <script>
                              alert("yang anda upload bukan gambar");
                            </script>
                          ';
                          return false;
                        }

                        // cek ukuran
                        if ($ukuranFiles > 1000000) {
                          echo '
                            <script>
                              alert("ukuran gambar terlalu besar");
                            </script>
                          ';
                          return false;
                        }

                        // generate nama
                        $namaFileBaru = uniqid();
                        $namaFileBaru .= '.';
                        $namaFileBaru .= $extensiGambar;


                        // lolos cek
                        move_uploaded_file($tmpName, 'assets/produk/' . $namaFileBaru);
                        return $namaFileBaru;
                      }

                      if (isset($_POST['simpan'])) {
                        $kode = $_POST['kode'];
                        $nama = $_POST['nama'];
                        $deskripsi = $_POST['deskripsi'];
                        $kategori = $_POST['kategori'];
                        $stok = $_POST['stok'];
                        $hargaBeli = $_POST['hargaBeli'];
                        $hargaJual = $_POST['hargaJual'];

                        $gambar = upload();
                        if (!$gambar) {
                          return false;
                        }

                        // $tambah = $conn->query("insert into produk (id, nama, harga_jual, deskripsi, stok, produk_kategori_id, kode_produk, harga_beli) values ('', '$nama', '$hargaJual', '$deskripsi', '$stok', '$kategori', '$kode', '$hargaBeli')");
                        $sql = $myPDO->prepare("insert into produk (id, nama, harga_jual, deskripsi, stok, produk_kategori_id, kode_produk, harga_beli, gambar_produk) values (default, '$nama', '$hargaJual', '$deskripsi', '$stok', '$kategori', '$kode', '$hargaBeli', '$gambar')");

                        try {

                          $sql->execute();
                          echo '
                            <script type="text/javascript">
                              alert("Data Berhasil di Simpan");
                              window.location.href="?page=barang";
                            </script>';
                        }
                        catch(PDOException $e) {
                            echo $e->getMessage();
                        }
                      }
                   ?>