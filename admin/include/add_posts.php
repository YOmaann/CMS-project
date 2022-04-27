<?php

if(isset($_POST['create_post'])) {
    $post_title = $_POST['post_title'];
    $post_cat = $_POST['post_cat'];
    $post_author = $_POST['post_author'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_status = $_POST['post_status'];

    $post_date = date('d-m-y');
    $post_comment_count = 0;

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    // images

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status)";
    $query .= "VALUES('$post_cat', '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', '$post_comment_count', '$post_status')";

    $result = mysqli_query($connection, $query);
    if($result) echo "Post added!";
    else echo mysqli_error($connection);
}

?>


<form action="posts.php?source=add_post" method="post" enctype="multipart/form-data">
                             <div class="form-group">
                                 <label for="post_cat">Post Category Id</label>
                                 <input type="text" name="post_cat" class="form-control">
                             </div>
                             <div class="form-group">
                                 <label for="post_author">Post Author</label>
                                 <input type="text" name="post_author" class="form-control">
                             </div>
                             <div class="form-group">
                                 <label for="post_title">Post Title</label>
                                 <input type="text" name="post_title" class="form-control">
                             </div>
                             <div class="form-group">
                                 <label for="post_status">Post Status</label>
                                 <input type="text" name="post_status" class="form-control">
                             </div>
                             <div class="form-group">
                                 <label for="post_image">Post image</label>
                                 <input type="file" name="post_image" class="form-control">
                             </div>
                             <div class="form-group">
                                 <label for="post_tags">Post Tags</label>
                                 <input type="text" name="post_tags" class="form-control">
                             </div>
                             <div class="form-group">
                                 <label for="post_content">Post Content</label>
                                 <textarea name="post_content" id=""  rows="10" class="form-control"></textarea>
                             </div>
                             <div class="form-group">
                                 <input class="btn btn-primary" type="submit" name="create_post" value="Add Post">
                             </div>
                         </form>