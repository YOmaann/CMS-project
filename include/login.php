<?php


/*

Better way to store password securely:

$password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12))




*/
include "db.php";

session_start();

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    // $query = "SELECT randSalt from users";
    // $select_randsalt = mysqli_query($connection, $query);
    // $row  = mysqli_fetch_array($select_randsalt);


    $query = "SELECT * FROM users WHERE user_name='$username'";
    $select_user_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_array($select_user_query)) {

        $db_id = $row['user_id'];
        $db_username = $row['user_name'];
        $db_salt = $row['randSalt'];
        
        $db_firstname = $row['user_firstname'];
        $db_lastname = $row['user_lastname'];
        $db_role = $row['user_role'];
        $db_password = $row['user_password'];

        // $salt = $row['randSalt'];
        $password = crypt($password, $db_salt);
        

    }

    // echo "$username $password $db_username $db_password";

    if($username == $db_username && $db_password == $password) {
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_firstname;
        $_SESSION['lastname'] = $db_lastname;
        $_SESSION['user_role'] = $db_role;
        header("Location: ../admin/");
    }
    else {

        header("Location: ../index.php");
    }



}



?>