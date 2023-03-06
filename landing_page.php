<?php 
require_once("db.php");
if(isset($_POST["Submit"])){
    if(!empty($_POST["emp_no"]) && !empty($_POST["password"]) ){
        $emp_no = $_POST["emp_no"];
        $password = $_POST["password"];
        global $ConnectingDB;
        $sql = "SELECT emp_no FROM EMPLOYEES";
        $stmt = $ConnectingDB ->prepare($sql);
        //$table = array();
            //while ($row = mysqli_fetch_assoc($stmt)) {
            //$table[] = $row;
        //}
       





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
<form class="" action="simple.php" method="post">
   
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