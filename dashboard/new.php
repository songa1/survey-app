<?php include('../php/connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Add new survey</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/dashboard-content.css">
    <script type="module" src="../js/goto.js"></script>
    <script type="module" src="../js/index.js"></script>
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
                        <h3>Cishahayo Songa Achille</h3>
                        <p title="position-title">Administrator</p>
                    </div>
                </div>
                <div class="menu">
                    <a href="#">Analytics</a>
                    <a href="./listing.php">Surveys</a>
                    <a href="#">Settings</a>
                    <a href="#" id="logout">Logout</a>
                </div>
            </div>
            <div class="right-content">
            
                <form class="cont"  method="POST">
                    <div class="add-form">
                        <input type="text" name="title" placeholder="Enter your title...">
                        <textarea name="question" id="question" cols="30" rows="20" placeholder="Enter your question..." style="border: 0;outline: none;font-size: 20px;"></textarea>
                    </div>
                    <div class="rightbar">
                        <div class="link">
                            <input type="text" name="slug" title="slug" placeholder="ask.public/your_slug">
                        </div>
                        <div class="privacy">
                            <select name="privacy">
                                <option>Public</option>
                                <option>Private</option>
                            </select>
                            <input type="submit" name="addnew" class="btn" value="Publish" />
                        </div>
                    </div>
                </form>
                <?php 

                if (isset($_POST['addnew'])) {
                    $title = $_POST['title'];
                    $body = $_POST['question'];
                    $slug = $_POST['slug'];
                    $privacy = $_POST['privacy'];
                    $today = date('Y-m-d H:i:s');

                    $sqli = "INSERT INTO surs (`survey_title`,`question`, `survey_slug`,`creator`, `creation_date`, `privacy`) VALUES ('$title', '$body', '$slug', '1', '$today', '$privacy')";

                    if ($con->query($sqli) === TRUE) {
                        ?>
                            <script>
                                sMessage();
                            </script>
                        <?php
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }

                    $con->close();
                }
            ?>
            </div>
        </section>
        
    </div>
    
</body>
</html>