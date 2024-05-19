<?php
        session_start();
        if (!isset($_SESSION["user"])) {
            header("Location: login.php");
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Calculator</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="bmistyle.css">
    <style>
        body {
            background-image: url('Assets/back.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .wrapper {
            transform: translate(-10%, -50%);
        }
    </style>
</head>
<body>
    <section class="wrapper">
        
<?php
    $errh = $errw = $errg = "";
    $height = $weight = "";
    $bmipass = "";
    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (empty($_POST['height'])) {
            $errh = "<span style='color:#ed4337; font-size:17px; display:block'>Height is requried</span>";
        } else {
            $height = validate($_POST['height']);
        }
    
        if (empty($_POST['weight'])) {
            $errw = "<span style='color:#ed4337; font-size:17px; display:block'>Weight is requried</span>";
        } else {
            $weight = validate($_POST['weight']);
        }

        if (empty($_POST['height'] && $_POST['weight'])) {
            echo "";
        } else {
            $bmi = ($weight / ($height * $height));
            $bmipass = $bmi;
        }
    }
    
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<h2>Check Your BMI</h2>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="section1">
        <span>Enter Your Height : </span>
        <input type="text" name="height" autocomplete="off" placeholder="Meter"><?php echo $errh; ?>
    </div>
    
    <div class="section2">
        <span>Enter Your weight : </span>
        <input type="text" name="weight" autocomplete="off" placeholder="kilogram"><?php echo $errw; ?>
    </div>    
    <div class="submit">
        <input type="submit" name="submit" value="Check BMI">
        <input type="reset" value="Clear">
        <a href="logout.php" class="btn btn-warning">Logout</a>
    </div>
</form>

<?php
    error_reporting(0);
        echo "<span class='pass'>Your BMI is : " . number_format($bmipass , 2) ."</span>";
    if (isset($_POST['submit'])){
        if ($bmipass >= 13.6 && $bmipass <= 18.5) {
            echo "<span style='color:#00203FFF; display:block; margin-top:5px ;margin-right:50px'> Low body weight. You need to gain weight by eating moderately.</span>";?>
            <img src="Assets/untitled-1.jpg" class="one"><?php
        } elseif ($bmipass > 18.5 && $bmipass < 24.9) {
            echo "<span style='color:#00203FFF; display:block; margin-top:5px;margin-right:50px'> The standard of good health.</span>";?>
            <img src="Assets/untitled-2.jpg" class="two"><?php
        } elseif ($bmipass > 25 && $bmipass < 29.9) {
            echo "<span style='color:#00203FFF; display:block; margin-top:5px;margin-right:50px'> Excess body weight. Exercise needs to reduce excess weight.</span>";?>
            <img src="Assets/untitled-4.jpg" class="three"><?php
        } elseif ($bmipass > 30 && $bmipass < 34.9) {
            echo "<span style='color:#00203FFF; display:block; margin-top:5px;margin-right:50px'> The first stage of obesity. It is necessary to choose food and exercise.</span>";?>
            <img src="Assets/untitled-3.jpg" class="four"><?php
        } elseif ($bmipass > 35 && $bmipass < 39.9) {
            echo "<span style='color:#00203FFF; display:block; margin-top:5px;margin-right:50px'> The second stage of obesity. Moderate diet and exercise are required.</span>";?>
            <img src="Assets/untitled-8.jpg" class="five"><?php
        } elseif ($bmipass >= 40) {
            echo "<span style='color:#00203FFF; display:block; margin-top:5px;margin-right:50px'> Excess fat.<b style='color:#ed4337'> Fear of death</b>. Need a doctor advice.</span>";?>
            <img src="Assets/untitled-6.jpg" class="six"><?php
        }
    } else {
        echo "";
    }
?>

</div>
</body>
</html>