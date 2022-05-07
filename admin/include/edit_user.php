<?php

// if(isset($_GET['p_id'])) {

// }
if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];


    // update post

    if(isset($_POST['update_user'])) {
    // echo "hello";

    // $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];
    $user_password = $_POST['user_password'];

    $query = "UPDATE users set user_name='$user_name', user_firstname='$user_firstname', user_lastname='$user_lastname', user_email='$user_email', user_role='$user_role'";
    
    if($user_password != "") {

    // $querySalt = "SELECT randSalt from users where user_id=$user_id";
    // $select_randsalt = mysqli_query($connection, $querySalt);
    // $row  = mysqli_fetch_array($select_randsalt);
    // $salt = $row['randSalt'];

    // $user_password = crypt($user_password, $salt);


    $user_password = password_hash($user_password, PASSWORD_BCRYPT, ["cost" => 10]);
    $query .= ", user_password='$user_password' ";
    }

        // $post_date = date('d-m-y');
    // $post_comment_count = 0;

    $query.= "where user_id=$user_id";
    // $query = "UPDATE posts set post_category_id=$post_cat, post_title='$post_title', post_author='$post_author', post_content='$post_content', user_role='$post_content', post_status='$post_status', post_image='$post_image', post_date=now() where post_id=$p_id";
    // $query .= "VALUES('$post_cat', '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', '$post_comment_count', '$post_status')";

    $result = mysqli_query($connection, $query);
    if($result) echo "User updated!";
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

    $query = "Select * from users where user_id=$user_id";
    $users = mysqli_query($connection, $query);
    $r = mysqli_fetch_assoc($users);
            // $row = [];
            $user_name = $r['user_name'];
            $user_firstname = $r['user_firstname'];
            $user_lastname = $r['user_lastname'];
            $user_email = $r['user_email'];
            $user_role = $r['user_role'];
            $user_password = $r['user_password'];
}



?>


<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
                                 <label for="user_firstname">First Name</label>
                                 <input type="text" name="user_firstname" class="form-control" id="user_firstname" value="<?= $user_firstname ?>">
                             </div>
                             <div class="form-group">
                                 <label for="user_lastname">User Lastname</label>
                                 <input type="text" name="user_lastname" class="form-control" id="user_lastname" value="<?= $user_lastname ?>">
                             </div>
                             <div class="form-group">
                                 <label for="user_name">User Name</label>
                                 <input type="text" name="user_name" class="form-control" id="user_name" value="<?= $user_name ?>">
                             </div>
                             <div class="form-group">
                                 <label for="user_password">User Password</label>
                                 <input type="password" name="user_password" class="form-control" id="user_password" value="">
                             </div>
                             <div class="form-group">
                                 <label for="user_email">Email</label>
                                 <input type="email" name="user_email" class="form-control" id="user_email"  value="<?= $user_email ?>">
                             </div>
                             <div class="form-group">
                                 <label for="user_role">Role</label>
                                 <select name="user_role" id="user_role" class="form-control">
                                     <option value="admin" <?= (($user_role=="admin")?"selected":"") ?>>Admin</option>
                                     <option value="subscriber" <?= (($user_role=="subscriber")?"selected":"") ?>>Subscriber</option>

                                     <?php

                                    //  $query = "select * from categories";
                                    //  $result = mysqli_query($connection, $query);
                                    //  while($row1 = mysqli_fetch_assoc($result)) {
                                    //      $cat_id = $row1['cat_id'];
                                    //      $cat_title = $row1['cat_title'];
                                    //      echo "<option value=$cat_id ".(($row[3]==$cat_id)?"selected":"").">$cat_title</option>";
                                    //  }


?>
                                 </select>
                                 <!-- <input type="text" name="post_cat" class="form-control" value=""> -->
                             </div>

                             <!-- <div class="form-group">
                                 <label for="post_image">Post image</label>
                                 <input type="file" name="post_image" class="form-control">
                             </div> -->
                             <!-- <div class="form-group">
                                 <label for="post_tags">Post Tags</label>
                                 <input type="text" name="post_tags" class="form-control">
                             </div> -->
                             <div class="form-group">
                                 <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
                             </div>
         
</form>

<?php


?>