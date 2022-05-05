<?php  include "include/db.php"; ?>
 <?php  include "include/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "include/navigation.php"; ?>
    
</nav>

<?php
$message = "";
if(isset($_POST['submit'])) {
    // echo "hello";
    $username = $_POST['username'];
    $email = $_POST['email'];
    $passsword = $_POST['password'];


    if($username === "" || $email ==="" || $passsword ==="") {
       $message = "<h6 class='text-center'>Fields cannot be empty!</h6>";
    }
    else {

    $username = mysqli_real_escape_string($connection, $username);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $passsword);

    

    $query = "SELECT randSalt from users";
    $select_randsalt = mysqli_query($connection, $query);

    $row  = mysqli_fetch_array($select_randsalt);

    $salt = $row['randSalt'];

    $password = crypt($password, $salt);
    // echo $password;

    $query = "INSERT INTO users(user_name, user_password, user_role, user_email) values('$username', '$password', 'subscriber', '$email')";
    $result = mysqli_query($connection, $query);

    $_SESSION['username'] = $username;
    $_SESSION['firstname'] = "No";
    $_SESSION['lastname'] = "Name";
    $_SESSION['user_role'] = "subscriber";
    header("Location: ./admin");
    }
}

?>
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">

                <h1>Register</h1>
                <?= $message ?>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "include/footer.php"; ?>
