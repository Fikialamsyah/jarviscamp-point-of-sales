                    <?php 
                      $id = $_GET['id'];
                      // $sql = $conn->query("select * from produk where id = '$id'");
                      // $tampil = $sql->fetch_assoc();
                      $sql = $myPDO->prepare("SELECT * FROM produk WHERE id = '$id' ");
                      $sql->execute();
                      $tampil = $sql->fetch(PDO::FETCH_ASSOC);
                  ?>

                  <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Kategori Toko</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Kategori Toko</li>
                        </ol>
                          <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                              <label for="kode">Kode Produk</label>
                              <input type="text" class="form-control" id="kode" aria-describedby="emailHelp" placeholder="Masukkan kode kategori barang" name="kode" value="<?= $tampil["kode_produk"]; ?>">
                            </div>
                            <div class="form-group">
                              <label for="gambar">Gambar Produk</label><br>
                              <div class="d-flex">
                                <img src="assets/produk/<?= $tampil['gambar_produk']; ?>" alt="" width="30px">
                                <input type="file" class="form-control-file ml-3" id="gambar" name="gambar">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="nama">Nama Barang</label>
                              <input type="nama" class="form-control" id="nama" aria-describedby="namaHelp" placeholder="Masukkan nama barang" name="nama" value="<?= $tampil["nama"]; ?>">
                            </div>
                            <div class="form-group">
                              <label for="deskripsi">Deskripsi</label>
                              <input type="text" class="form-control" id="deskripsi" aria-describedby="emailHelp" placeholder="Berikan deskripsi barang" name="deskripsi" value="<?= $tampil["deskripsi"]; ?>">
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
                              <input type="number" class="form-control" id="stok" aria-describedby="emailHelp" placeholder="Masukkan stok barang" name="stok" value="<?= $tampil["stok"]; ?>">
                            </div>
                            <div class="form-group">
                              <label for="hargaBeli">Harga Beli</label>
                              <input type="text" class="form-control" id="hargaBeli" aria-describedby="emailHelp" placeholder="Masukkan harga beli" name="hargaBeli" value="<?= $tampil["harga_beli"]; ?>">
                            </div>
                            <div class="form-group">
                              <label for="hargaJual">Harga Jual</label>
                              <input type="text" class="form-control" id="hargaJual" aria-describedby="emailHelp" placeholder="Masukkan harga jual" name="hargaJual" value="<?= $tampil["harga_jual"]; ?>">
                            </div>
                            <input type="hidden" name="gambarLama" value="<?= $tampil["gambar_produk"]; ?>">
                            <button type="submit" class="btn btn-primary" name="update">Update</button>
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

                      if (isset($_POST['update'])) {
                        $kode = $_POST['kode'];
                        $nama = $_POST['nama'];
                        $deskripsi = $_POST['deskripsi'];
                        $kategori = $_POST['kategori'];
                        $stok = $_POST['stok'];
                        $hargaBeli = $_POST['hargaBeli'];
                        $hargaJual = $_POST['hargaJual'];
                        $gambarLama = $_POST['gambarLama'];

                        // cek user apakah upload gambar atau tidak
                        if ($_FILES['gambar']['error'] === 4) {
                          $gambar = $gambarLama;
                        } else  {
                          $gambar = upload();
                        }


                        // $update = $conn->query("UPDATE produk SET nama = '$nama', harga_jual = '$hargaJual', deskripsi = '$deskripsi', stok = '$stok', produk_kategori_id = '$kategori', kode_produk = '$kode', harga_beli = '$hargaBeli' WHERE id = '$id' ");

                        $sql = $myPDO->prepare("UPDATE produk SET nama = '$nama', harga_jual = '$hargaJual', deskripsi = '$deskripsi', stok = '$stok', produk_kategori_id = '$kategori', kode_produk = '$kode', harga_beli = '$hargaBeli', gambar_produk = '$gambar' WHERE id = '$id' ");
                        
                        try {

                          $sql->execute();
                          echo '
                            <script type="text/javascript">
                              alert("Data Berhasil di Update");
                              window.location.href="?page=barang";
                            </script>';
                        }
                        catch(PDOException $e) {
                            echo $e->getMessage();
                        }
                      }
                   ?>