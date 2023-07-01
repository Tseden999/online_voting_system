<?php
    include "DbConnection.php";

    $userId=$_POST['userId'];
    $table_name=$_POST['table_name'];

    // get the voter id using username and password
    $query = "";

    if($table_name === "voters") $query = "DELETE FROM voters WHERE id='$userId'";
    else if($table_name === "candidates") $query = "DELETE FROM candidates WHERE id='$userId'";

    $result = mysqli_query($conn, $query);

    if($result) echo $table_name." deleted successfully !";
    else echo "Failed to delete ".$table_name;
?>