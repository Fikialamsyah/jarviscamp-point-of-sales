                  <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Kategori Toko</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Kategori Toko</li>
                        </ol>
                          <form method="POST">
                            <div class="form-group">
                              <label for="nama">Nama Vendor</label>
                              <input type="text" class="form-control" id="nama" aria-describedby="emailHelp" placeholder="Masukkan nama kategori toko baru" name="nama">
                            </div>
                            <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Masukkan email anda" name="email">
                            </div>
                            <div class="form-group">
                              <label for="telpon">No Telpon</label>
                              <input type="text" class="form-control" id="telpon" aria-describedby="emailHelp" placeholder="Masukkan no telpon anda" name="telpon">
                            </div>
                            <div class="form-group">
                              <label for="alamat">Alamat</label>
                              <input type="text" class="form-control" id="alamat" aria-describedby="emailHelp" placeholder="Masukkan alamat anda" name="alamat">
                            </div>
                            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                          </form>
                      </div>
                  </main>


                  <?php 

                      if (isset($_POST['simpan'])) {
                        $nama = $_POST['nama'];
                        $email = $_POST['email'];
                        $telpon = $_POST['telpon'];
                        $alamat = $_POST['alamat'];

                        $sql = $conn->query("insert into vendor (id, nama_vendor, alamat, telpon, email) values ('', '$nama', '$alamat', '$telpon', '$email')");

                        if ($sql) {
                          ?>

                          <script type="text/javascript">
                            alert("Data Berhasil di Simpan");
                            window.location.href="?page=vendor";
                          </script>

                          <?php 
                        }
                      }
                   ?>