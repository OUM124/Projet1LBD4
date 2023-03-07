<?php 
require_once("db.php");
session_start();
if(isset($_POST["Submit"])){
    if(!empty($_POST["emp_no"]) && !empty($_POST["password"]) ){
        $emp_no = $_POST["emp_no"];
        $password = $_POST["password"];
        global $ConnectingDB;
        $sql = 'SELECT * FROM EMPLOYEES WHERE emp_no = :emp_no AND first_name = :pass ';
        $stmt = $ConnectingDB ->prepare($sql);
        $stmt->bindParam(':emp_no', $emp_no);
        $stmt->bindParam(':pass', $password);
        $stmt->execute();



        if ($stmt->rowCount() == 1) {
            $_SESSION['username'] = $emp_no;
            header('Location: simple.php');
            exit();



        }
        else{
            echo '<script>alert(" Invalid username or password")</script>';

        }







    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing page</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<form class="" action="landing_page.php" method="post">
    
    <span class="fieldinfo">emp_no</span>
    <br>
    <input type="number" name="emp_no" value="">
    <br>
    <span class="fieldinfo">password</span>
    <br>
    <input type="password" name="password" value="">
    <br>
    <input type="submit" name="Submit" value="login  ">

    </form>




</body>
</html>