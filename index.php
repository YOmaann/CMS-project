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
        <?php
// session_start();
// echo $_SESSION['username'];

?>

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <?php

            $page = 0;
            if(isset($_GET['page']))
                $page = $_GET['page'] - 1;

            $query = "SELECT * from posts";

            if(!isset($_SESSION['user_role'])) {
                $query .= " where post_status='published'";
            }
            if(isset($_SESSION['user_role']) && $_SESSION['user_role']!="admin") {
                $query .= " where post_status='published'";
            }

            $query .= " LIMIT $page, 10"; 

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
                    by <a href="author_posts.php?author=<?= $post_author ?>"><?= $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?= $post_date ?></p>
                <hr>
                <a href="post.php?p_id=<?= $post_id ?>">
                <img class="img-responsive" src="./images/<?= $post_image ?>" alt="">
            </a>
                <hr>
                <p><?= $post_content ?></p>
                <!-- <a class="btn btn-primary" href="post.php?p_id=<?= $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

                <hr>
                <?php } ?>
                <div><ul class="pager">
            <?php
            $query_count = "SELECT * from posts where post_status='published'";
            $result_count = mysqli_query($connection, $query_count);
            $post_count = mysqli_num_rows($result_count);
            $post_page_count = ceil($post_count / 10);
            // echo "$post_count $post_page_count asfdsfd";

            if($page > 0)
            echo "<li><a href='index.php?page=$page'><</a></li>";

            for($i = (($page > 3)?$page - 3:1); $i < $page + 1; $i++) {
                echo "<li><a href='index.php?page=$i'>$i</a></li>&nbsp";
            }
            echo "&nbsp<li>".($page + 1)."</li>&nbsp";
            for($i = $page + 2; $i <= $page + 5 && $i <= $post_page_count; $i++) {
                echo "<li><a href='index.php?page=$i'>$i</a></li>&nbsp";
            }
            if($page + 5 < $post_page_count - 1)
            echo "<li><a href='index.php?page=".($page + 2)."'>></a></li>";

            


?>
</p>
</div>
            </div>


            <!-- Blog Sidebar Widgets Column -->
<?php

if(ifItIsMethod("post")) {
	if(isset($_POST['username']) && isset($_POST['password'])) {
		if(login_user($_POST['username'], $_POST['password'])) {
			redirect('./admin/');
		}
		else {
			redirect("index.php");
		}
	}
}

include "./include/sidebar.php";
?>
        <!-- /.row -->

        <hr>

        <!-- Footer -->

<?php
include "./include/footer.php";

?>