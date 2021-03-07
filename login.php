<?php 

    session_start();

    if (isset($_SESSION["login"])) {
        header("Location: index.php");

        exit;
    }

    require 'koneksi.php';

    if (isset($_POST['login'])) {

        $email = $_POST["email"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM role_has_user JOIN user ON role_has_user.user_id = user.id JOIN role ON role_has_user.role_id = role.id WHERE user.email = '$email'");

        if (mysqli_num_rows($result) === 1) {

            // cek password
            $row = mysqli_fetch_assoc($result);

            if (password_verify($password, $row["password"])) {
                
                // set session
                $_SESSION["login"] = true;
                $_SESSION["id"] = $row["user_id"];
                $_SESSION["nama_user"] = $row["username"];
                $_SESSION["nama_role"] = $row["nama_role"];

                if ($_SESSION["nama_role"] == "superadmin") {
                    header("Location: index.php");
                } elseif ($_SESSION["nama_role"] == "admin toko") {
                    header("Location: index-admin.php");
                } elseif ($_SESSION["nama_role"] == "pegawai") {
                    header("Location: index-pegawai.php");
                }

                exit;
            }
            
        }

        $error = true;
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
        <title>Page Title - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <div class="form-group">
                                                <label class="small mb-1" for="email">Email</label>
                                                <input class="form-control py-4" id="email" type="email" placeholder="Enter email address" name="email"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="password">Password</label>
                                                <input class="form-control py-4" id="password" type="password" placeholder="Enter password" name="password"/>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Forgot Password?</a>
                                                <button class="btn btn-primary" type="submit" name="login">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
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
