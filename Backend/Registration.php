<?php
 
 try{
    include "DbConnection.php";

    $name= $_POST['username'];
    $age=$_POST['age'];
    $address=$_POST['address'];
    $contact=$_POST['contact_no'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $role=$_POST['role'];

    //empty validation
    if(strlen($name)===0 ||strlen($age)===0 ||strlen($address)===0 ||strlen($contact)===0 ||strlen($email)===0 ||strlen($password)===0 ||strlen($role)===0 ){
        echo "Please fill up all the fields!!!";
    }
    else {
        $targetDir = "./uploads/";
    $targetFile = $targetDir . basename($_FILES["profile"]["name"]);

    if (move_uploaded_file($_FILES["profile"]["tmp_name"], $targetFile)) {

        // Insert the file details into the database
        $fileName = basename($_FILES["profile"]["name"]);
        
        // insert above data in database
        $insert_query = "";
        if($role === "voters"){
            $alreadyExists = mysqli_query($conn, "SELECT * FROM voters WHERE email='$email'");
            if($alreadyExists->num_rows > 0) echo "Voter already exists !";
            else {
                $insert_query = "INSERT INTO voters( username, email, password, contact_no, age, address, profile) VALUES( '$name',' $email', '$password', '$contact', '$age','$address','$fileName')";
                if($conn->query($insert_query) === TRUE){
                    echo "Register successfull !";
                }else{
                    echo "Failed to register !!";
                }
            }
        }else if($role === "candidates"){
            $alreadyExists = mysqli_query($conn, "SELECT * FROM candidates WHERE email='$email'");
            if($alreadyExists->num_rows > 0) echo "Candidate already exists !";
            else {
                $insert_query = "INSERT INTO candidates( username, email, password, contact_no, age, address, profile) VALUES( '$name',' $email', '$password', '$contact', '$age','$address','$fileName')";
                if($conn->query($insert_query) === TRUE){
                    echo "Register successfull !";
                }else{
                    echo "Failed to register !!";
                }
            }
        }else{
            $alreadyExists = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email'");
            if($alreadyExists->num_rows > 0) echo "Admin already exists !";
            else {
                $insert_query = "INSERT INTO admin( username, email, password, contact_no, age, address, profile) VALUES( '$name',' $email', '$password', '$contact', '$age','$address','$fileName')";
                if($conn->query($insert_query) === TRUE){
                    echo "Register successfull !";
                }else{
                    echo "Failed to register !!";
                }
            }
        }
    } else {
        // Error uploading the file
        echo "Error uploading the file.";
    }
    } 
}

catch (Exception $e){
    echo 'Failed to register!!! ' .$e->getMessage();
}
 
?>