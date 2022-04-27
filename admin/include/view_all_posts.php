<table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Author</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Tags</th>
                                        <th>Comments</th>
                                        <th>Date</th>
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
?>
                                    <tr>
                                        <td><?= $row[0] ?></td>
                                        <td><?= $row[1] ?></td>
                                        <td><?= $row[2] ?></td>
                                        <td><?= $row[3] ?></td>
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