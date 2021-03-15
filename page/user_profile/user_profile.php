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
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w-25 bg-light" id="nama" name="nama" value="<?= $tampil["nama"]; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w-25 bg-light" id="tempat_lahir" name="tempat_lahir" value="<?= $tampil["tempat_lahir"]; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control w-25 bg-light" id="tanggal_lahir" name="tanggal_lahir" value="<?= $tampil["tanggal_lahir"]; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gender" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w-25 bg-light" id="gender" name="gender" value="<?= $tampil["gender"]; ?>">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" name="update">Update</button>
                            </form>
                    </div>
               </main>

                <?php 

                      if (isset($_POST['update'])) {
                        $nama = $_POST['nama'];
                        $tempat_lahir = $_POST['tempat_lahir'];
                        $tanggal_lahir = $_POST['tanggal_lahir'];
                        $gender = $_POST['gender'];

                        $update = $myPDO->prepare("UPDATE profile SET nama = '$nama', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', gender = '$gender' where user_id = '$id' ");

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