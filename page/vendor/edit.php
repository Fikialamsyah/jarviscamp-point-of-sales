                  <?php 
                      $id = $_GET['id'];
                      $sql = $myPDO->prepare("select * from vendor where id = '$id'");
                      $sql->execute();

                      $tampil = $sql->fetch(PDO::FETCH_ASSOC);
                      // $tampil = $sql->fetch_assoc();
                  ?>

                  <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Kategori Toko</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Kategori Toko</li>
                        </ol>
                          <form method="POST">
                            <div class="form-group">
                              <label for="nama">Nama Vendor</label>
                              <input type="text" class="form-control" id="nama" aria-describedby="emailHelp" placeholder="Masukkan nama kategori toko baru" name="nama" value="<?= $tampil['nama_vendor']; ?>">
                            </div>
                            <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Masukkan email anda" name="email" value="<?= $tampil['email']; ?>">
                            </div>
                            <div class="form-group">
                              <label for="telpon">No Telpon</label>
                              <input type="text" class="form-control" id="telpon" aria-describedby="emailHelp" placeholder="Masukkan no telpon anda" name="telpon" value="<?= $tampil['telpon']; ?>">
                            </div>
                            <div class="form-group">
                              <label for="alamat">Alamat</label>
                              <input type="text" class="form-control" id="alamat" aria-describedby="emailHelp" placeholder="Masukkan alamat anda" name="alamat" value="<?= $tampil['alamat']; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary" name="update">Update</button>
                          </form>
                      </div>
                  </main>


                  <?php 

                      if (isset($_POST['update'])) {
                        $nama = $_POST['nama'];
                        $email = $_POST['email'];
                        $telpon = $_POST['telpon'];
                        $alamat = $_POST['alamat'];

                        $sql = $myPDO->prepare("update vendor set nama_vendor = '$nama', alamat = '$alamat', telpon = '$telpon', alamat = '$telpon' where id = '$id'");

                        try {

                          $sql->execute();
                          echo '
                            <script type="text/javascript">
                              alert("Data Berhasil di Update");
                              window.location.href="?page=vendor";
                            </script>';
                        }
                        catch(PDOException $e) {
                            echo $e->getMessage();
                        }
                      }
                   ?>