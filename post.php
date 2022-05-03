<?php  
include "./include/db.php";
include "./include/header.php";
?>

    <!-- Navigation -->
<?php  
include "./include/navigation.php";
?>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <?php

            $post_id = $_GET['p_id'];

            $query = "SELECT * from posts where post_id=$post_id";
            $result = mysqli_query($connection, $query);

            $row = mysqli_fetch_assoc($result);
                $post_title = $row['post_title'];
                $post_date = $row['post_date'];
                $post_author = $row['post_author'];
                $post_image = $row['post_image'];
                $post_title = $row['post_title'];
                $post_content = $row['post_content'];


            ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?= $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?= $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?= $post_date ?></p>
                <hr>
                <img class="img-responsive" src="./images/<?= $post_image ?>" alt="">
                <hr>
                <p><?= $post_content ?></p>
                

                <hr>

                   <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form">
                        <div class="form-group">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <div class="well">
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        <!-- Nested Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    </div>
                </div>

            </div>
            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php

include "./include/sidebar.php";
?>
        <!-- /.row -->

        <hr>

        <!-- Footer -->

<?php
include "./include/footer.php";

?>