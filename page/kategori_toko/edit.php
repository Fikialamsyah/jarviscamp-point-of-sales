                  <?php 
                      $id = $_GET['id'];
                      $sql = $myPDO->prepare("select * from produk_kategori where id = '$id'");
                      $sql->execute();
                      $tampil = $sql->fetch(PDO::FETCH_ASSOC);
                  ?>

                  <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Kategori Toko</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Kategori Toko</li>
                        </ol>
                          <form method="POST">
                            <div class="form-group">
                              <label for="nama">Nama Kategori Toko</label>
                              <input type="text" class="form-control" id="nama" placeholder="Masukkan nama kategori toko baru" name="nama" value="<?= $tampil['nama']; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary" name="update">Update</button>
                          </form>
                      </div>
                  </main>


                  <?php 

                      if (isset($_POST['update'])) {
                        $nama = $_POST['nama'];

                        $sql = $myPDO->prepare("update produk_kategori set nama='$nama' where id = '$id'");

                        try {

                          $sql->execute();
                          echo '
                            <script type="text/javascript">
                              alert("Data Berhasil di Update");
                              window.location.href="?page=kategori_toko";
                            </script>';
                        }
                        catch(PDOException $e) {
                            echo $e->getMessage();
                        }
                      }
                   ?>