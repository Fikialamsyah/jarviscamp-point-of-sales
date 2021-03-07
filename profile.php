<?php

require('function.php');

$profile = query("SELECT * FROM profile")[0];

if(isset($_POST["submit"])){
    if(ubah($_POST) > 0){
        echo "
        <script>
            alert('data berhasil diupdate.');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "
        <script>
            alert('data gagal  diupdate.');
            document.location.href = 'index.php';
        </script>";
    }
}

?>
               
               
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <main>
        <div class="container-fluid">
                <h1 class="mt-4">Profile User</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Profile User</li>
                </ol>

                <div class="container-fluid card p-3 w-100">
                <form action="" method="POST">
                <h3>User</h3><hr>
                <div class="row">
                    <div class="col">
                        <input type="hidden" name="id" value="<?= $profile['id'];?>">
                        <label for="">Nama</label>
                        <input type="text" name="nama" class="form-control mb-2 w-50" value="<?= $profile['nama'];?>">
                        <label for=""></label>
                        <label for="">Tempat lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control mb-2 w-50" value="<?= $profile['tempat_lahir'];?>">
                        <label for="">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control mb-2 w-50" value="<?= $profile['tanggal_lahir'];?>">
                        <label for="">Gender</label>
                        <select name="gender_id" class="form-control mb-3 w-50">
                            <option value="">--</option>
                            <option value="L"  <?php if($profile['gender_id'] == "L") { echo "SELECTED"; } ?>>Laki-Laki</option>
                            <option value="P" <?php if($profile['gender_id'] == "P") { echo "SELECTED"; } ?>>Perempuan</option>
                        </select>
                        <button type="submit" class="btn btn-primary" name="submit">Update</button>
                </div>
                </form>
        </div>              
        </div>        
    </main>
</body>
</html>           