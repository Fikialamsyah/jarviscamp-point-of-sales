                  <?php 
                      $id = $_GET['id'];
                      $sql = $conn->query("select * from produk_kategori where id = '$id'");
                      $tampil = $sql->fetch_assoc();
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

                        $sql = $conn->query("update produk_kategori set nama='$nama' where id = '$id'");

                        if ($sql) {
                          ?>

                          <script type="text/javascript">
                            alert("Data Berhasil di Simpan");
                            window.location.href="?page=kategori_toko";
                          </script>

                          <?php 
                        }
                      }
                   ?>