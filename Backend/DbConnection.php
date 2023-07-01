<?php
    $conn= new mysqli("localhost","root","","onlinevotingsystem");
    
    //checking database connection error
    if($conn->connect_error){
        die ("Database connection failed: ".$conn->connect_error);
    } 
?>