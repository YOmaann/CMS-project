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

            if(isset($_GET['category'])) {
                $post_category = $_GET['category'];
            }

            $query = "SELECT * from posts where post_category_id=$post_category";

            if(!isset($_SESSION['user_role'])) {
                $query .= " and post_status='published'";
            }
            if(isset($_SESSION['user_role']) && $_SESSION['user_role']!="admin") {
                $query .= " and post_status='published'";
            }
            
            $result = mysqli_query($connection, $query);

            $c = mysqli_num_rows($result);
            if($c == 0)
            echo "<div class=''><h1>No Posts Found!</h1></div>";

            while($row = mysqli_fetch_assoc($result)) {
                $post_title = $row['post_title'];
                $post_id = $row['post_id'];
                $post_date = $row['post_date'];
                $post_author = $row['post_author'];
                $post_image = $row['post_image'];
                $post_title = $row['post_title'];
                $post_content = substr($row['post_content'], 0, 100);


            ?>
                <!-- <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1> -->

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?= $post_id ?>"><?= $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?= $post_author ?>"><?= $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?= $post_date ?></p>
                <hr><a href="post.php?p_id=<?= $post_id ?>">
                <img class="img-responsive" src="./images/<?= $post_image ?>" alt=""></a>
                <hr>
                <p><?= $post_content ?></p>
                <!-- <a class="btn btn-primary" href="post.php?p_id=<?= $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

                <hr>
                <?php } ?>

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