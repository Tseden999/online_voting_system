<?php
include "DbConnection.php";
    
session_start();

$username= $_POST['username'];
$password= $_POST['password'];
$role=$_POST['role'];

// search if above username and password is exist in database or not
$select_query = "";
if($role === "voters"){
    $select_query = "SELECT * FROM voters WHERE username='$username' AND password='$password'";
}else if($role === "candidates"){
    $select_query = "SELECT * FROM candidates WHERE username='$username' AND password='$password'";
}else{
    $select_query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
}

$result = mysqli_query($conn, $select_query);

if((mysqli_num_rows($result) === 1)){
    // fetching all login user details
    if($role === "voters"){
        $select_query = "SELECT * FROM voters WHERE username='$username' AND password='$password'";
    }else if($role === "candidates"){
        $select_query = "SELECT * FROM candidates WHERE username='$username' AND password='$password'";
    }else{
        $select_query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    }
    $result = mysqli_query($conn, $select_query);
    while($row = mysqli_fetch_assoc($result)){

        $loginDetails = array(
            'username' => $username,
            'password' => $password,
            'role' => $role
        );
        $_SESSION['loginDetails'] = $loginDetails;

        $details = "id=".$row["id"].";username=".$row["username"].";password=".$row["password"].";profile=".$row["profile"].";role=".$role;
        echo "Login successfull !;;".$details;
    }
}else{
    echo "Login Failed !;;";
}

?> 