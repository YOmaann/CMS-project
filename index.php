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

            $query = "SELECT * from posts where post_status='published'";
            $result = mysqli_query($connection, $query);

            if(mysqli_num_rows($result) == 0) 
            echo "<h1>No Posts here :)";

            while($row = mysqli_fetch_assoc($result)) {
                $post_title = $row['post_title'];
                $post_id = $row['post_id'];
                $post_date = $row['post_date'];
                $post_author = $row['post_author'];
                $post_image = $row['post_image'];
                $post_title = $row['post_title'];
                $post_content = substr($row['post_content'], 0, 100)."...";


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
                    by <a href="index.php"><?= $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?= $post_date ?></p>
                <hr>
                <img class="img-responsive" src="./images/<?= $post_image ?>" alt="">
                <hr>
                <p><?= $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?= $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

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