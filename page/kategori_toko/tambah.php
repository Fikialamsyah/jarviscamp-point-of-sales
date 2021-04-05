                  <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Kategori Toko</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Kategori Toko</li>
                        </ol>
                          <form method="POST">
                            <div class="form-group">
                              <label for="nama">Nama Kategori Toko</label>
                              <input type="text" class="form-control" id="nama" aria-describedby="emailHelp" placeholder="Masukkan nama kategori toko baru" name="nama" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                          </form>
                      </div>
                  </main>


                  <?php 

                      if (isset($_POST['simpan'])) {
                        $nama = $_POST['nama'];

                        $sql = $myPDO->prepare("insert into produk_kategori (id, nama) values ('', '$nama')");

                        try {

                          $sql->execute();
                          echo '
                            <script type="text/javascript">
                              alert("Data Berhasil di Simpan");
                              window.location.href="?page=kategori_toko";
                            </script>';
                        }
                        catch(PDOException $e) {
                            echo $e->getMessage();
                        }
                      }
                   ?>