<?php 
require_once("include/db.php");
if(isset($_POST["Submit"])){
    if(!empty($_POST["emp_no"]) && !empty($_POST["salary"])){
        $emp_no = $_POST["emp_no"];
        $salary = $_POST["salary"];


        global $ConnectingDB;
        $query="SELECT emp_no
        FROM SALARIES 
        WHERE EXISTS (SELECT emp_no FROM SALARIES WHERE emp_no= $emp_no )
        ";

        /*$sql = "UPDATE SALARIES 
        SET salary = $salary
        WHERE emp_no = $emp_no";*/
        $stmt = $ConnectingDB ->prepare($query);
        
        $Execute = $stmt->execute();
        if($Execute){
            echo $query;

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
    <title>update the salary of an employee</title>
    <link rel="stylesheet" href="include/style.css">
</head>
<body>
    <div class="">
        <form class="" action="update_salary.php" method="post">
        <fieldset>
                <span class="fieldinfo">emp_no</span>
                <br>
                <input type="number" name="emp_no" value="">
                <br>
                <span class="fieldinfo">salary</span>
                <br>
                <input type="number" name="salary" value="">
                <br>

                <input type="submit" name="Submit" value="submit it">
            
            </fieldset>




        </form>

    </div>
    
</body>
</html>