

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

if(isset($_REQUEST['search'])) {
    $search = $_REQUEST["search"];
    $query = "SELECT * from posts where post_tags like '%$search%' and post_status='published'";
    $search_query = mysqli_query($connection, $query);
    if(!$search_query) {
        die("Search Failed !".mysqli_error($connection));
        
    }
    $count = mysqli_num_rows($search_query);
    if($count == 0 ) {
        echo "<h1>NO RESULTS</h1>";
    } else {
        while($row = mysqli_fetch_assoc($search_query)) {
            $post_title = $row['post_title'];
            $post_date = $row['post_date'];
            $post_author = $row['post_author'];
            $post_image = $row['post_image'];
            $post_title = $row['post_title'];
            $post_content = $row['post_content'];
            $post_id = $row['post_id'];


        ?>

            <!-- First Blog Post -->
            <h2>
                <a href="#"><?= $post_title ?></a>
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
<?php
    }
}
?>


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