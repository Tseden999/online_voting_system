<?php
    include "./backend/DbConnection.php";

    session_start();

    $loginDetails = $_SESSION["loginDetails"];

    $select_query = "SELECT * FROM voters";
    $result = mysqli_query($conn, $select_query);
?>

<html>
<head>
    <title>Voters list</title>
    <link rel="stylesheet" href="./styles/Voters.css" />
</head>

<body>

    <body>
        <div class="outerbox">
         <div class="nav">
            <img src="./images/logo.png" height="50px" width="50px" />
            <div class="child">
               <a href="./FirstPage.html">Home</a>
               <a href="./About us.html" id="child2">About us</a>
               <a href="./voters.php" id="voters">Voters</a>
               <a href="./Candidate.php" id="candidates">Candidates</a>
               <a href="./Voting.php" id="voting">Voting</a>
               <a href="./election.php" id="election">Election</a>
               <a id="logout" onclick="logout()">Logout</a>
               <div id="profile">
                  <img id="profile_img" />
                  <h5 id="username"></h5>
               </div>
            </div>
         </div>
            <div id="title">
                <h2>Voters</h2>
            </div>
            <div class="Voters">
                <?php
                    while($row = mysqli_fetch_assoc($result)) { //to get data from each row
                ?>
                    <div class="box1">
                        <div id="image">
                            <img src="./backend/uploads/<?php echo strlen($row["profile"]) ? $row["profile"] : "users.png"; ?>" height="100%" width="100%" />
                        </div>
                        <div class="content">
                            <span>Name: <?php echo $row["username"]; ?></span><br>
                            <span>Age: <?php echo $row["age"]; ?></span><br>
                            <span>Contact: <?php echo $row["contact_no"]; ?></span><br>
                            <span>Address: <?php echo $row["address"]; ?></span><br>
                            <span>Email: <?php echo $row["email"]; ?></span><br>
                            <?php 
                                if($loginDetails["role"] === "admin"){
                            ?>
                                <button onclick='deleteUser("<?php echo $row["id"]; ?>", "voters")'>Delete</button>
                            <?php } ?>
                            </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        </div>

    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./scripts/firstPage.js"></script>
</html>