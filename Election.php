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


<!DOCTYPE html>
<html>

<head>
    <title> Election page</title>
    <link rel="stylesheet" href="./styles/election.css">
    </link>
</head>

<body>
    <div class="outerbox">
        <div class="nav">
            <img src="./images/logo.png" height="50px" width="50px" />
            <div class="child">
                <a href="./About us.html" id="aboutUs">About us</a>
                <a href="./FirstPage.html" id="firstPage">Home</a>
                <a href="./Voters.php" id="voters">voters</a>
                <a href="./Candidate.php" id="candidates">Candidates</a>
                <a href="./Voting.php" id="voting">Voting</a>
                <a id="logout" onclick="logout()">Logout</a>
            </div>
        </div>
        <div class="middle">

          <?php 
            $select_query = "SELECT * FROM elections ORDER BY id DESC LIMIT 1";
            $result = mysqli_query($conn, $select_query);
            while($row = mysqli_fetch_assoc($result)){
              ?>
                <div class="header">
                    <h2><?php echo $row["name"]; ?></h2>
                      <div><b>Start Date:</b>: <?php echo $row["startDate"]; ?></div>
                      <div><b>End Date:</b>: <?php echo $row["endDate"]; ?></div>
                </div>
          
                <div class="main__body">
                    <div class="card_container">
                        <div class="card">
                            <h3>Total Candidates</h3>
                            <h1><?php echo $totalCandidateCount; ?></h1>
                          </div>
                          <div class="card">
                            <h3>Total Voters</h3>
                            <h1><?php echo $totalVotersCount; ?></h1>
                          </div>
                          <div class="card">
                            <h3>Total Votes</h3>
                            <h1><?php echo $totalVotes; ?></h1>
                          </div>
                    </div>
                    <div class="winnerDetails">
                        <h2>Congratulations!!!</h2>
                        <img src="./Backend/uploads/<?php echo $profile; ?>" height="50%" width="100%" />
                          <div>
                            <b>Name: </b>
                            <span><?php echo $candidateName; ?></span>
                          </div>
                          <div>
                              <b>Address: </b>
                              <span><?php echo $address; ?></span>
                            </div>
                            <div>
                                <b>Contact: </b>
                                <span><?php echo $contact_no; ?></span>
                              </div>
                          <div>
                              <b>Total votes: </b>
                              <span><?php echo $voteCount; ?></span>
                            </div>
                    </div>
                </div>
          <?php } ?>
      
          </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="./scripts/election.js"></script>

</html>