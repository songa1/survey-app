<?php 
$cookie = "name";
$cookietwo = "id";
include('../php/connect.php'); 
$username = $_COOKIE[$cookie];
$userid = $_COOKIE[$cookietwo];
$question_ans = $_GET['question'];

$sql = "SELECT * FROM surs WHERE id='$question_ans'";

$result = $con->query($sql);



if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        setcookie('question', $row['question'] ? $row['question'] : "No Question Added!", time() + (86400 * 30), "/");
    }
}

$question_title = $_COOKIE['question'];

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
                    <h2>Answers to <?php echo "<i>'$question_title'</i>"; ?></h2>
                    <input type="text" placeholder="Search...">
                </div>
                
                <div class="surveys">
                    <?php 
                        
                        $sql = "SELECT * FROM answer WHERE question_answered='$question_ans'";

                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                    ?>
                    <div class="survey">
                        <div class="mdata">
                            <a><?php echo $row["answer"] ?></a>
                            <p>Created on <?php echo $row["creation_date"] ?></p>
                            
                        </div>
                    </div>
                    
                    <?php
                        }
                    } else {
                      echo "<h1>There are no answers at the moment!</h1>";
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

