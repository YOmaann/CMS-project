
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                <!-- <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> My Data</a>
                    </li> -->
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts"><i class="fa fa-fw fa-arrows-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts" class="collapse">
                            <li>
                                <a href="posts.php">View all Posts</a>
                            </li>
                            <li>
                                <a href="posts.php?source=add_post">Add Posts</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="categories.php"><i class="fa fa-fw fa-wrench"></i> Categories</a>
                    </li>
                    <!-- <li class="active"> -->
                        <li>
                        <a href="comments.php"><i class="fa fa-fw fa-file"></i>Comments</a>
                    </li>
                    <!-- <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#categories"><i class="fa fa-fw fa-arrows-v"></i> Categories <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="categories" class="collapse">
                            <li>
                                <a href="#">Comments</a>
                            </li>
                            <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#users"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="users" class="collapse">
                            <li>
                                <a href="#">Comments</a>
                            </li>
                            <li>
                                <a href="#">Users</a>
                            </li>
                        </ul>
                    </li>
                        </ul>
                    </li> -->

<!--                     
                    <li>
                        <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
                    </li> -->
                    <?php
                    if(is_admin($_SESSION['username'])){
                        ?>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#users"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="users" class="collapse">
                            <li>
                                <a href="users.php">View all Users</a>
                            </li>
                            <li>
                                <a href="users.php?source=add_user">Add Users</a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    <!-- <li>
                        <a href="profile.php"><i class="fa fa-fw fa-dashboard"></i> Profile</a>
                    </li> -->
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </nav>