<?php 
    include('./connect.php');
    $qid = $_GET['id'];
    echo $qid;
    $delete_query = "DELETE FROM surs WHERE id='$qid'";
    if ($con->query($delete_query) === TRUE) {
        echo "<script>alert('Question deleted! Click OK to continue.')</script>";
        echo "<script>window.location.href = '../dashboard/listing.php';</script>";
    } else {
        echo "<script>alert('Error deleting record: " . $con->error. "</script>";
    }
?>