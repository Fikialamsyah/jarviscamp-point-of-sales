                  <?php 
                      $id = $_SESSION["id"];
                      $sql = $myPDO->prepare("select * from profile where user_id = '$id'");
                      // $tampil = $sql->fetch_assoc();
                      $sql->execute();
                      $tampil = $sql->fetch(PDO::FETCH_ASSOC);
                  ?>

               <main>
                    <div class="container-fluid">
                            <h1 class="mt-4">Informasi Profile</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">Informasi Profile</li>
                            </ol>
                            <form method="POST">
                                <img src="assets/profile/<?= $tampil['gambar_profile']; ?>" alt="" width="200px" height="200px" class="rounded-circle border border-dark mx-auto d-block">
                                <div class="form-group">
                                  <label for="gambar">Gambar Produk</label><br>
                                  <div class="d-flex">
                                    <input type="file" class="form-control-file" id="gambar" name="gambar">
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $tampil["nama"]; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $tampil["tempat_lahir"]; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $tampil["tanggal_lahir"]; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="gender">Jenis Kelamin</label>
                                    <input type="text" class="form-control" id="gender" name="gender" value="<?= $tampil["gender"]; ?>">
                                </div>
                                <input type="hidden" name="gambarLama" value="<?= $tampil["gambar_profile"]; ?>">
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
                        move_uploaded_file($tmpName, 'assets/profile/' . $namaFileBaru);
                        return $namaFileBaru;
                      }

                      if (isset($_POST['update'])) {
                        $nama = $_POST['nama'];
                        $tempat_lahir = $_POST['tempat_lahir'];
                        $tanggal_lahir = $_POST['tanggal_lahir'];
                        $gender = $_POST['gender'];
                        $gambarLama = $_POST['gambarLama'];

                        if ($_FILES['gambar']['error'] === 4) {
                          $gambar = $gambarLama;
                        } else  {
                          $gambar = upload();
                        }

                        $update = $myPDO->prepare("UPDATE profile SET nama = '$nama', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', gender = '$gender', gambar_profile = '$gambar' where user_id = '$id' ");

                        try {

                          $update->execute();
                          echo '
                            <script type="text/javascript">
                              alert("Data Berhasil di Update");
                              window.location.href="?page=user_profile";
                            </script>';
                        }
                        catch(PDOException $e) {
                            echo $e->getMessage();
                        }
                      }
                   ?>