<?php

// function insert_categories() {
//     global $connection;
//     if(isset($_POST['submit'])) {

//         $cat_title = $_POST['cat_title'];
//         if($cat_title == "" || empty($cat_title))
//         echo "This field should not be empty.";
//         else {
//             $query = "INSERT INTO categories(cat_title) VALUES ('$cat_title')";
//             // echo $query;
//             $result  = mysqli_query($connection, $query);
//             if(!$result)
//             echo "Something went wrong! ".mysqli_error($connection);
//             else 
//             echo "Record added successfully";
//         }
//         // echo "HELLO";
//     }
// }

function insert_categories() {
    global $connection;
    if(isset($_POST['submit'])) {

        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title))
        echo "This field should not be empty.";
        else {
            $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUES (?)");
            mysqli_stmt_bind_param($stmt, "s", $cat_title);
            mysqli_stmt_execute($stmt);
            // echo $query;
            // $result  = mysqli_query($connection, $query);
            if(!$stmt)
            echo "Something went wrong! ".mysqli_error($connection);
            else 
            echo "Record added successfully";
        }
        mysqli_stmt_close($stmt);
        // echo "HELLO";
    }
}
// function update_categories() {
//     global $connection;
//     if(isset($_POST['update'])) {
//         // echo "Hello";
//         $the_cat_title = $_POST['edit_cat_title'];
//         $the_cat_id = $_POST['edit_cat_id'];
//         $query = "UPDATE categories SET cat_title='$the_cat_title' where cat_id=$the_cat_id";
//         $result  = mysqli_query($connection, $query);
    
//         if($result) echo "Updated values successfully!";
//         else echo "Something went wrong! <br>".mysqli_error($connection);
//         // header("Location: categories.php");
//     }
// }
function update_categories() {
    global $connection;
    if(isset($_POST['update'])) {
        // echo "Hello";
        $the_cat_title = $_POST['edit_cat_title'];
        $the_cat_id = $_POST['edit_cat_id'];
        $stmt = mysqli_prepare($connection, "UPDATE categories SET cat_title=? where cat_id=?");
        mysqli_stmt_bind_param($stmt, "si", $the_cat_title, $the_cat_id);
        mysqli_stmt_execute($stmt);
        // $result  = mysqli_query($connection, $query);
    
        if($stmt) echo "Updated values successfully!";
        else echo "Something went wrong! <br>".mysqli_error($connection);
        mysqli_stmt_close($stmt);
        // header("Location: categories.php");
    }
}


// function edit_categories() {
//     global $connection, $edit_cat_id;
//     if(isset($_GET['edit'])){
        

//          $query = "SELECT cat_title FROM categories WHERE cat_id=$edit_cat_id";
//          $result = mysqli_query($connection, $query);
//          $edit_cat_title = mysqli_fetch_row($result)[0];
//         //  mysqli_stmt_close($stmt);
//          return $edit_cat_title;
//          }
// }

function edit_categories() {
    global $connection, $edit_cat_id;
    if(isset($_GET['edit'])){
        

         $stmt = mysqli_prepare($connection, "SELECT cat_title FROM categories WHERE cat_id=?");
         mysqli_stmt_bind_param($stmt, "i", $edit_cat_id);
         mysqli_stmt_execute($stmt);
         mysqli_stmt_bind_result($stmt, $edit_cat_title);
        //  $result = mysqli_query($connection, $query);
         mysqli_stmt_fetch($stmt);
         mysqli_stmt_close($stmt);
         return $edit_cat_title;
         }
}
// function display_categories() {
//     global $connection;
//     $query = "SELECT * FROM categories";
//     $select_categories = mysqli_query($connection, $query);

//         while($row = mysqli_fetch_assoc($select_categories)){
//             $cat_id = $row['cat_id'];
//             $cat_title = $row['cat_title'];
//             echo "<tr><td>$cat_id</td>";
//             echo "<td>$cat_title</td>";
//             echo "<td><a href='categories.php?delete=$cat_id' class='btn btn-danger'>Delete</a></td>";
//             echo "<td><a href='categories.php?edit=$cat_id' class='btn btn-primary'>Edit</a></td>";
//             echo "</tr>";

//         }
// }
function display_categories() {
    global $connection;
    $stmt = mysqli_prepare($connection, "SELECT * FROM categories");
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $cat_id, $cat_title);
    // $select_categories = mysqli_query($connection, $query);

        while($row = mysqli_stmt_fetch($stmt)){
            // $cat_id = $row['cat_id'];
            // $cat_title = $row['cat_title'];
            echo "<tr><td>$cat_id</td>";
            echo "<td>$cat_title</td>";
            echo "<td><a href='categories.php?delete=$cat_id' class='btn btn-danger'>Delete</a></td>";
            echo "<td><a href='categories.php?edit=$cat_id' class='btn btn-primary'>Edit</a></td>";
            echo "</tr>";

        }
        mysqli_stmt_close($stmt);
}

function delete_categories() {
    global $connection;
    if(isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];
        $stmt = mysqli_prepare($connection, "DELETE FROM categories WHERE cat_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $the_cat_id);

        mysqli_stmt_execute($stmt);
        // $result  = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}
function usersOnline() {
    include "../include/db.php";
    // session_start();

    $time_out = time() - 60;
    // echo $time_out." ";
    $query = "SELECT * from users_online where time > $time_out";
    $result = mysqli_query($connection, $query);
    echo "Users online: ".mysqli_num_rows($result);
}
if(isset($_GET['onlineusers'])) {
    usersOnline();
}

function getCount($table, $where="") {
    global $connection;
    $query = "SELECT * FROM $table $where";
    $result = mysqli_query($connection, $query);
    $count = mysqli_num_rows($result);
    return $count;
}

function is_admin($username = "") {

    global $connection;

    $query = "SELECT user_role FROM users WHERE user_name = '$username'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);

    if($row['user_role'] == "admin") return true;
    return false;
}

function username_exists($username) {
    global $connection;
    $query = "SELECT * FROM users where user_name='$username'";
    $result = mysqli_query($connection, $query);
    $num = mysqli_num_rows($result);
    if($num > 0) return true;
    return false;
}
function email_exists($email) {
    global $connection;
    $query = "SELECT * FROM users where user_email='$email'";
    $result = mysqli_query($connection, $query);
    $num = mysqli_num_rows($result);
    if($num > 0) return true;
    return false;
}

function ifItIsMethod($method = null) {
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)) {
        return true;
    }
    return false;
}

function isLoggedIn() {
    if(isset($_SESSION['user_role'])) {
        return true;
    }
    return false;
}

function redirect($location = "../index.php") {
    header("Location: $location");
    exit;
}

function checkIfUserIsLoggedInAndRedirect($redirectlocation = null) {
    if(isLoggedIn()){
        redirect($redirectlocation);
    }
}

function login_user($username = null, $password = null) {
    global $connection;

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    // $password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 10]);

    // $query = "SELECT randSalt from users";
    // $select_randsalt = mysqli_query($connection, $query);
    // $row  = mysqli_fetch_array($select_randsalt);


    $query = "SELECT * FROM users WHERE user_name='$username'";
    $select_user_query = mysqli_query($connection, $query);

    if(mysqli_num_rows($select_user_query) == 0) return false;

    while($row = mysqli_fetch_array($select_user_query)) {

        $db_id = $row['user_id'];
        $db_username = $row['user_name'];
        // $db_salt = $row['randSalt'];
        
        $db_firstname = $row['user_firstname'];
        $db_lastname = $row['user_lastname'];
        $db_role = $row['user_role'];
        $db_password = $row['user_password'];

        // $salt = $row['randSalt'];
        // $password = crypt($password, $db_salt);
        

    }

    // echo "$username $password $db_username $db_password";

    if($username == $db_username && password_verify($password, $db_password)) {
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_firstname;
        $_SESSION['lastname'] = $db_lastname;
        $_SESSION['user_role'] = $db_role;
        return true;
    }
    else {
        return false;
    }
}