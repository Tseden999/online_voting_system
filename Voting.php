<?php
    include "./backend/DbConnection.php";

    session_start();

    $loginDetails = $_SESSION["loginDetails"];


        // Count the total number of candidate in the table
        $totalCandidateQuery = "SELECT COUNT(*) AS total_rows FROM candidates";
        $result = mysqli_query($conn, $totalCandidateQuery);
        $row = $result->fetch_assoc();
        $totalCandidateCount = $row['total_rows'];
    
        // Count the total number of voters in the table
        $totalVoterQuery = "SELECT COUNT(*) AS total_rows FROM voters";
        $result = mysqli_query($conn, $totalVoterQuery);
        $row = $result->fetch_assoc();
        $totalVotersCount = $row['total_rows'];
    
    
        // Find the candidate with the highest voter ID
        $sql = "SELECT * FROM candidates ORDER BY LENGTH(voterID) - LENGTH(REPLACE(voterID, ',', '')) DESC LIMIT 1";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $candidateName = $row['username'];
            $address = $row['address'];
            $contact_no = $row['contact_no'];
            $profile = $row['profile'];
            $candidateId = $row['id'];
            $voterIDs = $row['voterID'];
    
            // Count the number of votes
            $voteCount = substr_count($voterIDs, ', ');
        } else {
            echo "No records found.";
        }
    
    
        // Calculate total votes
        $sql = "SELECT voterID FROM candidates";
        $result = $conn->query($sql);
    
        $totalVotes = 0;
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $voterIds = explode(',', $row['voterID']);
    
                foreach ($voterIds as $voterId) {
                    if (trim($voterId) !== "") {
                        $totalVotes++;
                    }
                }
            }
        }    
?>

<html>

<head>
    <title>Voting page</title>
    <link rel="stylesheet" href="./styles/Voters.css" />
    </link>
</head>

    <body>
        <div class="outerbox">
         <div class="nav">
            <img src="./images/logo.png" height="50px" width="50px" />
            <div class="child">
               <a href="./FirstPage.html">Home</a>
               <a href="./About us.html" id="child2">About us</a>
               <a href="./voters.php" id="voters">Voters</a>
               <a href="./Candidate.php" id="candidates">Candidates</a>
               <a href="./election.php" id="election">Election</a>
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

            <?php 
                $select_query = "SELECT * FROM elections ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($conn, $select_query);
                while($row = mysqli_fetch_assoc($result)){
              ?>
                <div class="header">
                    <div class="electionTitle">
                        <h3>Election: <?php echo $row["name"]; ?></h2>
                        <h3 >Election Type: <?php echo $row["electionType"]; ?></h2>
                    </div>
                    <div class="electionTitle">
                        <div><b>Start Date:</b>: <?php echo $row["startDate"]; ?></div>
                        <div><b>End Date:</b>: <?php echo $row["endDate"]; ?></div>
                    </div>
                </div>
            <?php } ?>

            <div class="Voters">
            <?php
                $select_query = "SELECT * FROM candidates";
                $result = mysqli_query($conn, $select_query);
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