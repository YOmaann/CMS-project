<table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Author</th>
                                        <th>Comment</th>
                                        <th>E-mail</th>
                                        <th>Status</th>
                                        <th>In Response to</th>
                                        <th>Date</th> 
                                     <th>Approve</th>
                                        <th>Unapprove</th>
                                        <!-- <th>Edit</th> -->
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                $query = "Select * from comments";
                if(isset($_GET['p_id'])) {
                    $post_id = $_GET['p_id'];
                    $query .= " where comment_post_id=$post_id";
                }
                $posts = mysqli_query($connection, $query);
                while($r = mysqli_fetch_assoc($posts)) {

                    $query = "select * from posts where post_id=".$r['comment_post_id'];
                    $result  = mysqli_query($connection, $query);

                    $postArr = mysqli_fetch_row($result);
                    $post = $postArr[2];
                    $post_id = $postArr[0];

?>
                                    <tr>
                                        <td><?= $r['comment_id'] ?></td>
                                        <td><?= $r['comment_author'] ?></td>
                                        <td><?= $r['comment_content'] ?></td>
                                        <td><?= $r['comment_email'] ?></td>
                                        <td><?= $r['comment_status'] ?></td>
                                        <!-- <td><img width="100" src="../images/"></td> -->
                                        <td><a href="../post.php?p_id=<?= $post_id ?>"><?= $post ?></a></td>
                                        <td><?= $r['comment_date'] ?></td>
                                        <!-- <td></td> -->
                                        <td><a href="comments.php?approve=<?= $r['comment_id'] ?>">Approve</a></td>
                                        <td><a href="comments.php?unapprove=<?= $r['comment_id'] ?>">Unapprove</a></td>
                                        <!-- <td><a href="comments.php?source=edit_comment&p_id=<?= $r['comment_id'] ?>">Edit</a></td> -->
                                        <td><a href="comments.php?delete=<?= $r['comment_id'] ?>&p_id=<?= $post_id ?>">Delete</a></td>

                                        
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <?php
if(isset($_GET['delete'])) {
    $the_comment_id = $_GET['delete'];
    $the_post_id = $_GET['p_id'];

    $query = "DELETE FROM comments WHERE comment_id = $the_comment_id";
    $result = mysqli_query($connection, $query);

    // if($result) echo "Successfully deleted the comment.";
    // else echo "Something went wrong while deleting the comment.";

    $query = "UPDATE posts set post_comment_count=post_comment_count-1 where post_id=$the_post_id";
    $result = $result & mysqli_query($connection, $query);

    if($result) echo "Successfully deleted the comment!";
    else echo "Something went wrong ".mysqli_error($connection);

    header("Location: comments.php?p_id=$the_post_id");

}
if(isset($_GET['approve'])) {
    $the_comment_id = $_GET['approve'];

    $query = "UPDATE comments SET comment_status='approved' WHERE comment_id = $the_comment_id";
    $result = mysqli_query($connection, $query);

    if($result) echo "Successfully approved the comment.";
    else echo "Something went wrong while approving the comment.";
    header("Location: comments.php");

}
if(isset($_GET['unapprove'])) {
    $the_comment_id = $_GET['unapprove'];

    $query = "UPDATE comments SET comment_status='unapproved' WHERE comment_id = $the_comment_id";
    $result = mysqli_query($connection, $query);

    if($result) echo "Successfully unapproved the comment.";
    else echo "Something went wrong while unapproving the comment.";
    header("Location: comments.php");

}


?>