<?php

require 'koneksi.php';

    function registrasi($data) {
        global $conn;

        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password"]);
        $email = $data["email"];

        // cek username udah ada atau belum
        $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

        if (mysqli_fetch_assoc($result)) {
            echo "
            <script>
                alert('username sudah terdaftar!');
            </script>";

            return false;
        }

        // cek konfirmasi password
        if ($password !== $password2) {
            echo "
            <script>
                alert('Konfirmasi password tidak sesuai');
            </script>";

            return false;
        }


        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);


        // tambahkan user baru ke database
        mysqli_query($conn, "INSERT INTO user (id, username, password, email) VALUES ('', '$username', '$password', '$email')");

        return mysqli_affected_rows($conn);

    }

?>