<?php

function insert_categories() {
    global $connection;
    if(isset($_POST['submit'])) {

        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title))
        echo "This field should not be empty.";
        else {
            $query = "INSERT INTO categories(cat_title) VALUES ('$cat_title')";
            // echo $query;
            $result  = mysqli_query($connection, $query);
            if(!$result)
            echo "Something went wrong! ".mysqli_error($connection);
            else 
            echo "Record added successfully";
        }
        // echo "HELLO";
    }
}

function update_categories() {
    global $connection;
    if(isset($_POST['update'])) {
        // echo "Hello";
        $the_cat_title = $_POST['edit_cat_title'];
        $the_cat_id = $_POST['edit_cat_id'];
        $query = "UPDATE categories SET cat_title='$the_cat_title' where cat_id=$the_cat_id";
        $result  = mysqli_query($connection, $query);
    
        if($result) echo "Updated values successfully!";
        else echo "Something went wrong! <br>".mysqli_error($connection);
        // header("Location: categories.php");
    }
}

function edit_categories() {
    global $connection, $edit_cat_id;
    if(isset($_GET['edit'])){
        

         $query = "SELECT cat_title FROM categories WHERE cat_id=$edit_cat_id";
         $result = mysqli_query($connection, $query);
         $edit_cat_title = mysqli_fetch_row($result)[0];
         return $edit_cat_title;
         }
}

function display_categories() {
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_categories)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<tr><td>$cat_id</td>";
            echo "<td>$cat_title</td>";
            echo "<td><a href='categories.php?delete=$cat_id'>Delete</a></td>";
            echo "<td><a href='categories.php?edit=$cat_id'>Edit</a></td>";
            echo "</tr>";

        }
}

function delete_categories() {
    global $connection;
    if(isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = $the_cat_id";
        $result  = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}