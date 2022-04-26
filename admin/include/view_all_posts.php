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
                while($row = mysqli_fetch_row($posts)) {
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
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>