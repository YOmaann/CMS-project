<?php  include "include/db.php"; ?>
 <?php  include "include/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "include/navigation.php"; ?>
    
</nav>

<?php
// $message = "";
if(isset($_POST['submit'])) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $query = $_POST['query'];

    $to = "luckykispotta112@gmail.com";
    $subject = "Query by $name";
    $body = wordwrap($query, 70);

    mail($to, $subject, $body);
    echo "Query Sent!";


}

?>
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">

                <h1>Contact Us</h1>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">Name</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter your name">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Query</label>
                            <textarea name="query" id="" cols="10" rows="10" class="form-control" placeholder="Type in your query"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "include/footer.php"; ?>
