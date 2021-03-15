                  <?php 
                      $id = $_SESSION["id"];
                      $sql = $conn->query("SELECT toko.nama, toko.alamat, toko.telepon, toko.informasi_toko_id FROM profile_has_toko JOIN profile ON profile_has_toko.profile_id = profile.id JOIN toko ON profile_has_toko.toko_id = toko.id where profile.user_id = '$id'");
                      $tampil = $sql->fetch_assoc();
                  ?>

               <main>
                    <div class="container-fluid">
                            <h1 class="mt-4">Informasi Toko</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">Informasi Toko</li>
                            </ol>
                            <form action="">
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama Toko</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w-25 bg-light" id="nama" name="nama" value="<?= $tampil["nama"]; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w-25 bg-light" id="alamat" name="alamat" value="<?= $tampil["alamat"]; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="telepon" class="col-sm-2 col-form-label">No Telepon</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w-25 bg-light" id="telepon" name="telepon" value="<?= $tampil["telepon"]; ?>">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" name="update">Update</button>
                            </form>
                    </div>
               </main>