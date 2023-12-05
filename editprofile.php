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
        $email = $user_logged['email'];
        $password = ($password);
        $password_baru = ($password_baru);
        $user_id = $_SESSION['user_id'];
        $photo = $_FILES['photo']['name'];
        $temp = $_FILES['photo']['tmp_name'];

              
        if(empty($photo))   {
            $sql = mysqli_query($conn, "UPDATE login SET password= '$password_baru' WHERE iduser='$user_id' AND password='$password'");
             if($sql){
                 header("location: profile.php?success=Password Updated");
             }else {
                 header("location: profile.php?error=Incorrect Password!");
                  exit();
             }
        }else {
            $sql = mysqli_query($conn, "UPDATE login SET photo= '$photo' WHERE iduser='$user_id'");
            copy($temp, "assets/img/" . $photo) ; 
             if($sql){
                 header("location: profile.php?success=Updated Success");
             }else {
                 header("location: profile.php?error=Error");
                  exit();
             }
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