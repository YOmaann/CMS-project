<?php

if(isset($_POST['create_post'])) {
    $post_title = $_POST['post_title'];
    $post_cat = $_POST['post_cat'];
    $post_author = $_POST['post_author'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];

    $post_date = date('d-m-y');
    $post_comment_count = 0;

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    // images

    move_uploaded_file($post_image_temp, "../images/$post_image");
}

?>


<form action="categories.php" method="post" enctype="multipart/form-data">
                             <div class="form-group">
                                 <label for="post_cat">Post Category Id</label>
                                 <input type="text" name="post_cat" class="form-control">
                             </div>
                             <div class="form-group">
                                 <label for="post_author">Post Author</label>
                                 <input type="text" name="post_author" class="form-control">
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