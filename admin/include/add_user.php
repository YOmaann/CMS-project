<?php

if(isset($_POST['create_user'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_name = $_POST['user_name'];
    $user_pass = $_POST['user_password'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];

    $query = "SELECT randSalt from users";
    $select_randsalt = mysqli_query($connection, $query);

    $row  = mysqli_fetch_array($select_randsalt);

    $salt = $row['randSalt'];

    $user_pass = crypt($user_pass, $salt);

    // $post_date = date('d-m-y');
    // $post_comment_count = 0;

    // $post_image = $_FILES['post_image']['name'];
    // $post_image_temp = $_FILES['post_image']['tmp_name'];

    // // images

    // move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO users(user_name, user_firstname, user_lastname, user_password, user_email, user_role) ";
    $query .= "VALUES('$user_name', '$user_firstname', '$user_lastname', '$user_pass', '$user_email', '$user_role')";

    $result = mysqli_query($connection, $query);
    if($result) echo "User added!";
    else echo mysqli_error($connection);
}

?>


<form action="users.php?source=add_user" method="post" enctype="multipart/form-data">


                             <div class="form-group">
                                 <label for="user_firstname">First Name</label>
                                 <input type="text" name="user_firstname" class="form-control" id="user_firstname">
                             </div>
                             <div class="form-group">
                                 <label for="user_lastname">User Lastname</label>
                                 <input type="text" name="user_lastname" class="form-control" id="user_lastname">
                             </div>
                             <div class="form-group">
                                 <label for="user_name">User Name</label>
                                 <input type="text" name="user_name" class="form-control" id="user_name">
                             </div>
                             <div class="form-group">
                                 <label for="user_password">User Password</label>
                                 <input type="password" name="user_password" class="form-control" id="user_password">
                             </div>
                             <div class="form-group">
                                 <label for="user_email">Email</label>
                                 <input type="email" name="user_email" class="form-control" id="user_email">
                             </div>
                             <div class="form-group">
                                 <label for="user_role">Role</label>
                                 <select name="user_role" id="user_role" class="form-control">
                                     <option value="admin">Admin</option>
                                     <option value="subscriber">Subscriber</option>

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
                                 <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
                             </div>
                         </form>