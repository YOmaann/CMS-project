<?php

include "./include/admin_header.php";
include "./include/admin_navigation.php";
include "./include/admin_sidebar.php";
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
if(isset($_POST['submit'])) {

    $cat_title = $_POST['cat_title'];
    if($cat_title == "" || empty($cat_title))
    echo "This field should not be empty.";
    else {
        $query = "INSERT INTO categories(cat_title) VALUES ('$cat_title')";
        // echo $query;
        $result  = mysqli_query($connection, $query);
        if(!$result)
        echo "Something went wrong! ".mysqli_error($connection);
        else 
        echo "Record added successfully";
    }
    // echo "HELLO";
}


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
if(isset($_POST['update'])) {
    $the_cat_title = $_POST['edit_cat_title'];
    $the_cat_id = $_POST['edit_cat_id'];
    $query = "UPDATE categories SET cat_title='$the_cat_title' where cat_id=$the_cat_id";
    $result  = mysqli_query($connection, $query);

    if($result) echo "Updated values successfully!";
    // header("Location: categories.php");
}

?>
                         <form action="categories.php" method="post" class="<?php if(!isset($_GET['edit'])) echo 'hidden'; ?>">
                             <div class="form-group">
                                 <label for="cat-title">Edit Category</label>

                                 <?php

                                 if(isset($_GET['edit'])){
                                $edit_cat_id = $_GET['edit'];

                                 $query = "SELECT cat_title FROM categories WHERE cat_id=$edit_cat_id";
                                 $result = mysqli_query($connection, $query);
                                 $edit_cat_title = mysqli_fetch_row($result)[0];

                                 }


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


                                $query = "SELECT * FROM categories";
                                $select_categories = mysqli_query($connection, $query);

                                    while($row = mysqli_fetch_assoc($select_categories)){
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
                                        echo "<tr><td>$cat_id</td>";
                                        echo "<td>$cat_title</td>";
                                        echo "<td><a href='categories.php?delete=$cat_id'>Delete</a></td>";
                                        echo "<td><a href='categories.php?edit=$cat_id'>Edit</a></td>";
                                        echo "</tr>";

                                    }
                                    ?>


<?php

if(isset($_POST['delete'])) {
    $the_cat_id = $_GET['delete'];
    $query = "DELETE FROM categories WHERE cat_id = $the_cat_id";
    $result  = mysqli_query($connection, $query);
    header("Location: categories.php");
}
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
