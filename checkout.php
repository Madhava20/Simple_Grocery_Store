<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Checkout</title>
</head>
<body>
    <?php
    session_start();

    if (isset($_POST['checkout'])) {
        echo '<h1 style="text-align: center;">Checkout Successful!</h1>';
    } else {
        echo '<header>';
        echo '<blockquote>';
        
        if (isset($_SESSION['id'])) {
            echo '<a href="index.php"><img src="image/logo.png"></a>';
            echo '<form class="hf" action="logout.php"><input class="hi" type="submit" name="submitButton" value="Logout"></form>';
            echo '<form class="hf" action="edituser.php"><input class="hi" type="submit" name="submitButton" value="Edit Profile"></form>';
        } else {
            echo '<a href="index.php"><img src="image/logo.png"></a>';
            echo '<form class="hf" action="Register.php"><input class="hi" type="submit" name="submitButton" value="Register"></form>';
            echo '<form class="hf" action="login.php"><input class="hi" type="submit" name="submitButton" value="Login"></form>';
        }

        echo '</blockquote>';
        echo '</header>';

        echo '<blockquote>';

        echo '</blockquote>';
    }
    ?>
</body>
</html>