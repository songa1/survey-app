<?php include('php/connect.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Answer a question</title>
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
                        $surv_id = $row['id'];
                      ?>
                        <h2 class="title"><?php echo $row['survey_title']; ?></h2>
                        <p class="subtitle"><?php echo $row['question']; ?></p>
                      <?php
                    }
                } else {
                    echo "0 results";
                }
            ?>
            
        </header>
        <form method="POST">
            <div class="input-field">
                <label>Enter your answer</label>
                <textarea name="answer"></textarea>
            </div>
            <div class="input-submit">
                <input type="submit" name="answer_btn" class="btn" valure="Submit"/>
            </div>
        </form>
        <?php
            if(isset($_POST['answer_btn'])){
                $ans = $_POST['answer'];
                $today = date('Y-m-d H:i:s');

                $sqlo = "INSERT INTO answer (`answer`, `creation_date`, `question_answered`) VALUES  ('$ans', '$today', '$surv_id')";

                if($con->query($sqlo) === TRUE){
                    echo "<script>window.location.href = './success.html';</script>";
                }else {
                    echo "<script>alert('Failed. Try again!');</script>";
                }

                $con->close();
            }
        ?>
    </div>
</body>
</html>