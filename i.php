<?php include('php/connect.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey App</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <div class="user-page">
        <header>
            <?php
                $slug = $_GET['id'];

                $sqla = "SELECT * FROM surs WHERE survey_slug='$slug'";
                $result = $con->query($sqla);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                      ?>
                        <h2 class="title"><?php echo $row['survey_title']; ?></h2>
                        <p class="subtitle"><?php echo $row['question']; ?></p>
                      <?php
                    }
                } else {
                    echo "0 results";
                }
                $con->close();
            ?>
            
        </header>
        <main>
            <div class="input-field">
                <label>Email</label>
                <input type="email" />
            </div>
            <div class="input-submit">
                <button>Submit</button>
            </div>
        </main>
    </div>
</body>
</html>