<?php
 
 try{
    include "DbConnection.php";

    $name= $_POST['name'];
    $electionType=$_POST['electionType'];
    $startDate=$_POST['startDate'];
    $endDate=$_POST['endDate'];
    
    //empty validation
    if(strlen($name)===0 ||strlen($electionType)===0 ||strlen($startDate)===0 ||strlen($endDate)===0 ){
        echo "Please fill up all the fields!!!";
    }
    
    // insert above data in database
    $insert_query = "INSERT INTO elections( name, electionType, startDate, endDate) VALUES( '$name',' $eType', '$start_date', '$end_date')";

    if($conn->query($insert_query) === TRUE){
        echo "Register election successfull !";
    }else{
        echo "Failed to register election!!";
    }
}

catch (Exception $e){
    echo 'Failed to register election!!! ' .$e->getMessage();
}
 
?>