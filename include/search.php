<?php

if(isset($_REQUEST['search'])) {
    $search = $_REQUEST["search"];
    $query = "SELECT * from posts where post_tags like '%$search%'";
    $search_query = mysqli_query($connection, $query);
    if(!$search_query) {
        die("Search Failed !".mysqli_error($connection));
        
    }
    $count = mysqli_num_rows($search_query);
    if($count == 0 ) {
        echo "<h1>NO RESULTS</h1>";
    } else {
        echo "SOME RESULT";
    }
}


?>