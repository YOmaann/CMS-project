<?php
            // use PHPMailer;
            require 'vendor/autoload.php';
?>
<?php  include "include/db.php"; ?>
<?php  include "include/header.php"; ?>

<?php
if(!isset($_GET['forgot'])) {
    redirect("index.php");
}

if(ifItIsMethod('post')) {
    IF(isset($_POST['email'])) {
        $email = $_POST['email'];

        $length = 50;

        $token = bin2hex(openssl_random_pseudo_bytes($length));

        if(email_exists($email)) {
            $stmt = mysqli_prepare($connection, "UPDATE users SET token=? where user_email=?");
            mysqli_stmt_bind_param($stmt, "ss", $token, $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            // mail();

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'd73997c2d28e7d';
            $mail->Password = '5ed5c6e51f0ad5';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            $mail->setFrom('cms@company.com', 'CMS Client');
            // echo $email;
            $mail->addReplyTo('cms@company.com', 'CMS Client');
            $mail->addAddress("luckykispotta112@gmail.com", "User");

            $mail->isHTML(true);

            $mail->Subject = "Forgot Password";
// $mail->addEmbeddedImage('path/to/image_file.jpg', 'image_cid');
            $mail->Body = '<h3>Reset Password here</h3>';
            $mail->AltBody = 'This is the plain text version of the email content';

            if(!$mail->send()){
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }else{
                echo 'Message has been sent';
            }

        }
        else {
            echo "Email is not registered!";
        }
    }
}
?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">


                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">




                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "include/footer.php";?>

</div> <!-- /.container -->

