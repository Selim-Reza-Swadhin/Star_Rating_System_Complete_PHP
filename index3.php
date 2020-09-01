<?php
$mysqli = new mysqli('localhost', 'root', '', 'star_rating_system_complete');
//$conn = mysqli_connect('localhost', 'root', '', 'star_rating_system_complete');

if (isset($_POST['rating_hidden_button'])) {
    //var_dump($_POST);
    //die('end file');

    $email = $_POST['email'];
    $rating = $_POST['rating_hidden_button'];
    $feedback = $_POST['feedback'];

    $query = "insert into  rating_feedback(rating, feedback, email)VALUES (?,?,?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('iss', $rating, $feedback, $email);
    $stmt->execute();
    $msg = "<div class='alert alert-success'>Successfully Added Rating.</div>";
    $stmt->close();

//    $query = "insert into  rating_feedback(rating, feedback, email)VALUES ('$rating','$feedback','$email')";
//    mysqli_query($conn, $query);
//    $msg = "<div class='alert alert-success'>Successfully Added Rating.</div>";
//    mysqli_close($conn);
}

function getAverageRating(){
global $mysqli;

$query = "select avg(rating) as avg from rating_feedback";
$stmt = $mysqli->prepare($query);
$run = $stmt->execute();
if (isset($run)) {
$result = $stmt->get_result();
if ($result->num_rows > 0){
$row = $result->fetch_assoc();
return $row['avg'];
}
}
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Star Rating System With Php, mysql, Jquery</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="v2.3.2/jquery.rateyo.css">
    <script src="v2.3.2/jquery.min.js"></script>

</head>
<body class="bg-info">
<div class="container">
    <div class="row">
        <div class="com-md-6 col-md-offset-3">
            <br><br>
            <h2>Rate This Product</h2>
            <br>
            <?php if (isset($msg)) {
                echo $msg;
            }; ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="rateYo1">Rating</label>
                    <div id="rateYo1"></div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="">Feedback</label>
                    <input type="text" class="form-control" name="feedback" id="">
                    <br>
                    <input type="text" class="form-control" name="rating_hidden_button" id="ratingg"
                           placeholder="hidden button rating number">
                </div>
                <button class="btn btn-primary">Submit</button>
            </form>

            <hr class="bg-primary">
            <h2>Users Feedback</h2>
            <div id="rateYo1"></div>
            <hr>
<!--            <?//= getAverageRating(); ?>-->

            <br><br>
            <?php
            $query = "select * from rating_feedback order by id desc";
            $stmt = $mysqli->prepare($query);
            $run = $stmt->execute();
            if (isset($run)) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <!--            echo $row['email'].'<br>'.$row['rating'].'<br>'.$row['feedback'].'<br>';-->
                        <div class="media">
                            <div class="media-left">
                                <a href="">
                                    <img class="media-object" style="width: 50px;height: 55px;" src="images/blog-man4.png"
                                         alt="no image">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <div class="rateYo-<?= $row["id"]; ?>"></div>
                                </h4>
                                <script>
                                    $(function () {
                                        $('.rateYo-<?= $row["id"]; ?>').rateYo({
                                            readOnly: true,
                                            rating: <?= $row["rating"]; ?>
                                        });
                                    });
                                </script>
                                <?= $row['feedback']; ?> <br>
                                By : <a href=""><?= $row['email']; ?></a>
                            </div>
                        </div>
                    <?php }
                }
            } ?>
            <br><br>

        </div>
    </div>
</div>


<script src="js/bootstrap.min.js"></script>
<script src="v2.3.2/jquery.rateyo.min.js"></script>
<script>
    $(function () {
        $('#rateYo1').rateYo({
            // starWidth : "40px"
            fullStar: true,
            onSet: function (rating, rateYoInstance) {
                // alert(rating);
                $('#ratingg').val(rating);
            }
        });
        // Average setting point or id star

        $("#aavgrating").rateYo({
         readOnly:true,
            //rating: '<?php //echo getAverageRating(); ?>';
        });
    });
    /*    $(function () {

            $("#rateYo1").rateYo({
                fullStar: true,
                onSet: function () {

                    alert('rating');
                }
            });

        });*/
</script>
</body>
</html>
