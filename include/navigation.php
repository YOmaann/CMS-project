<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">



            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS Project</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->




            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                <?php

                $url = basename($_SERVER['PHP_SELF']);
                if(isset($_GET['category'])) {
                    $the_cat_id = $_GET['category'];
                }

                $query = "select * from categories";
                $select_all_categories_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_all_categories_query)) {
                    $cat_id = $row['cat_id'];
                    echo "<li><a href='category.php?category=$cat_id' class='".(($url == "category.php")?(($cat_id == $the_cat_id)?"active":""):"")."'>{$row['cat_title']}</a></li>";
                }


?>

                    <?php
                    if(!isLoggedIn()) {
                        echo "<li><a href='login.php'>Login</a></li>";
                        echo "                     <li>
                        <a href='./registration.php'> Register</a>
                    </li>";
                    }
                    else {
                        echo "                     <li>
                        <a href='./admin/'>Admin</a>
                    </li>";
                    }
                    if(isset($_GET['p_id'])) {
                        $post_id = $_GET['p_id'];

                        if(isset($_SESSION['username'])) {
                            echo "<li><a href='http://localhost/cms-project/admin/posts.php?source=edit_post&p_id=$post_id'>Edit Post</a></li>";
                        }
                        
                    }



?>
                    <!-- <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li> -->
                    <li><a href='contact.php'>Contact Us</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>