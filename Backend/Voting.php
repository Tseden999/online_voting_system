<?php
    include "DbConnection.php";

    $username=$_POST['username'];
    $password=$_POST['password'];
    $candidate_id= $_POST['candidate_id'];

    // get the voter id using username and password
    $query = "SELECT * FROM voters where username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($result)){
        $voter_id = $row["id"];

        // check if the given voter $voter_id already vote or not
        $select_query = "SELECT * FROM candidates";
        $candidate_result = mysqli_query($conn, $select_query);
        while($_row = mysqli_fetch_assoc($candidate_result)){
            $voterID = $_row["voterID"];
            $isVoted = strpos($voterID, $voter_id);
            if($isVoted !== false){
                echo "You have already Voted !!";
                return;
            };
            
        }

        $update_query = "UPDATE candidates SET voterID=CONCAT(voterID, ', $voter_id') WHERE id='$candidate_id'";
        $update_result = mysqli_query($conn, $update_query);

        if($update_result) echo "Voted successfully !";
        else echo $conn->error;

    }

 
?>