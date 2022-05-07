<?php

session_start();
ob_start(); // stores the output in a buffer before sending to the client.
include "../include/db.php";
// include "functions.php";


// if(isset($_SESSION['user_role'])) {
//     // if($_SESSION['user_role'] !== "admin")
//     // header("Location: ../index.php");
// }
// else {
//     header("Location: ../index.php");
// }

if(!isset($_SESSION['username'])){
    header("Location: ../index.php");
}

// $query = "select * from posts where post_status='published'";
// $result = mysqli_query($connection, $query);
$posts_published_count = getCount("posts", "where post_status='published'");

// $query = "select * from posts";
// $result = mysqli_query($connection, $query);
$posts_count = getCount("posts");


// $query = "select * from posts where post_status='draft'";
// $result = mysqli_query($connection, $query);
$posts_draft_count = getCount("posts", "where post_status='draft'");

// $query = "select * from comments where comment_status='approved'";
// $result = mysqli_query($connection, $query);
$comments_count = getCount("comments", "where comment_status='approved'");

// $query = "select * from comments where comment_status='unapproved'";
// $result = mysqli_query($connection, $query);
$comments_pending_count = getCount("comments", "where comment_status='unapproved'");

// $query = "select * from users";
// $result = mysqli_query($connection, $query);
$users_count = getCount("users");

// $query = "select * from users where user_role='admin'";
// $result = mysqli_query($connection, $query);
$users_admin_count = getCount("users", "where user_role='admin'");

// $query = "select * from users where user_role='subscriber'";
// $result = mysqli_query($connection, $query);
$users_subscriber_count = getCount("users", "where user_role='subscriber'");

// $query = "select * from categories";
// $result = mysqli_query($connection, $query);
$categories_count = getCount("categories");

$session = session_id();
$time = time();
// $time_out_in_seconds = 60;

// $time_out = $time + $time_out_in_seconds;

// $_SESSION['timeout'] = $time_out;

$query = "SELECT * FROM users_online WHERE session = '$session'";
$result = mysqli_query($connection, $query);
$count = mysqli_num_rows($result);

if($count == 0) {
    mysqli_query($connection, "INSERT INTO users_online(session, time) values('$session', '$time') ");
}
else {
    mysqli_query($connection, "UPDATE users_online SET time='$time' WHERE session='$session'");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CMS Admin</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Type", "Count", { role: "style" } ],
        ["Published Posts", <?= $posts_published_count ?>, "blue"],
        ["Drafts", <?= $posts_draft_count ?>, "silver"],
        ["Comments", <?= $comments_count ?>, "blue"],
        ["Pending Comments", <?= $comments_pending_count ?>, "silver"],
        ["Admins", <?= $users_admin_count ?>, "blue"],
        ["Subscribers", <?= $users_subscriber_count ?>, "silver"],
        ["Categories", <?= $categories_count ?>, "blue"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "style" },
                       2]);

      var options = {
        title: "Statistics",
        width: 0,
        height: 500,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>

<!-- <script src="https://code.jquery.com/jquery-3.2.0.min.js"></script> -->


    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> -->
<script src="https://code.jquery.com/jquery-3.2.0.min.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.2/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.2/dist/summernote.min.js"></script> -->
    <!-- <link rel="stylesheet" href="./css/summernote.min.css" />
    <script type="text/javascript" src="./js/summernote.min.js"></script> -->
    <script src="./js/script.js"></script>
</head>

<body>

    <div id="wrapper">
