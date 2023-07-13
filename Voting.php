<?php
    include "./backend/DbConnection.php";

    session_start();

    $loginDetails = $_SESSION["loginDetails"];

    $select_query = "SELECT * FROM candidates";
    $result = mysqli_query($conn, $select_query);
?>

<html>

<head>
    <title>Voting page</title>
    <link rel="stylesheet" href="./styles/Voters.css" />
    </link>
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
               <a id="logout" onclick="logout()">Logout</a>
               <div id="profile">
                  <img id="profile_img" />
                  <h5 id="username"></h5>
               </div>
            </div>
         </div>
            <div id="title">
                <h2>Voting</h2>
            </div>
            <div class="Voters">
            <?php
                while($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="box1">
                    <div id="image">
                        <img src="./images/profilo.png" height="100px" width="100px" />
                    </div>
                    <div class="content">
                        <span>Name: <?php echo $row["username"]; ?></span><br>
                        <span>Age: <?php echo $row["age"]; ?></span><br>
                        <span>Contact: <?php echo $row["contact_no"]; ?></span><br>
                        <span>Address: <?php echo $row["address"]; ?></span><br>
                        <span>Email: <?php echo $row["email"]; ?></span><br>
                        <span>Total Votes: <?php echo strlen(str_replace(", ","",$row["voterID"])); ?></span><br>
                        <?php 
                            if($loginDetails["role"] === "voters"){
                        ?>
                            <button onclick='vote("<?php echo $row["id"]; ?>")'>Vote</button>
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