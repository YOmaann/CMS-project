<?php

include "functions.php";
include "./include/admin_header.php";
include "./include/admin_navigation.php";
include "./include/admin_sidebar.php";
// include "functions.php";
?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>
                        <div class="center-block" style="overflow: auto;">
                            

                        <!-- Table here -->

                        <?php
if(isset($_GET['source'])) {
    $source = $_GET['source'];
}
else {
    $source ="";
}

    switch($source) {
        // case "view_post":
        //     include "./include/view_post_comments.php";
        //     break;
        default:
        // echo "Hello";
            include "./include/view_all_comments.php";
    }

?>
                        </div>

                        <div class="col-xs-6">
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
<?php
include "./include/admin_footer.php";
?>
