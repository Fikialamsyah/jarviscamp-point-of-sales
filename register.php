<?php

    require 'koneksi.php';

    if (isset($_POST['signup'])) {
        // if (registrasi($_POST) > 0) {
        //     echo "
        //     <script>
        //         alert('user baru berhasil ditambahkan');
        //     </script>";
        // } else {
        //     // echo mysqli_error($conn);
        //     echo $myPDO->errorInfo();
        // }
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password2 = $_POST["password"];
        $email = $_POST["email"];
        $user = '"user"';

        $query1 = $myPDO->prepare("SELECT username FROM $user WHERE username = '$username' ");
        $query1->execute();

        $result = $query1->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            echo "
             <script>
                 alert('username sudah terdaftar!');
             </script>";

             return false;
        }

        if ($password !== $password2) {
            echo "
            <script>
                alert('Konfirmasi password tidak sesuai');
            </script>";

            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        // echo $username;
        // echo $password;
        // echo $email;
        $table = ' "user" ';

        $query2 = $myPDO->prepare("INSERT INTO $table (id, username, password, email) VALUES (default, '$username', '$password', '$email')");

        try {
            $query2->execute();
            echo '
                <script>
                alert("user baru berhasil ditambahkan");
                window.location.href="login.php";
                </script>';
            // header("Location: index.php");
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }

        // if($saved){
        //     echo "
        //     <script>
        //         alert('user baru berhasil ditambahkan');
        //     </script>";
        // } else {
        //     echo "raiso";
        // }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sign Up</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Sign Up</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="">
                                        <div class="form-group">
                                            <label class="small mb-1" for="username">Username</label>
                                            <input class="form-control py-4" id="username" type="text" aria-describedby="emailHelp" placeholder="Enter username" name="username"/>
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="email">Email</label>
                                            <input class="form-control py-4" id="email" type="email" aria-describedby="emailHelp" placeholder="Enter email address" name="email"/>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="password1">Password</label>
                                                    <input class="form-control py-4" id="password1" type="password" placeholder="Enter password" name="password"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="password2">Confirm Password</label>
                                                    <input class="form-control py-4" id="password2" type="password" placeholder="Confirm password" name="password2"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-4 mb-0">
                                            <button class="btn btn-primary btn-block" href="login.html" name="signup">Sign Up</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>