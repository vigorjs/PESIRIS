<?php
require 'function.php';
require 'cek.php';
if(isset($_SESSION['user_id'])){
    $user_logged = mysqli_fetch_array((mysqli_query($conn, "SELECT * FROM login WHERE iduser='$_SESSION[user_id]'")));   
   
if(isset($_POST['password']) && isset($_POST['password_baru']) && isset($_POST['password_baru2'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $password = validate($_POST['password']);
    $password_baru = validate($_POST['password_baru']);
    $password_baru2 = validate($_POST['password_baru2']);

    if(empty($password)) {
        header("location: profile.php?error=Old Password is Required");
         exit();
    }else if(empty($password_baru)){
        header("location: profile.php?error=New Password is Required");
         exit();
    }else if($password_baru !== $password_baru2){
        header("location: profile.php?error=The confirmation password does not match");
         exit();
    }else {
        //hashing the password
        $password = ($password);
        $password_baru = ($password_baru);
        $user_id = $_SESSION['user_id'];

         
       $sql = mysqli_query($conn, "UPDATE login SET password= '$password_baru' WHERE iduser='$user_id' AND password='$password'");
        if($sql){
            header("location: profile.php?success=Password Updated");
        }else {
            header("location: profile.php?error=Incorrect Password!");
             exit();
        }
    }

}else{
    header("location: profile.php");
    exit();
}    

}else{
    header("location: index.php");
    exit();
}

    ?>