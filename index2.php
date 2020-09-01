<?php
$mysqli = new mysqli('localhost', 'root', '', 'star_rating_system_complete');
//$conn = mysqli_connect('localhost', 'root', '', 'star_rating_system_complete');

if (isset($_POST['rating_hidden_button'])){
    //var_dump($_POST);
    //die('end file');

    $email = $_POST['email'];
    $rating = $_POST['rating_hidden_button'];
    $feedback = $_POST['feedback'];

    $query = "insert into  rating_feedback(rating, feedback, email)VALUES (?,?,?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('iss',$rating,$feedback,$email);
    $stmt->execute();
    $msg = "<div class='alert alert-success'>Successfully Added Rating.</div>";
    $stmt->close();
    $mysqli->close();

//    $query = "insert into  rating_feedback(rating, feedback, email)VALUES ('$rating','$feedback','$email')";
//    mysqli_query($conn, $query);
//    $msg = "<div class='alert alert-success'>Successfully Added Rating.</div>";
//    mysqli_close($conn);
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

</head>
<body>
<div class="container">
    <div class="row">
        <div class="com-md-6 col-md-offset-3">
            <br><br>
            <h2>Rate This Product</h2>
            <br>
            <?php if (isset($msg)){echo $msg;};?>
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
                    <input type="text" class="form-control" name="rating_hidden_button" id="ratingg" placeholder="hidden button">
                </div>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<script src="v2.3.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="v2.3.2/jquery.rateyo.min.js"></script>
<script>
    $(function(){
        $('#rateYo1').rateYo({
            // starWidth : "40px"
            fullStar : true,
            onSet:function(rating, rateYoInstance){
               // alert(rating);
                $('#ratingg').val(rating);
        }
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
