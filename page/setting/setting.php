                  <?php 
                      $id = $_SESSION["id"];
                      $sql = $conn->query("select * from user where id = '$id'");
                      $tampil = $sql->fetch_assoc();
                  ?>

               <main>
                    <div class="container-fluid">
                            <h1 class="mt-4">Setting</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item active">Setting</li>
                            </ol>
                            <form action="">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w-25 bg-light" id="staticEmail" name="username" value="<?= $tampil["username"]; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control w-25 bg-light" id="staticEmail" name="email" value="<?= $tampil["email"]; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control w-25 bg-light" id="staticEmail" name="password" value="<?= $tampil["password"]; ?>">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" name="update">Update</button>
                            </form>
                    </div>
               </main>