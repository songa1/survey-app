<?php 
$cookie = "name";
$cookietwo = "id";
include('../php/connect.php'); 
$username = $_COOKIE[$cookie];
$userid = $_COOKIE[$cookietwo];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | List of surveys</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/dashboard-content.css">
</head>
<body>
    <div class="dashboard-container">
        <section class="dash-topnav">
            <h2 class="dash-logo">AskPublic</h2>
            <div class="right-actions">
                <button>Notifications</button>
                <button onclick="gotoNew()">Add New +</button>
            </div>
        </section>
        <section class="main-body">
            <div class="left-menu">
                <div class="profile">
                    <img src="../assets/logo/ask public.png" alt="Cishahayo Songa Achille">
                    <div class="metadata">
                        <h3><?php echo $username ?></h3>
                        <p title="position-title">Administrator</p>
                    </div>
                </div>
                <div class="menu">
                    <a href="#">Analytics</a>
                    <a href="./listing.php" class="active">Surveys</a>
                    <a href="#">Settings</a>
                    <button onclick="logout()" id="logout">Logout</button>
                </div>
            </div>
            <div class="right-content">
                <div class="dash-top-title">
                    <h2>List of all surveys you created</h2>
                    <input type="text" placeholder="Search...">
                </div>
                
                <div class="surveys">
                    <?php 
                        $sql = "SELECT * FROM surs WHERE creator='$userid'";

                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {
                            
                            while($row = $result->fetch_assoc()) {
                                $qid = $row['id'];
                                
                    ?>
                    <div class="survey">
                        <img src="../assets/survey-results-analysis.jpg" alt="User">
                        <div class="mdata">
                            <a href="../i.php?id=<?php echo $row['survey_slug'] ?>"><?php echo $row["survey_title"] ?></a>
                            <p>Created on <?php echo $row["creation_date"] ?></p>
                            <div class="actions" style="display: flex;align-items: center;">
                                <a style="font-size: xx-small; color: green; padding: 5px;" href="answers.php?question=<?php echo $row['id']; ?>">Answers</a>
                                    <a style="font-size: xx-small; color: red; padding: 5px; cursor: pointer;" href="../php/delete.php?id=<?php echo $row['id'] ?>">Delete</a>
                            </div>
                        </div>
                    </div>
                    
                    <?php
                        }
                    } else {
                      echo "<h1>There are no questions at the moment!</h1>";
                    }

                    $con->close();

                    ?>
                </div>
            </div>
        </section>
    </div>
    <script src="../js/goto.js"></script>
    <script src="../js/logout.js"></script>
    <script src="../js/checkAuth.js"></script>
</body>
</html>