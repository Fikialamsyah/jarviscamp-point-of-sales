<?php

$id = $_SESSION["id"];
$user = '"user"';
$sql = $myPDO->prepare("SELECT * FROM $user WHERE id = '$id' ");
$sql->execute();
$tampil = $sql->fetch(PDO::FETCH_ASSOC);

?>
    <main>
        <div class="container-fluid">
                <h1 class="mt-4">Informasi User</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Informasi User</li>
                </ol>
                            <form method="POST">
                                <div class="form-group row">
                                    <label for="Username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w-50 bg-light" id="Username" name="username" value="<?= $tampil["username"]; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control w-50 bg-light" id="email" name="email" value="<?= $tampil["email"]; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" maxlength="10" class="form-control w-50 bg-light" id="password" name="password" value="<?= $tampil["password"]; ?>">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" name="update">Update</button>
                        </form>            
        </div>        
    </main>

    <?php 

        if(isset($_POST["update"])){
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($password === $tampil["password"]){
        $sql = $myPDO->prepare("update $user set username = '$username', email = '$email' where id = '$id' ");
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = $myPDO->prepare("update $user set username = '$username', email = '$email', password = '$password' where id = '$id' ");
    }

    
    
    try {

        $sql->execute();
        echo '
        <script type="text/javascript">
        alert("Data Berhasil di Update");
        window.location.href="?page=setting";
        </script>';
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }

    
    }

     ?>       