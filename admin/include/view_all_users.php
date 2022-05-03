<table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Username</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th colspan="4" class="text-center">Actions</th>
                                        <!-- <th>Date</th>  -->
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                $query = "Select * from users";
                $posts = mysqli_query($connection, $query);
                while($r = mysqli_fetch_assoc($posts)) {

                    // $query = "select * from posts where post_id=".$r['comment_post_id'];
                    // $result  = mysqli_query($connection, $query);

                    // $postArr = mysqli_fetch_row($result);
                    // $post = $postArr[2];
                    // $post_id = $postArr[0];

?>
                                    <tr>
                                        <td><?= $r['user_id'] ?></td>
                                        <td><?= $r['user_name'] ?></td>
                                        <td><?= $r['user_firstname'] ?></td>
                                        <td><?= $r['user_lastname'] ?></td>
                                        <td><?= $r['user_email'] ?></td>
                                        <td><?= $r['user_role'] ?></td>
                                        <!-- <td></td> -->
                                        <!-- <td><img width="100" src="../images/"></td> -->
                                        <!-- <td><a href="../post.php?p_id="></a></td> -->
                                        <!-- <td></td> -->
                                        <!-- <td></td> -->
                                        <td><a href="users.php?change_to_admin=<?= $r['user_id'] ?>">Admin</a></td>
                                        <td><a href="users.php?change_to_subscriber=<?= $r['user_id'] ?>">Subscriber</a></td>
                                        <td><a href="users.php?source=edit_user&user_id=<?= $r['user_id'] ?>">Edit</a></td>
                                        <td><a href="users.php?delete=<?= $r['user_id'] ?>">Delete</a></td>

                                        
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <?php
if(isset($_GET['delete'])) {
    $the_user_id = $_GET['delete'];
    // $the_post_id = $_GET['p_id'];

    $query = "DELETE FROM users WHERE user_id = $the_user_id";
    $result = mysqli_query($connection, $query);

    // if($result) echo "Successfully deleted the comment.";
    // else echo "Something went wrong while deleting the comment.";

    if($result) echo "Successfully deleted the user!";
    else echo "Something went wrong ".mysqli_error($connection);

    header("Location: users.php");

}
if(isset($_GET['change_to_admin'])) {
    $the_user_id = $_GET['change_to_admin'];

    $query = "UPDATE users SET user_role='admin' WHERE user_id = $the_user_id";
    $result = mysqli_query($connection, $query);

    if($result) echo "Successfully changed to subscriber.";
    else echo "Something went wrong while approving the comment.";
    header("Location: users.php");

}
if(isset($_GET['change_to_subscriber'])) {
    $the_user_id = $_GET['change_to_subscriber'];

    $query = "UPDATE users SET user_role='subscriber' WHERE user_id = $the_user_id";
    $result = mysqli_query($connection, $query);

    if($result) echo "Successfully changed to subscriber.";
    else echo "Something went wrong while approving the comment.";
    header("Location: users.php");

}

?>