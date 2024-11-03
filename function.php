<?php

include 'koneksi.php';



// login function
function login($data)
{
    global $koneksi;

    $username =  $data['username'];
    $password =  $data['password'];

    //check the username
    $cek_username = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");


    //if username exist in database
    if (mysqli_num_rows($cek_username) === 1) {

        //get data from username
        $data_from_username = mysqli_fetch_assoc($cek_username);

        if (password_verify($password, $data_from_username['password'])) {

            $_SESSION['username'] = $data_from_username['username'];
            $_SESSION['role'] = $data_from_username['role'];
            $_SESSION['id_user'] = $data_from_username['id_user'];

            if ($data_from_username['role'] == 'pegawai') {
                echo"<script>
                        alert('Login success !');
                        window.location.href= 'pegawai/index.php'
                    </script>"; 
            exit;

            } else if ($data_from_username['role'] == 'supervisor'){
                echo"<script>
                        alert('Login success !');
                        window.location.href= 'supervisor/index.php'
                    </script>";
            exit;
            } else {
                echo"<script>
                        alert('Login success !');
                        window.location.href= 'admin/index.php'
                    </script>";
                exit;
            }
                
        } else {
            echo "<script>alert('Wrong Password')</script>";
        }
    } else {
        echo "<script>alert('Username doesn't exist')</script>";
    }
}


?>