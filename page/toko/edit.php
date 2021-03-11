                  <?php 
                      $id = $_GET['id'];
                      $sql = $myPDO->prepare("select * from toko where id = '$id'");
                      $sql->execute();
                      $tampil = $sql->fetch(PDO::FETCH_ASSOC);
                  ?>

                  <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Toko</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Data Toko</li>
                        </ol>
                          <form method="POST">
                            <div class="form-group">
                              <label for="nama">Nama Toko</label>
                              <input type="text" class="form-control" id="nama" aria-describedby="emailHelp" placeholder="Masukkan nama kategori barang" name="nama" value="<?= $tampil["nama"]; ?>">
                            </div>
                            <div class="form-group">
                              <label for="alamat">Alamat</label>
                              <input type="text" class="form-control" id="alamat" aria-describedby="alamatHelp" placeholder="Masukkan alamat barang" name="alamat" value="<?= $tampil["alamat"]; ?>">
                            </div>
                            <div class="form-group">
                              <label for="telepon">Telepon</label>
                              <input type="text" class="form-control" id="telepon" aria-describedby="emailHelp" placeholder="Berikan telepon barang" name="telepon" value="<?= $tampil["telepon"]; ?>">
                            </div>
                            <div class="form-group">
                            <label for="kategori">Kategori Produk</label>
                            <select class="form-control" id="kategori" name="kategori">
                                <?php 
                                    $sql = $myPDO->prepare("SELECT * FROM informasi_toko");
                                    $sql->execute();
                                    while($row = $sql->fetch(PDO::FETCH_ASSOC)) {

                                    // foreach ($conn->query($sql) as $row) {
                                ?>
                              <option value="<?= $row['id']?>"><?= $row['nama']?></option>
                                <?php 
                                    }
                                ?>
                            </select>
                          </div>
                            <button type="submit" class="btn btn-primary" name="update">Update Data</button>
                          </form>
                      </div>
                  </main>


                  <?php 

                      if (isset($_POST['update'])) {
                        $nama = $_POST['nama'];
                        $alamat = $_POST['alamat'];
                        $telepon = $_POST['telepon'];
                        $kategori = $_POST['kategori'];

                        $tambah = $myPDO->prepare("UPDATE toko set nama = '$nama', alamat = '$alamat', telepon = '$telepon', informasi_toko_id = '$kategori' ");

                        try {

                          $sql->execute();
                          echo '
                            <script type="text/javascript">
                              alert("Data Berhasil di Update");
                              window.location.href="?page=toko";
                            </script>';
                        }
                        catch(PDOException $e) {
                            echo $e->getMessage();
                        }                      }
                   ?>