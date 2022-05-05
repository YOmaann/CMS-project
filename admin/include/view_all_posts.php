<?php

if(isset($_POST['check'])){
    $action = $_POST['action'];

    foreach($_POST['check'] as $one) {
        // echo $one."<br>";

        switch($action) {
            case 'publish':
                $query = "UPDATE posts set post_status='published' where post_id=$one";
                $result = mysqli_query($connection, $query);
                break;
            case 'draft':
                $query = "UPDATE posts set post_status='draft' where post_id=$one";
                $result = mysqli_query($connection, $query);
                break;
            case 'delete':
                $query = "DELETE from posts where post_id=$one";
                $result = mysqli_query($connection, $query);
                break;
        }
    }
}

?>

<form action="" method="post">
    <div id="bulk" class="">
    <div class="col-xs-4">
        <select name="action" id="" class="form-control">
            <option value="publish">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
        </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
        </div>
        </div>
        <br>
<table class="table table-hover table-bordered" style="margin-top: 30px;">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" name="none" id="checkAll"></th>
                                        <th>Id</th>
                                        <th>Author</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Tags</th>
                                        <th>Comments</th>
                                        <th>Date</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                $query = "Select * from posts";
                $posts = mysqli_query($connection, $query);
                while($r = mysqli_fetch_assoc($posts)) {
                    $row = [];
                    $row[0] = $r['post_id'];
                    $row[1] = $r['post_author'];
                    $row[2] = $r['post_title'];
                    $row[3] = $r['post_category_id'];
                    $row[4] = $r['post_status'];
                    $row[5] = $r['post_image'];
                    $row[6] = $r['post_tags'];
                    $row[7] = $r['post_comment_count'];
                    $row[8] = $r['post_date'];

                    $query = "select * from categories where cat_id=".$row[3];
                    $result  = mysqli_query($connection, $query);
                
                    $category = mysqli_fetch_row($result)[1];
?>
                                    <tr>
                                        <td><input id="check" name="check[]" value="<?= $row[0] ?>" type="checkbox" class="checkboxes" id=""></td>
                                        <td><?= $row[0] ?></td>
                                        <td><?= $row[1] ?></td>
                                        <td><a href="../post.php?p_id=<?= $row[0] ?>"><?= $row[2] ?></a></td>
                                        <td><?= $category ?></td>
                                        <td><?= $row[4] ?></td>
                                        <td><img width="100" src="../images/<?= $row[5] ?>"></td>
                                        <td><?= $row[6] ?></td>
                                        <td><?= $row[7] ?></td>
                                        <td><?= $row[8] ?></td>
                                        <td><a href="posts.php?source=edit_post&p_id=<?= $row[0] ?>">Edit</a></td>
                                        <td><a href="posts.php?delete=<?= $row[0] ?>">Delete</a></td>

                                        
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <?php
if(isset($_GET['delete'])) {
    $the_post_id = $_GET['delete'];

    $query = "DELETE FROM posts WHERE post_id = $the_post_id";
    $result = mysqli_query($connection, $query);

    if($result) echo "Successfully deleted the post.";
    else echo "Something went wrong while deleting the post.";
    header("Location: posts.php");

}

?>
</form>