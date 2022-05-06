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

            $query = "SELECT * from posts where post_id=$post_id";

            if(!isset($_SESSION['user_role'])) {
                $query .= " and post_status='published'";
            }
            if(isset($_SESSION['user_role']) && $_SESSION['user_role']!="admin") {
                $query .= " and post_status='published'";
            }
            $result = mysqli_query($connection, $query);

            $row = mysqli_fetch_assoc($result);
                $post_title = $row['post_title'];
                $post_date = $row['post_date'];
                $post_author = $row['post_author'];
                $post_image = $row['post_image'];
                $post_title = $row['post_title'];
                $post_content = $row['post_content'];
                $post_status = $row['post_status'];

                // if($post_status == "draft") header("Location: index.php");

                // if(!isset($_POST['comment_author'])){

                // }


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

                   <?php

                //    echo "Hello";
            if(isset($_POST['comment_author'])){
                    //    echo "World";
                       $comment_author = $_POST['comment_author'];
                       $comment_email = $_POST['comment_email'];
                       $comment_content = $_POST['comment_content'];

                       if($comment_author !== "" && $comment_content !== "" && $comment_email !== "") {

                    //    echo $comment_author;

                    $query = "INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content, comment_status, comment_date) values($post_id, '$comment_author', '$comment_email', '$comment_content', 'unapproved', now())";
                    $result = mysqli_query($connection, $query);

                   $query = "UPDATE posts set post_comment_count=post_comment_count+1 where post_id=$post_id";
                   $result = $result & mysqli_query($connection, $query);

                   if($result) echo "Successfully added the comment!";
                   else echo "Something went wrong ".mysqli_error($connection);

                   }
                   else {
                    echo "Invalid Data Input!";
                }
                header("Location: post.php?p_id=$post_id");
            }
            else {
                $query = "UPDATE posts SET post_views=post_views+1 where post_id=$post_id";
                $result = mysqli_query($connection, $query);
            }
                

?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="#" method="post" role="form">
                    <div class="form-group">
                        <label for="author">Author</label>
                            <input type="text" class="form-control" name="comment_author" id="author" placeholder="Author Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                        <input type="text" class="form-control" name="comment_email" id="email" placeholder="Author Email">
                        </div>
                        <div class="form-group">
                            <label for="pan">Comment</label>
                            <textarea class="form-control" rows="3" id="pan" name="comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>
                <div class="mb-4">
                <h2>Comments</h2>
                </div>

                <!-- Posted Comments -->

                <!-- Comment -->


                <!-- Comment -->

                <?php

                $query = "SELECT * FROM comments where comment_post_id=$post_id AND comment_status='approved' ORDER BY comment_id DESC";
                $result = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($result)) {
                    $comment_author = $row['comment_author'];
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                
                ?>
                <div class="well">
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading"><?= $comment_author ?>
                            <small><?= $comment_date ?></small>
                        </h4>
                    <?= $comment_content ?>    
                    </div>
                </div>
                </div>
                <?php
                }
                ?>
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