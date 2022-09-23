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
    <title>Dashboard | Analytics</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/dashboard-content.css">
    <link rel="stylesheet" href="../css/dashboard-analytic.css">
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
                    <a href="./analytics.php">Analytics</a>
                    <a href="./listing.php" class="active">Surveys</a>
                    <a href="#">Settings</a>
                    <button onclick="logout()" id="logout">Logout</button>
                </div>
            </div>
            <div class="right-content">
                <div class="dash-top-title">
                    <h2>Lifetime Analytics</h2>
                    <form method="POST">
                        <select name="time" id="time">
                            <option value="now">Lifetime</option>
                        </select>
                    </form>
                </div>
                
                <div class="cards">
                    <div class="card">
                        <?php 
                            $sql = "SELECT * FROM surs WHERE creator = '$userid'";
                            $result = mysqli_query($con, $sql);   
                            $count = mysqli_num_rows($result); 
                        
                            echo "<h1>$count</h1>";
                            echo "<p>Questions</p>";

                        ?>
                    </div>
                    <div class="card">
                    <?php 
                            $sqel = "SELECT * FROM users WHERE id='$userid'";
                            if ($con->query($sqel)->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<h1>".$row['creation_date']."</h1>";
                                    echo "<p>Time Joined</p>";
                                }
                            }

                            $con->close();
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="../js/goto.js"></script>
    <script src="../js/logout.js"></script>
    <script src="../js/checkAuth.js"></script>
</body>
</html>

