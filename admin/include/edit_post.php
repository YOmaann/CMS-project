<?php

// if(isset($_GET['p_id'])) {

// }
if(isset($_GET['p_id'])) {
    $p_id = $_GET['p_id'];


    // update post

    if(isset($_POST['update_post'])) {
    // echo "hello";

    $post_title = $_POST['post_title'];
    $post_cat = $_POST['post_cat'];
    $post_author = $_POST['post_author'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_status = $_POST['post_status'];

    // $post_date = date('d-m-y');
    // $post_comment_count = 0;
    $query = "UPDATE posts set post_category_id=$post_cat, post_title='$post_title', post_author='$post_author', post_content='$post_content', post_tags='$post_content', post_status='$post_status', post_date=now()";
   
if($_FILES['post_image']['error'] != UPLOAD_ERR_NO_FILE){
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    // images

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query .= ", post_image='$post_image'";
}
$query.= "where post_id=$p_id";
    // $query = "UPDATE posts set post_category_id=$post_cat, post_title='$post_title', post_author='$post_author', post_content='$post_content', post_tags='$post_content', post_status='$post_status', post_image='$post_image', post_date=now() where post_id=$p_id";
    // $query .= "VALUES('$post_cat', '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', '$post_comment_count', '$post_status')";

    $result = mysqli_query($connection, $query);
    if($result) echo "Post updated!";
    else echo mysqli_error($connection);
}
    // $post_title = $_POST['post_title'];
    // $post_cat = $_POST['post_cat'];
    // $post_author = $_POST['post_author'];
    // $post_tags = $_POST['post_tags'];
    // $post_content = $_POST['post_content'];
    // $post_status = $_POST['post_status'];

    // $post_date = date('d-m-y');
    // $post_comment_count = 0;

    // $post_image = $_FILES['post_image']['name'];
    // $post_image_temp = $_FILES['post_image']['tmp_name'];

    // // images

    // move_uploaded_file($post_image_temp, "../images/$post_image");

    // $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status)";
    // $query .= "VALUES('$post_cat', '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', '$post_comment_count', '$post_status')";

    // $result = mysqli_query($connection, $query);
    // if($result) echo "Post added!";
    // else echo mysqli_error($connection);

    $query = "Select * from posts where post_id=$p_id";
    $posts = mysqli_query($connection, $query);
    $r = mysqli_fetch_assoc($posts);
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
            $row[9] = $r['post_content'];
}



?>


<form action="" method="post" enctype="multipart/form-data">
                             <div class="form-group">
                                 <label for="post_cat">Post Category Id</label>
                                 <select name="post_cat" id="post_cat" class="form-control">
                                     <?php

                                     $query = "select * from categories";
                                     $result = mysqli_query($connection, $query);
                                     while($row1 = mysqli_fetch_assoc($result)) {
                                         $cat_id = $row1['cat_id'];
                                         $cat_title = $row1['cat_title'];
                                         echo "<option value=$cat_id ".(($row[3]==$cat_id)?"selected":"").">$cat_title</option>";
                                     }


?>
                                 </select>
                                 <!-- <input type="text" name="post_cat" class="form-control" value=""> -->
                             </div>
                             <div class="form-group">
                                 <label for="post_author">Post Author</label>
                                 <input type="text" name="post_author" class="form-control" value="<?= $row[1] ?>">
                             </div>
                             <div class="form-group">
                                 <label for="post_title">Post Title</label>
                                 <input type="text" name="post_title" class="form-control" value="<?= $row[2] ?>">
                             </div>
                             <div class="form-group">
                                 <label for="post_status">Post Status</label>
                                 <input type="text" name="post_status" class="form-control" value="<?= $row[4] ?>">
                             </div>
                             <div class="form-group">
                                 <label for="post_image" class="form-control">Post image</label>

                                 <img src="../images/<?= $row[5] ?>" width="200" alt="">
                                 <input type="file" name="post_image" id="post_image">
                             </div>
                             <div class="form-group">
                                 <label for="post_tags">Post Tags</label>
                                 <input type="text" name="post_tags" class="form-control" value="<?= $row[6] ?>">
                             </div>
                             <div class="form-group">
                                 <label for="post_content">Post Content</label>
                                 <textarea name="post_content" id=""  rows="10" class="form-control" ><?= $row[9] ?></textarea>
                             </div>
                             <div class="form-group">
                                 <input class="btn btn-primary" type="submit" name="update_post" value="Edit Post">
     </div>
</form>

<?php


?>