<?php

include "./include/admin_header.php";
include "./include/admin_navigation.php";
include "./include/admin_sidebar.php";
include "functions.php";
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
                        <div class="col-xs-6">
                            <?php
insert_categories();


?>
                         <form action="categories.php" method="post">
                             <div class="form-group">
                                 <label for="cat-title">Add Category</label>
                                 <input type="text" name="cat_title" class="form-control">
                             </div>
                             <div class="form-group">
                                 <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                             </div>
                         </form>
                         <?php
update_categories();
?>
                         <form action="categories.php" method="post" class="<?php if(!isset($_GET['edit'])) echo 'hidden'; ?>">
                             <div class="form-group">
                                 <label for="cat-title">Edit Category</label>

                                 <?php
                                 $edit_cat_id = $_GET['edit'];
                                 $edit_cat_title = edit_categories();


?>
                                
                                 <input type="text" name="edit_cat_title" class="form-control" value="<?php if(isset($edit_cat_title)) echo $edit_cat_title ; ?>">
                                 <input type="text" name="edit_cat_id" class="hidden" value="<?php if(isset($edit_cat_title)) echo $edit_cat_id ; ?>">
                             </div>
                             <div class="form-group">
                                 <input class="btn btn-primary" type="submit" name="update" value="Update">
                             </div>
                         </form>  
  
                        <!-- </div> -->
                        </div>

                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php


display_categories();
                                    ?>


<?php

delete_categories();
?>
                                </tbody>
                            </table>
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
