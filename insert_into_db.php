<?php 
require_once("include/db.php");
if(isset($_POST["Submit"])){
    if(!empty($_POST["emp_no"]) && !empty($_POST["first_name"])  && !empty($_POST["birth_date"])&&!empty($_POST["last_name"])&& !empty($_POST["gender"])  && !empty($_POST["hire_date"])){
        $emp_no = $_POST["emp_no"];
        $first_name = $_POST["first_name"];
        $birth_date = $_POST["birth_date"];
        $last_name = $_POST["last_name"];
        $gender = $_POST["gender"];
        $hire_date = $_POST["hire_date"];
        global $ConnectingDB;
        $sql = "INSERT INTO EMPLOYEES(emp_no,birth_date,first_name,last_name,gender,hire_date)
        VALUES (:emp_nO,:birth_datE,:first_namE,:last_namE,:gendeR,:hire_datE)";
        $stmt = $ConnectingDB ->prepare($sql);
        $stmt ->bindValue(":emp_nO",$emp_no);
        $stmt ->bindValue(":birth_datE",$birth_date);
        $stmt ->bindValue(":first_namE",$first_name);
        $stmt ->bindValue(":last_namE",$last_name);
        $stmt ->bindValue(":gendeR",$gender);
        $stmt ->bindValue(":hire_datE",$hire_date);
        $Execute = $stmt->execute();
        if($Execute){
            echo '<script>alert("employee has been added successfully")</script>';

        }
    }
    else{
        echo '<script>alert("pls add smth")</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert data into database</title>
    <link rel="stylesheet" href="include/style.css">
</head>
<body>
    <div class="">
        <form class="" action="insert_into_db.php" method="post">
            <fieldset>
                <span class="fieldinfo">emp_no</span>
                <br>
                <input type="number" name="emp_no" value="">
                <br>
                <span class="fieldinfo">birth_date</span>
                <br>
                <input type="date" name="birth_date" value="">
                <br>
                <span class="fieldinfo"> first_name</span>
                <br>
                <input type="text" name="first_name" value="">
                <br>
                <span class="fieldinfo"> last_name</span>
                <br>
                <input type="text" name="last_name" value="">
                <br>
                <span class="fieldinfo">  gender</span>
                <br>
                <input type="radio" name="gender" value="F">F
                <br>
                <input type="radio" name="gender" value="M">M
                <br>
                <span class="fieldinfo">  hire_date</span>
                <br>
                <input type="date" name="hire_date" value="">
                <br>

                <input type="submit" name="Submit" value="submit it">
            
            </fieldset>
</form>

    </div>
    
</body>
</html>